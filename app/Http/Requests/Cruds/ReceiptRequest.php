<?php

namespace App\Http\Requests\Cruds;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric'],
            'notes' => ['nullable', 'string'],
            'patient_id' => ['required', 'exists:patients,id'],
        ];
    }
}
