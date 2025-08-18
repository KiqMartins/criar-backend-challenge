<?php

namespace App\Domain\Discount\Services;

use App\Domain\Discount\Models\Discount;
use App\Domain\Discount\Repositories\EloquentDiscountRepository;
use App\Domain\Discount\Exceptions\DiscountInUseException;
use Illuminate\Pagination\LengthAwarePaginator;

class DiscountService
{
    protected $discountRepository;

    public function __construct(private EloquentDiscountRepository $repository) 
    {
        $this->discountRepository = $repository;
    }

    public function getAllDiscounts(): LengthAwarePaginator 
    { 
        $pagesCount = 100;
        return $this->discountRepository->all()->paginate($pagesCount);
    }

    public function findDiscountById(int $id): ?Discount
    {
        return $this->discountRepository->find($id);
    }

    public function createDiscount(array $data): Discount 
    { 
        return $this->discountRepository->create($data);
    }

    public function updateDiscount(int $id, array $data): Discount
    { 
        return $this->discountRepository->update($id, $data);
    }

    public function deleteDiscount(Discount $discount): void
    {
        if ($this->discountRepository->isBeingUsed($discount)) {
            throw new DiscountInUseException();
        }

        $this->discountRepository->delete($discount->id);
    }
}