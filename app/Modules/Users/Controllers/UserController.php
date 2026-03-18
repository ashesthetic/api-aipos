<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Requests\StoreUserRequest;
use App\Modules\Users\Requests\UpdateUserRequest;
use App\Modules\Users\Resources\UserResource;
use App\Modules\Users\Services\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly UserService $userService)
    {
    }

    public function index(): JsonResponse
    {
        $users = $this->userService->getAll();

        return $this->successResponse(UserResource::collection($users));
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userService->create($request->validated());

        return $this->createdResponse(new UserResource($user), 'User created successfully');
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userService->findOrFail($id);

        return $this->successResponse(new UserResource($user));
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = $this->userService->findOrFail($id);
        $updated = $this->userService->update($user, $request->validated());

        return $this->successResponse(new UserResource($updated), 'User updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {
        $user = $this->userService->findOrFail($id);
        $this->userService->delete($user);

        return $this->successResponse(null, 'User deleted successfully');
    }
}
