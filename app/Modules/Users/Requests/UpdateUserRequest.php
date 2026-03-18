<?php

namespace App\Modules\Users\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name'     => ['sometimes', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:100'],
            'email'    => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['sometimes', Password::min(8)],
            'role'     => ['sometimes', Rule::enum(UserRole::class)],
            'active'   => ['sometimes', 'boolean'],
            'dormant'  => ['sometimes', 'boolean'],
        ];
    }
}
