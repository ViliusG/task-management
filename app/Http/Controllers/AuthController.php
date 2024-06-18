<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        public readonly AuthService $authService
    ) {
    }

    public function register(UserCreateRequest $request)
    {
        $user = $this->authService->createUser($request->dto());

        return UserResource::make($user)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        try {
            $token = $this->authService->getAuthToken($request->dto());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to authorize user, please check your credentials.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token
        ]);
    }
}
