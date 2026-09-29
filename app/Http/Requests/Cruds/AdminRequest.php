<?php

namespace App\Http\Requests\Cruds;

use App\Models\Users\Admin;
use App\Rules\UniqueEmailAcrossUsers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [// update admin info from profile page
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', new UniqueEmailAcrossUsers(auth()->user()->email)],
            'image' => ['nullable', 'image'],
        ];
    }
}
