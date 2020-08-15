<?php

namespace Tests\Entities;

use App\Entities\Price;
use DomainException;
use PHPUnit\Framework\TestCase;

/**
 * Class PriceTest
 *
 * @package Tests\Entities
 */
class PriceTest extends TestCase
{
    /**
     * Test base create
     */
    public function testCreate()
    {
        $price = Price::create(0);
        $this->assertEquals(0, $price->getVal());

        $price = Price::create(0.01);
        $this->assertEquals(0.01, $price->getVal());

        $price = Price::create(1);
        $this->assertEquals(1, $price->getVal());
    }

    /**
     * Text check exception
     */
    public function testCreatedException()
    {
        $this->expectException(DomainException::class);
        Price::create(-1);
    }

    /**
     * Test added price
     */
    public function testAdd()
    {
        $price = Price::create(3);
        $this->assertEquals(Price::create(3), $price);
        $this->assertEquals(Price::create(7), $price->add(Price::create(4)));
    }
}
