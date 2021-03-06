<?php

namespace App\Services;


use App\Entities\Order;
use App\Entities\Price;
use App\Repositories\OrderRepository;
use GuzzleHttp\Client;
use RuntimeException;

/**
 * Class PaymentsService
 *
 * @package App\Services
 */
class PaymentsService
{
    /** @var OrderRepository */
    private OrderRepository $orderRepository;

    /**
     * PaymentsService constructor.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param int   $order_id
     * @param Price $cost
     *
     * @return Order
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pay(int $order_id, Price $cost): Order
    {
        $order = $this->orderRepository->find($order_id);

        if ($order->isPaid()) {
            throw new RuntimeException('This order are paid');
        }

        if (!$cost->equal($order->getTotalCost())) {
            throw new RuntimeException('Send not correct order cost. Correct cost is ' . $order->getTotalCost()->getVal());
        }

        if (!$this->sendPaymentRequest()) {
            throw new RuntimeException('Payment fail');
        }

        $order->setPaid();

        $this->orderRepository->save($order);

        return $order;
    }

    /**
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function sendPaymentRequest()
    {
        $client   = new Client(['base_uri' => 'https://ya.ru']);
        $response = $client->request('GET');

        return ($response->getStatusCode() == 200);
    }
}