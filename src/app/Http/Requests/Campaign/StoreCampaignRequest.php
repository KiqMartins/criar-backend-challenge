<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('campaigns')->where('cluster_id', $this->input('cluster_id')),
            ],
            'cluster_id' => ['required', 'integer', 'exists:clusters,id'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}