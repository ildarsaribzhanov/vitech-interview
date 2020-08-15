<?php

namespace App\Entities\Order;


use App\Entities\Price;
use App\Entities\Product;

/**
 * Class Order
 *
 * @package App\Entities
 */
class Order
{
    /** @var OrderItm[] */
    private array $basket = [];

    /**
     * @param Product $product
     * @param int     $count
     */
    public function addProduct(Product $product, int $count)
    {
        $productId = $product->getId();

        if (!isset($this->basket[$productId])) {
            $this->basket[$productId] = new OrderItm($product, 0);
        }

        $this->basket[$productId]->add($count);
    }

    /**
     * @return Price
     */
    public function getTotalCost(): Price
    {
        $totalCost = Price::create(0);

        foreach ($this->basket as $orderItm) {
            $totalCost = $totalCost->add($orderItm->getCost());
        }

        return $totalCost;
    }
}