<?php

namespace App\Entities;


/**
 * Class Product
 *
 * @package App\Entities
 */
class Product
{
    /** @var int */
    private int $id;

    /** @var string */
    private string $name;

    /** @var Price */
    private Price $price;

    /**
     * Product constructor.
     *
     * @param int    $id
     * @param string $name
     * @param Price  $price
     */
    public function __construct(int $id, string $name, Price $price)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->price = $price;
    }

    /** @return int */
    public function getId(): int
    {
        return $this->id;
    }

    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /** @return float */
    public function getPrice(): float
    {
        return $this->price->getVal();
    }
}