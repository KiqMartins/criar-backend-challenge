<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $campaignId = $this->route('campaign')->id;

        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('campaigns')
                    ->where('cluster_id', $this->route('campaign')->cluster_id)
                    ->ignore($campaignId),
            ],
            'cluster_id' => ['prohibited'],
            'is_active' => ['sometimes', 'required', 'boolean'],
            'discount_id' => ['nullable', 'integer', 'exists:discounts,id'],
        ];
    }
}