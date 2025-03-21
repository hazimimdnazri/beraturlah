<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\UserException;

class AuthService
{

    public function register(array $request): User
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return $user;
    }

    public function login(Request $request): array | UserException
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw new UserException('Invalid credentials');
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function logout(Request $request): array
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'Logout successful',
        ];
    }
}
