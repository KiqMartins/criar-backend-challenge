<?php

namespace App\Domain\Product\Repositories;

use App\Domain\Product\Models\Product;
use App\Domain\Product\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function all(): Builder
    {
        return Product::query();
    }

    public function find(int $id): ?Product
    {
        return Product::find($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = Product::find($id);
        $product->update($data);

        return $product;
    }

    public function delete(int $id): bool
    {
        $product = Product::find($id);
        
        return $product->delete();
    }
}