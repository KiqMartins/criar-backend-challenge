<?php

namespace App\Http\Requests\Cluster;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClusterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {   
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('clusters')]
        ];
    }
}