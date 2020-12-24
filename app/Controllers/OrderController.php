<?php

namespace App\Controllers;


use App\Forms\Dto\CreateOrderFormDto;
use App\Forms\Type\CreateOrderFormType;
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
    use FormBuilderTrait;

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
     * @throws \Exception
     */
    public function create(ServerRequest $request): JsonResponse
    {
        /** @var CreateOrderFormDto $formDto */
        $formDto = $this->buildForm($request, CreateOrderFormType::class);

        $order = $this->orderService->makeOrder($formDto->products);

        return new JsonResponse(['order' => $order->getId()]);
    }
}