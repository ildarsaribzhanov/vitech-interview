<?php

namespace App\Entities\Order;


use App\Entities\Price;
use App\Entities\Product;

/**
 * Class OrderItm
 *
 * @package App\Entities\Order
 */
class OrderItm
{
    /** @var Product */
    private Product $product;

    /** @var int */
    private int $amount;

    /**
     * OrderItm constructor.
     *
     * @param Product $product
     * @param int     $amount
     */
    public function __construct(Product $product, int $amount)
    {
        $this->product = $product;
        $this->amount  = $amount;
    }

    /**
     * @return Price
     */
    public function getCost(): Price
    {
        $itmPrice = $this->product->getPrice();

        return Price::create($itmPrice->getVal() * $this->amount);
    }

    /**
     * @param int $amount
     */
    public function add(int $amount): void
    {
        $this->amount += $amount;
    }
}