<?php

namespace App\Modules\Auth\Services;

use App\Modules\Users\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @throws AuthenticationException
     */
    public function login(string $email, string $password): array
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new AuthenticationException('Invalid credentials.');
        }

        if (!$user->active || $user->dormant) {
            throw new AuthenticationException('Account is inactive or dormant.');
        }

        $token = $user->createToken('api-token')->plainTextToken;

        activity()
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip()])
            ->log('login');

        return ['token' => $token, 'user' => $user];
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();

        activity()
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip()])
            ->log('logout');
    }
}
