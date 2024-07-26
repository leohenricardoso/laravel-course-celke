<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        if (
            Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password
            ])
        ) {
            $user = Auth::user();

            $token = $request->user()->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect email or password'
            ], 404);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $authUserId = Auth::check() ? Auth::id() : null;

            if (!$authUserId) {
                return response()->json([
                    'status' => false,
                    'message' => 'User is not logged'
                ], 400);
            }

            $user = User::where('id', $authUserId)->first();
            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logout successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred on logout, you sill logged: ' . $e->getMessage()
            ], 400);
        }
    }
}
