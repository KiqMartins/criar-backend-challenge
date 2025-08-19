<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Domain\Product\Models\Product;
use App\Domain\Product\Services\ProductService;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $service)
    {
        $this->productService = $service;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return new ProductCollection($products);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());
        return (new ProductResource($product))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $updatedProduct = $this->productService->updateProduct($product->id, $request->validated());
        return new ProductResource($updatedProduct);
    }

    public function destroy(Product $product)
    {   
        $this->productService->deleteProduct($product->id);
        return response()->noContent();
    }
}