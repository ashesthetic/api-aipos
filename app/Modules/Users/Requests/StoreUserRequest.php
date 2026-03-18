<?php

namespace App\Modules\Users\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:100'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(8)],
            'role'     => ['required', Rule::enum(UserRole::class)],
            'active'   => ['sometimes', 'boolean'],
            'dormant'  => ['sometimes', 'boolean'],
        ];
    }
}
