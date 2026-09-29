<?php

namespace App\Http\Requests\Cruds;

use Illuminate\Foundation\Http\FormRequest;

class AmbulanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->has('selector_ids')) {
            $this->merge(['ambulance_ids' => explode(',', $this->selector_ids)]);
            return [
                'ambulance_ids' => 'required|array',
                'ambulance_ids.*' => 'exists:ambulances,id',
            ];
        }

        return [
            'type' => ['required', 'string'],
            'number' => ['required', 'string', $this->method() === 'POST' ? 'unique:ambulances' : ''],
            'model' => ['required', 'string'],
            'year_made' => ['required', 'date_format:Y'],
        ];
    }
}
