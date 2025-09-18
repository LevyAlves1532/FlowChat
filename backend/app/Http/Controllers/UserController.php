<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordUserRequest;
use App\Http\Requests\User\ChangeProfilePicUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::where('id', '!=', Auth::id())
            ->get()
            ->map(function ($user) {
                if ($user->profile_pic) {
                    $user['profile_pic'] = asset('storage/' . $user->profile_pic);
                }

                return $user;
            });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $body = $request->only('fullName', 'email', 'password');

        $user = User::create([
            'name' => $body['fullName'],
            'email' => $body['email'],
            'password' => $body['password'],
        ]);

        Mail::to($user)->send(new WelcomeMail($user));

        return response()->json([
            'success' => 'Usuário criado com sucesso! Confirme sua conta!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        $body = $request->only('fullName', 'email');

        if ($request->has('fullName')) {
            $body['name'] = $body['fullName'];
            unset($body['fullName']);
        }

        Auth::user()->update($body);

        return Auth::user();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Confirm user account
     */
    public function confirmAccount(User $user)
    {
        if ($user->email_verified_at) {
            return redirect(env('FRONT_APP_URL') ?? '/');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect(env('FRONT_APP_URL') ?? '/');
    }

    /**
     * Upload from photos and update "profile_pic"
     */
    public function changeProfilePic(ChangeProfilePicUserRequest $request)
    {
        $user = Auth::user();

        if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
            Storage::disk('public')->delete($user->profile_pic);
        }

        $path = $request->file('profilePic')->store('users/' . Auth::id(), [
            'disk' => 'public',
        ]);

        $user->update([
            'profile_pic' => $path,
        ]);

        $user['profile_pic'] = asset('storage/' . $path);

        return $user;
    }

    /**
     * Change user password
     */
    public function changePassword(ChangePasswordUserRequest $request)
    {
        $user = Auth::user();

        if (!password_verify($request->currentPassword, $user->password)) {
            return response()->json([
                'error' => 'Senha atual incorreta.',
            ], 422);
        }

        $user->update([
            'password' => $request->newPassword,
        ]);

        return response()->json([
            'success' => 'Senha alterada com sucesso!',
        ]);
    }
}
