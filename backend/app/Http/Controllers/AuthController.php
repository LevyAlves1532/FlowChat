<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\StoreAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
