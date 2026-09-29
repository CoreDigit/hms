<?php

namespace App\Http\Requests\Cruds;

use Illuminate\Foundation\Http\FormRequest;

class MultiServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->has('selector_ids')) {
            $this->merge(['multi_service_ids' => explode(',', $this->selector_ids)]);
            return [
                'multi_service_ids' => 'required|array',
                'multi_service_ids.*' => 'exists:multi_services,id',
            ];
        }

        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'total_price' => ['required', 'numeric', 'min:0'],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'tax_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'single_service_ids' => 'required|array',
            'single_service_ids.*' => 'required|exists:single_services,id',
            'single_service_quantities' => 'required|array',
            'single_service_quantities.*' => 'required|integer|min:1',
        ];
    }
}
