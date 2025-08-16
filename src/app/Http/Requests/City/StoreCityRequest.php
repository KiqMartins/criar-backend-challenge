<?php

namespace App\Http\Requests\City;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
         return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cities')->where(fn ($q) => 
                    $q->where('state_id', $this->input('state_id'))
                ),
            ],
            'state_id' => 'required|exists:states,id',
        ];
    }
}   