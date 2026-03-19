<?php

namespace App\Modules\Options\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'key'   => ['sometimes', 'string', 'max:255', Rule::unique('options', 'key')->ignore($this->route('option'))],
            'value' => ['sometimes', 'string'],
        ];
    }
}
