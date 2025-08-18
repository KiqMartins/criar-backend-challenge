<?php

namespace App\Domain\Discount\Enums;

enum DiscountType: string
{
    case VALUE = 'value';
    case PERCENTAGE = 'percentage';
}