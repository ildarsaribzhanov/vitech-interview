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
    private ?int $id;

    /** @var OrderItm[] */
    private array $basket = [];


    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

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