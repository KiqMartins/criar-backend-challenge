<?php

namespace App\Domain\Discount\Repositories;

use App\Domain\Discount\Models\Discount;
use App\Domain\Discount\Contracts\DiscountRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class EloquentDiscountRepository implements DiscountRepositoryInterface
{
    public function all(): Builder
    {
        return Discount::query();
    }

    public function find(int $id): ?Discount
    {
        return Discount::find($id);
    }

    public function create(array $data): Discount
    {
        return Discount::create($data);
    }

    public function update(int $id, array $data): Discount
    {
        $discount = Discount::find($id);
        $discount->update($data);

        return $discount;
    }

    public function delete(int $id): bool
    {
        $discount = Discount::find($id);
        
        return $discount->delete();
    }

    public function isBeingUsed(Discount $discount): bool
    {
        return $discount->campaigns()->exists();
    }
}