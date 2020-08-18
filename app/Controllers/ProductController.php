<?php

namespace App\Controllers;


use App\Services\ProductService;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ServerRequest;

/**
 * Class ProductController
 *
 * @package App\Controllers
 */
class ProductController
{
    /** @var ProductService */
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Fill product table
     *
     * @return \Laminas\Diactoros\Response\JsonResponse
     * @throws \Exception
     */
    public function fill()
    {
        $this->productService->fillFake();

        return new JsonResponse(["status" => "success"]);
    }

    public function getOne(ServerRequest $request, int $id)
    {
        $product = $this->productService->findById($id);

        return new JsonResponse(["status" => "success", 'product' => $product->toArray()]);
    }
}