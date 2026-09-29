<?php

namespace App\Http\Requests\Cruds;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->has('selector_ids')) {
            $this->merge(['insurance_ids' => explode(',', $this->selector_ids)]);
            return [
                'insurance_ids' => 'required|array',
                'insurance_ids.*' => 'exists:insurances,id',
            ];
        }

        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'code' => ['required', 'string', $this->method() === 'POST' ? 'unique:insurances' : ''],
            'discount_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
