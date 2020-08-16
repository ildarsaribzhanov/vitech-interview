<?php

namespace Tests\Entities\Order;

use App\Entities\Order;
use App\Entities\Price;
use App\Entities\Product;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderTest
 *
 * @package Tests\Entities\Order
 */
class OrderTest extends TestCase
{
    /**
     *
     */
    public function testGetTotalCost()
    {
        $order = new Order();

        $product1 = new Product(1, 'Продукт 1', Price::create(100));
        $order->addProduct($product1, 1);
        $this->assertEquals(Price::create(100), $order->getTotalCost());

        $order->addProduct($product1, 2);
        $this->assertEquals(Price::create(300), $order->getTotalCost());

        $product1 = new Product(2, 'Продукт 2', Price::create(250));
        $order->addProduct($product1, 3);
        $this->assertEquals(Price::create(300 + 250 * 3), $order->getTotalCost());
    }
}
