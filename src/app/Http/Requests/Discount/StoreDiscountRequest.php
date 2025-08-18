<?php

namespace App\Http\Requests\Discount;

use App\Domain\Discount\Enums\DiscountType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDiscountRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:discounts,name'],
            'type' => ['required', Rule::enum(DiscountType::class)],
            'value' => ['required', 'numeric', 'min:0'],
            
            'value' => function ($attribute, $value, $fail) {
                if ($this->input('type') === DiscountType::PERCENTAGE->value && $value > 100) {
                    $fail('O valor para descontos em porcentagem não pode ser maior que 100.');
                }
            },
        ];
    }
}