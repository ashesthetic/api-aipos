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

        $allowedRoles = $this->user()->role === UserRole::Manager
            ? Rule::in([UserRole::Staff->value])
            : Rule::enum(UserRole::class);

        return [
            'name'     => ['sometimes', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:100'],
            'email'    => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['sometimes', Password::min(8)],
            'role'     => ['sometimes', $allowedRoles],
            'active'   => ['sometimes', 'boolean'],
            'dormant'  => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'role.in' => 'Managers can only assign the staff role.',
        ];
    }
}
