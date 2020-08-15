<?php

namespace Tests\Entities\Order;

use App\Entities\Order\OrderItm;
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
        $product  = new Product(1, 'Продукт', Price::create(100));
        $orderItm = new OrderItm($product, 1);
        $this->assertEquals(100, $orderItm->getCost());

        $orderItm = new OrderItm($product, 5);
        $this->assertEquals(500, $orderItm->getCost());
    }

    /**
     * Test added
     */
    public function testAdd()
    {
        $product  = new Product(1, 'Продукт', Price::create(100));
        $orderItm = new OrderItm($product, 1);

        $orderItm->add(5);
        $this->assertEquals(100 * 6, $orderItm->getCost());
    }
}
