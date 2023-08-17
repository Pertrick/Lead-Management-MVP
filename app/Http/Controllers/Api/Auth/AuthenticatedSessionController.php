<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\Api\UserResource;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = $request->authenticate();

        if (!$token) {
            return response()->json([
                'message' => 'Invalid credential combination.'
            ], 401);
        }

        return response()->json([
            'user' => new UserResource(Auth::user()),
            'token' => $token,
        ], 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'User Logged out Successfully!.'
        ], 200);
    }
}
