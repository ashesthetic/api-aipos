<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Requests\LoginRequest;
use App\Modules\Auth\Resources\AuthResource;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Options\Models\Option;
use App\Modules\Users\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly AuthService $authService)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->login(
                $request->validated('email'),
                $request->validated('password')
            );

            return $this->successResponse(
                new AuthResource($result),
                'Login successful'
            );
        } catch (AuthenticationException $e) {
            return $this->errorResponse($e->getMessage(), [], 401);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return $this->successResponse(null, 'Logged out successfully');
    }

    public function me(Request $request): JsonResponse
    {
        $onboarding = Option::where('key', 'onboarding')->value('value') === 'true';

        return $this->successResponse([
            'user'       => new UserResource($request->user()),
            'onboarding' => $onboarding,
        ]);
    }
}
