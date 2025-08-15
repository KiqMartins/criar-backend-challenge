<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $stateId = $this->route('state')->id;

        return [
            'name' => ['required', 'string', 'max:127', Rule::unique('states')->ignore($stateId)],
            'state_code' => ['required', 'string', 'size:2', Rule::unique('states')->ignore($stateId)]
        ];
    }
}