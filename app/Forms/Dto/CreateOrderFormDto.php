<?php

namespace App\Forms\Dto;


/**
 * Class CreateOrderFormDto
 *
 * @package App\Forms\Dto
 */
class CreateOrderFormDto implements FormDtoInterface
{
    public array $products = [];
}