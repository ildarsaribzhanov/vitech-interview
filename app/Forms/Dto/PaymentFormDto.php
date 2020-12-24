<?php

namespace App\Forms\Dto;


/**
 * Форма подтверждения оплаты
 *
 * Class PaymentFormDto
 *
 * @package App\Forms\Dto
 */
class PaymentFormDto implements FormDtoInterface
{
    /** @var int */
    public int $cost = 0;
}