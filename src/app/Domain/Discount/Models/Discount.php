<?php

namespace App\Domain\Discount\Models;

use App\Domain\Campaign\Models\Campaign;
use App\Domain\Discount\Enums\DiscountType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = ['name', 'type', 'value'];

    protected $casts = [
        'type' => DiscountType::class,
        'value' => 'decimal:2',
    ];

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }
}