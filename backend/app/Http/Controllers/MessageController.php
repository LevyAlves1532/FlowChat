<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return Message::where(function ($query) use ($user) {
                return $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($query) use ($user) {
                return $query->where('sender_id', $user->id)
                    ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function (Message $message) {
                $message['is_you'] = $message->sender_id === Auth::id();
                $message['image'] = $message->image ? asset('storage/' . $message->image) : null;
                return $message;
            });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, StoreMessageRequest $request)
    {
        $body = $request->only('text');

        $pathImage = null;

        if ($request->has('image') && $request->file('image')) {
            $pathImage = $request->file('image')->store('chats/' . Auth::id() . '/' . $user->id, [
                'disk' => 'public',
            ]);
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            ...$body,
            'image' => $pathImage,
        ]);

        return response()->json($message, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }

    /**
     * Get chat partners for the authenticated user.
     */
    public function getChatPartners()
    {
        $userId = Auth::id();

        $partnerIds = Message::where('sender_id', $userId)
            ->pluck('receiver_id')
            ->merge(
                Message::where('receiver_id', $userId)->pluck('sender_id')
            )
            ->unique();

        return User::whereIn('id', $partnerIds)
            ->get()
            ->map(function (User $user) {
                $user['profile_pic'] = $user->profile_pic ? asset('storage/' . $user->profile_pic) : null;
                return $user;
            });
    }
}
