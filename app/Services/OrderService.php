<?php

namespace App\Services;


use App\Dto\OrderItmDto;
use App\Entities\Order;
use App\Repositories\ProductRepository;
use DomainException;

/**
 * Class OrderService
 *
 * @package App\Services
 */
class OrderService
{
    /** @var ProductRepository */
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param OrderItmDto[] $orderList
     *
     * @return Order
     */
    public function makeOrder(array $orderList): Order
    {
        $productIdList = [];

        foreach ($orderList as $item) {
            $productIdList[] = $item->getProductId();
        }

        $products = $this->productRepository->getFromIdList($productIdList);

        $order = new Order(1);

        foreach ($orderList as $item) {
            $productId = $item->getProductId();

            if (!isset($products[$productId])) {
                throw new DomainException('Undefined product with id ' . $productId);
            }

            $order->addProduct($products[$productId], $item->getAmount());
        }

        // todo save order
        return $order;
    }
}