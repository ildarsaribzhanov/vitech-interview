<?php

namespace App\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 *
 * @package App\Entities
 *
 * @ORM\Entity(repositoryClass="ProductRepository")
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="price_type")
     */
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

    /** @return Price */
    public function getPrice(): Price
    {
        return $this->price;
    }
}