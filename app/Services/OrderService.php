<?php

namespace App\Services;


use App\Dto\OrderItmDto;
use App\Entities\Order;
use App\Entities\OrderItm;
use App\Entities\Price;
use App\Repositories\OrderItmRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
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

    /** @var OrderRepository */
    private OrderRepository $orderRepository;

    /** @var UserRepository */
    private UserRepository $userRepository;

    /**
     * @var \App\Repositories\OrderItmRepository
     */
    private OrderItmRepository $orderItmRepository;

    public function __construct(ProductRepository $productRepository,
                                OrderRepository $orderRepository,
                                OrderItmRepository $orderItmRepository,
                                UserRepository $userRepository)
    {
        $this->productRepository  = $productRepository;
        $this->orderRepository    = $orderRepository;
        $this->orderItmRepository = $orderItmRepository;
        $this->userRepository     = $userRepository;
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

        $order = new Order();

        $totalPrice   = new Price(0);
        $orderItmList = [];

        foreach ($orderList as $item) {
            $productId = $item->getProductId();

            if (!isset($products[$productId])) {
                throw new DomainException('Undefined product with id ' . $productId);
            }

            $orderItm = new OrderItm($products[$productId], $item->getAmount());
            $orderItm->setOrder($order);

            $orderItmList[] = $orderItm;

            $totalPrice = $totalPrice->add($orderItm->getCost());
        }

        $user = $this->userRepository->find(1);

        $order->setTotalCost($totalPrice);
        $order->setUser($user);

        $order = $this->orderRepository->save($order);
        $this->orderItmRepository->createListForOrder($orderItmList, $order);

        return $order;
    }
}