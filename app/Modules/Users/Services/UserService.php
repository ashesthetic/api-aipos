<?php

namespace App\Modules\Users\Services;

use App\Modules\Users\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function getAll(int $perPage = 15): LengthAwarePaginator
    {
        return User::orderBy('name')->paginate($perPage);
    }

    public function findOrFail(int $id): User
    {
        return User::findOrFail($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user->fresh();
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
