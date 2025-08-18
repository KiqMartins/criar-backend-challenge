<?php

namespace App\Http\Requests\Discount;

use App\Domain\Discount\Enums\DiscountType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDiscountRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $discountId = $this->route('discount')->id;

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('discounts')->ignore($discountId)],
            'type' => ['sometimes', 'required', Rule::enum(DiscountType::class)],
            'value' => ['required', 'numeric', 'min:0'],
            
            'value' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    $type = $this->input('type', $this->route('discount')->type->value);

                    if ($type === DiscountType::PERCENTAGE->value && $value > 100) {
                        $fail('O valor para descontos em porcentagem não pode ser maior que 100.');
                    }
                }
            ],
        ];
    }
}