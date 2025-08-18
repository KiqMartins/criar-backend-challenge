<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Domain\Discount\Models\Discount;
use App\Domain\Discount\Services\DiscountService;
use App\Http\Requests\Discount\StoreDiscountRequest;
use App\Http\Requests\Discount\UpdateDiscountRequest;
use App\Http\Resources\Discount\DiscountResource;
use App\Http\Resources\Discount\DiscountCollection;
use Illuminate\Http\Response;

class DiscountController extends Controller
{
    protected $discountService;

    public function __construct(DiscountService $service)
    {
        $this->discountService = $service;
    }

    public function index()
    {
        $discounts = $this->discountService->getAllDiscounts();
        return new DiscountCollection($discounts);
    }

    public function show(Discount $discount)
    {
        return new DiscountResource($discount);
    }

    public function store(StoreDiscountRequest $request)
    {
        $discount = $this->discountService->createDiscount($request->validated());
        return (new DiscountResource($discount))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $updatedDiscount = $this->discountService->updateDiscount($discount->id, $request->validated());
        return new DiscountResource($updatedDiscount);
    }

    public function destroy(Discount $discount)
    {
        $this->discountService->deleteDiscount($discount);
        return response()->noContent();
    }
}