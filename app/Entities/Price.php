<?php

namespace App\Entities;


use DomainException;

/**
 * Class Price
 *
 * @package App\Entities
 */
class Price
{
    /** @var int */
    private int $price;

    /** Count symbols after comma */
    private const AFTER_COMMA = 2;

    /**
     * Price constructor.
     *
     * @param int $price
     */
    public function __construct(int $price)
    {
        if ($price < 0) {
            throw new DomainException('Price must be more then 0');
        }

        $this->price = $price;
    }

    /**
     * @param float $val
     *
     * @return Price
     */
    public static function create(float $val): Price
    {
        return new self($val * (10 ** self::AFTER_COMMA));
    }

    /**
     * @return float
     */
    public function getVal(): float
    {
        return round($this->price / 10 ** self::AFTER_COMMA, 2);
    }

    /**
     * @param Price $price
     *
     * @return Price
     */
    public function add(Price $price): Price
    {
        $priceVal = $price->getVal() * (10 ** self::AFTER_COMMA);

        return new Price($this->price + $priceVal);
    }

    public function getValue(): string
    {
        return $this->price;
    }
}