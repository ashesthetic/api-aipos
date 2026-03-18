<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Models\User;
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
        $this->authorize('viewAny', User::class);

        $users = $this->userService->getAll();

        return $this->successResponse(UserResource::collection($users));
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $this->authorize('create', User::class);

        $user = $this->userService->create($request->validated());

        return $this->createdResponse(new UserResource($user), 'User created successfully');
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userService->findOrFail($id);

        $this->authorize('view', $user);

        return $this->successResponse(new UserResource($user));
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = $this->userService->findOrFail($id);

        $this->authorize('update', $user);

        $updated = $this->userService->update($user, $request->validated());

        return $this->successResponse(new UserResource($updated), 'User updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {
        $user = $this->userService->findOrFail($id);

        $this->authorize('delete', $user);

        $this->userService->delete($user);

        return $this->successResponse(null, 'User deleted successfully');
    }
}
