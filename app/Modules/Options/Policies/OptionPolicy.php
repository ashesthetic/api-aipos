<?php

namespace App\Modules\Options\Policies;

use App\Enums\UserRole;
use App\Modules\Users\Models\User;

class OptionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::Admin;
    }

    public function view(User $user): bool
    {
        return $user->role === UserRole::Admin;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::Admin;
    }

    public function update(User $user): bool
    {
        return $user->role === UserRole::Admin;
    }

    public function delete(User $user): bool
    {
        return $user->role === UserRole::Admin;
    }
}
