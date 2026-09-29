<?php

namespace App\Http\Requests\Cruds;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->has('selector_ids')) {
            $this->merge(['department_ids' => explode(',', $this->selector_ids)]);
            return [
                'department_ids' => 'required|array',
                'department_ids.*' => 'exists:departments,id',
            ];
        }

        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
