<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidateRegistration;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(ValidateRegistration $request)
    {
        $fields = $request->validated();
        $fields['password'] = Hash::make($fields['password']);
        $user = User::create($fields);
        return response()->json([
            'message' => 'User registered successfully!',
            'user' => new UserResource($user),
        ], 201);
    }

    public function login(LoginUserRequest $request)
    {
        $fields = $request->validated();
        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }
}
