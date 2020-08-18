<?php

namespace Tests\Entities\Order;

use App\Entities\OrderItm;
use App\Entities\Price;
use App\Entities\Product;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderItmTest
 *
 * @package Tests\Entities\Order
 */
class OrderItmTest extends TestCase
{
    /**
     * Test create
     */
    public function testCreate()
    {
        $product  = new Product('Продукт', Price::create(100), 1);
        $orderItm = new OrderItm($product, 1);
        $this->assertEquals(Price::create(100), $orderItm->getCost());

        $orderItm = new OrderItm($product, 5);
        $this->assertEquals(Price::create(500), $orderItm->getCost());
    }

    /**
     * Test added
     */
    public function testAdd()
    {
        $product  = new Product( 'Продукт', Price::create(100),1);
        $orderItm = new OrderItm($product, 1);

        $orderItm->add(5);
        $this->assertEquals(Price::create(100 * 6), $orderItm->getCost());
    }
}
