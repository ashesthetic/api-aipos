<?php

namespace App\Modules\Users\Policies;

use App\Enums\UserRole;
use App\Modules\Users\Models\User;

class UserPolicy
{
    public function viewAny(User $authUser): bool
    {
        return in_array($authUser->role, [UserRole::Admin, UserRole::Manager], true);
    }

    public function view(User $authUser, User $user): bool
    {
        return in_array($authUser->role, [UserRole::Admin, UserRole::Manager], true);
    }

    public function create(User $authUser): bool
    {
        return in_array($authUser->role, [UserRole::Admin, UserRole::Manager], true);
    }

    public function update(User $authUser, User $user): bool
    {
        return in_array($authUser->role, [UserRole::Admin, UserRole::Manager], true);
    }

    public function delete(User $authUser, User $user): bool
    {
        return $authUser->role === UserRole::Admin;
    }
}
