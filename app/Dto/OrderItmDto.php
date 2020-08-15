<?php

namespace App\Dto;


/**
 * Class OrderItmDto
 *
 * @package App\Dto
 */
class OrderItmDto
{
    /** @var int */
    private int $productId;

    /** @var int */
    private int $amount;

    /**
     * OrderItmDto constructor.
     *
     * @param int $productId
     * @param int $amount
     */
    public function __construct(int $productId, int $amount)
    {
        $this->productId = $productId;
        $this->amount = $amount;
    }

    /** @return int */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /** @return int */
    public function getAmount(): int
    {
        return $this->amount;
    }
}