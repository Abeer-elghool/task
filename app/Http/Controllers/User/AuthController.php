<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Throwable;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    function register(RegisterRequest $request): JsonResponse
    {
        try {
            User::create($request->validated());
            return response()->json(['status' => 200, 'data' => null, 'message' => 'User registered successfully']);
        } catch (Throwable $e) {
            return response()->json(['status' => 500, 'data' => null, 'message' => 'Registration failed'], 500);
        }
    }

    function login(LoginRequest $request): JsonResponse | UserResource
    {
        $token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password]);
        if (!$token) {
            return response()->json(['status' => 401, 'message' => 'wrong email or password!', 'data' => null], 401);
        }
        $user = auth('api')->user();
        data_set($user, 'token', $token);
        return UserResource::make($user)->additional(['status' => 200, 'message' => 'Login Success.']);
    }
}
