<?php

namespace App\Http\Requests\Cruds;

use Illuminate\Foundation\Http\FormRequest;

class RayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'diagnosis' => ['required', 'string'],
            'images' => ['nullable', 'array'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg,gif'],
        ];
    }
}
