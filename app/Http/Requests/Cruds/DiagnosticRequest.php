<?php

namespace App\Http\Requests\Cruds;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosticRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'diagnosis' => ['required', 'string'],
            'medicines' => ['nullable', 'string'],
            're_diagnosis_date' => ['nullable', 'date'],
        ];
    }
}
