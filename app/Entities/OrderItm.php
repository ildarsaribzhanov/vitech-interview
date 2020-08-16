<?php

namespace App\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class OrderItm
 *
 * @package App\Entities\Order
 *
 * @ORM\Entity()
 * @ORM\Table(name="order_products")
 */
class OrderItm
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private int $order_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private int $product_id;

    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="basket")
     */
    private Order $order;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="orderItmList")
     */
    private Product $product;

    /**
     * @ORM\Column(type="integer")
     */
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