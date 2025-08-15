<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:127|unique:states,name',
            'state_code' => 'required|string|size:2|unique:states,state_code'
        ];
    }
}