<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(AuthRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());

        return response()->json($user, 201);
    }

    public function login(Request $request): JsonResponse
    {
        $user = $this->authService->login($request);

        return response()->json($user, 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $this->authService->logout($request);

        return response()->json($user, 200);
    }
}
