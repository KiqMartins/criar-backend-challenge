<?php

namespace App\Domain\Product\Services;

use App\Domain\Product\Models\Product;
use App\Domain\Product\Repositories\EloquentProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    protected $productRepository;

    public function __construct(private EloquentProductRepository $repository) 
    {
        $this->productRepository = $repository;
    }

    public function getAllProducts(): LengthAwarePaginator
    {
        $pagesCount = 100;
        return $this->productRepository->all()->paginate($pagesCount);
    }

    public function createProduct(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct(int $id, array $data): Product
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct(int $id): void
    {
        $this->productRepository->delete($id);
    }
}