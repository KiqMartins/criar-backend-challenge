<?php

namespace App\Http\Requests\City;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cityId = optional($this->route('city'))->id ?? $this->input('id');
        
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cities')
                    ->where(fn ($q) => $q->where('state_id', $this->input('state_id')))
                    ->ignore($cityId),
            ],
            'state_id' => 'required|exists:states,id',
        ];
    }
}
