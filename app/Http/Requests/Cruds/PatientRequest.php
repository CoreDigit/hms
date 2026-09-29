<?php

namespace App\Http\Requests\Cruds;

use App\Rules\UniqueEmailAcrossUsers;
use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $ignoredEmail = $this->method() == 'POST' ? null :
            $this->route('patient')->email ?? auth()->user()->email;

        $rules = [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', new UniqueEmailAcrossUsers($ignoredEmail)],
            'gender' => ['required', 'boolean'],
            'phone' => ['nullable', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'blood_type' => ['nullable', 'in:A,B,O,AB'],
            'address' => ['nullable'],
            'image' => ['nullable', 'image'],
        ];

        if ($this->method() == 'POST') {
            $rules['password'] = ['required', 'string', 'min:6'];
        }

        return $rules;
    }
}
