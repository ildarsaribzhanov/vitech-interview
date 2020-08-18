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
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="basket")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", nullable=false)
     */
    private Order $order;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="orderItmList")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
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
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
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

    /**
     * @param Order $order
     */
    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }
}