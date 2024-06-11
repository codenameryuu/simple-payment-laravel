<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Validations\Api\PaymentApiValidation;
use App\Services\Api\PaymentApiService;

class PaymentApiController extends Controller
{
    /**
     ** Validation instance.
     *
     * @var \App\Validations\Api\PaymentApiValidation
     */
    protected $paymentApiValidation;

    /**
     ** Service instance.
     *
     * @var \App\Services\Api\PaymentApiService
     */
    protected $paymentApiService;

    /**
     ** Create a new instance.
     *
     * @return void
     */
    public function __construct(PaymentApiValidation $paymentApiValidation, PaymentApiService $paymentApiService)
    {
        $this->paymentApiValidation = $paymentApiValidation;
        $this->paymentApiService = $paymentApiService;
    }

    /**
     ** Summary transaction.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function summaryTransaction(Request $request)
    {
        $validation = $this->paymentApiValidation->summaryTransaction($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->paymentApiService->summaryTransaction($request);

        return $this->formatResponse($result);
    }

    /**
     ** History transaction.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function historyTransaction(Request $request)
    {
        $request['user_id'] = $request->user_id;
        $validation = $this->paymentApiValidation->historyTransaction($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->paymentApiService->historyTransaction($request);

        return $this->formatResponse($result);
    }

    /**
     ** Create transaction.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function createTransaction(Request $request)
    {
        $validation = $this->paymentApiValidation->createTransaction($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->paymentApiService->createTransaction($request);

        return $this->formatResponse($result);
    }

    /**
     ** Update transaction.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateTransaction(Request $request)
    {
        $request['transaction_id'] = $request->transaction_id;
        $validation = $this->paymentApiValidation->updateTransaction($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->paymentApiService->updateTransaction($request);

        return $this->formatResponse($result);
    }
}
