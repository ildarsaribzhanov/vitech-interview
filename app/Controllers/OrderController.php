<?php

namespace App\Controllers;


use App\Dto\OrderItmDto;
use App\Services\OrderService;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ServerRequest;

/**
 * Class OrderController
 *
 * @package App\Controllers
 */
class OrderController
{
    /** @var OrderService */
    private OrderService $orderService;

    /**
     * OrderController constructor.
     *
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param ServerRequest $request
     *
     * @return JsonResponse
     */
    public function create(ServerRequest $request)
    {
        $data = json_decode($request->getBody()->getContents());

        $list = [];

        foreach ($data as $dataItm) {
            $list[] = new OrderItmDto($dataItm->id, $dataItm->count);
        }

        $order = $this->orderService->makeOrder($list);

        return new JsonResponse(['order' => $order->getId()]);
    }
}