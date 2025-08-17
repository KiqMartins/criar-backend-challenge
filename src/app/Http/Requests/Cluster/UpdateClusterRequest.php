<?php

namespace App\Http\Requests\Cluster;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClusterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $clusterId = optional($this->route('cluster'))->id ?? $this->input('id');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('clusters')->ignore($clusterId)]
        ];
    }
}