<?php

namespace App\Http\Requests\Cruds;

use Illuminate\Foundation\Http\FormRequest;

class SingleServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->has('selector_ids')) {
            $this->merge(['single_service_ids' => explode(',', $this->selector_ids)]);
            return [
                'single_service_ids' => 'required|array',
                'single_service_ids.*' => 'exists:single_services,id',
            ];
        }

        return [
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ];
    }
}
