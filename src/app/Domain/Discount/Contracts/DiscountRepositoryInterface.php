<?php

namespace App\Domain\Discount\Contracts;

use App\Domain\Discount\Models\Discount;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;


interface DiscountRepositoryInterface
{
    public function all(): Builder;
    public function find(int $id): ?Discount;
    public function create(array $data): Discount;
    public function update(int $id, array $data): Discount;
    public function delete(int $id): bool;
    public function isBeingUsed(Discount $discount): bool;
}