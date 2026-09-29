<?php

namespace App\Http\Requests\Cruds;

use App\Rules\UniqueEmailAcrossUsers;
use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //which doctor can be from admin cruds or doctor profile so:
        $ignoredEmail = $this->method() == 'POST' ? null :
            $this->route('doctor')->email ?? auth()->user()->email;
            
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', new UniqueEmailAcrossUsers($ignoredEmail)],
            'gender' => ['required', 'boolean'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'department_id' => ['required', 'exists:departments,id'],
            'phone' => ['nullable', 'string', 'max:255'],
            'number_of_appointments' => ['nullable', 'numeric', 'min:1', 'max:20'],
            'bio' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
        ];

        if ($this->method() == 'POST') {
            $rules['password'] = ['required', 'string', 'min:6'];
        }

        return $rules;
    }
}
