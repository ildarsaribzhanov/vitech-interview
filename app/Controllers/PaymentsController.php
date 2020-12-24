<?php

namespace App\Controllers;


use App\Entities\Price;
use App\Services\PaymentsService;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ServerRequest;

/**
 * Class PaymentsController
 *
 * @package App\Controllers
 */
class PaymentsController
{
    /** @var PaymentsService */
    private PaymentsService $paymentsService;

    public function __construct(PaymentsService $paymentsService)
    {
        $this->paymentsService = $paymentsService;
    }

    /**
     * @param ServerRequest $request
     * @param int           $order_id
     *
     * @return \Laminas\Diactoros\Response\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pay(ServerRequest $request, int $order_id)
    {
        $data = json_decode($request->getBody()->getContents());

        $cost = Price::create($data->cost);

        $this->paymentsService->pay($order_id, $cost);

        return new JsonResponse(['success' => true, 'message' => 'Order is paid']);
    }
}