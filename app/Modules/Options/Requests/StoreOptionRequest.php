<?php

namespace App\Modules\Options\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'key'   => ['required', 'string', 'max:255', 'unique:options,key'],
            'value' => ['required', 'string'],
        ];
    }
}
