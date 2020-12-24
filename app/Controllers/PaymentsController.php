<?php

namespace App\Controllers;


use App\Entities\Price;
use App\Forms\Dto\PaymentFormDto;
use App\Forms\Type\PaymentFormType;
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
    use FormBuilderTrait;

    /** @var PaymentsService */
    private PaymentsService $paymentsService;

    /**
     * PaymentsController constructor.
     *
     * @param PaymentsService $paymentsService
     */
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
     * @throws \Exception
     */
    public function pay(ServerRequest $request, int $order_id): JsonResponse
    {
        /** @var PaymentFormDto $formDto */
        $formDto = $this->buildForm($request, PaymentFormType::class);

        $cost = Price::create($formDto->cost);

        $this->paymentsService->pay($order_id, $cost);

        return new JsonResponse(['success' => true, 'message' => 'Order is paid']);
    }
}