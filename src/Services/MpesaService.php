<?php

namespace Frena\Mpesa\Services;

use Frena\Mpesa\Apis\MpesaB2cApi;
use Frena\Mpesa\Apis\MpesaBalanceApi;
use Frena\Mpesa\Apis\MpesaBbgApi;
use Frena\Mpesa\Apis\MpesaBpbApi;
use Frena\Mpesa\Apis\MpesaC2bRegisterUrlsApi;
use Frena\Mpesa\Apis\MpesaC2bSimulationApi;
use Frena\Mpesa\Apis\MpesaQrCodeApi;
use Frena\Mpesa\Apis\MpesaReversalApi;
use Frena\Mpesa\Apis\MpesaStkpushApi;
use Frena\Mpesa\Apis\MpesaStkpushQueryApi;
use Frena\Mpesa\Apis\MpesaTransactionStatusApi;
use Frena\Mpesa\RequestBodies\B2cRequestBody;
use Frena\Mpesa\RequestBodies\BbgRequestBody;
use Frena\Mpesa\RequestBodies\BpbRequestBody;
use Frena\Mpesa\RequestBodies\C2bSimulationRequestBody;
use Frena\Mpesa\RequestBodies\QrRequestBody;
use Frena\Mpesa\RequestBodies\ReversalRequestBody;
use Frena\Mpesa\RequestBodies\StkpushQueryRequestBody;
use Frena\Mpesa\RequestBodies\StkpushRequestBody;
use Frena\Mpesa\RequestBodies\TransactionStatusRequestBody;

class MpesaService
{

    public function registerUrls($requestBody = null, callable $onSuccess, callable $onError)
    {
        (new MpesaC2bRegisterUrlsApi($requestBody))
            ->initiate($onSuccess, $onError);
    }

    public function simulate(C2bSimulationRequestBody $requestBody, callable $onSuccess, callable $onError)
    {
        (new MpesaC2bSimulationApi($requestBody))
            ->initiate($onSuccess, $onError);
    }

    public function stkpush(StkpushRequestBody $requestBody, callable $onSuccess, callable $onError)
    {
        (new MpesaStkpushApi($requestBody))
            ->initiate($onSuccess, $onError);
    }

    public function stkpushQuery(StkpushQueryRequestBody $requestBody, callable $onSuccess, callable $onError)
    {
        (new MpesaStkpushQueryApi($requestBody))
            ->initiate($onSuccess, $onError);
    }

    public function balanceQuery($requestBody = null, callable $onSuccess, callable $onError)
    {
        (new MpesaBalanceApi($requestBody))
            ->initiate($onSuccess, $onError);
    }

    public function reverse(ReversalRequestBody $requestBody, callable $onSuccess, callable $onError)
    {
        (new MpesaReversalApi($requestBody))
            ->initiate($onSuccess, $onError);
    }

    public function transactionStatusQuery(TransactionStatusRequestBody $requestBody, callable $onSuccess, callable $onError)
    {
        (new MpesaTransactionStatusApi($requestBody))
            ->initiate($onSuccess, $onError);
    }

    public function b2c(B2cRequestBody $requestBody, callable $onSuccess, callable $onError)
    {
        (new MpesaB2cApi($requestBody))
            ->initiate($onSuccess, $onError);
    }

    public function bpb(BpbRequestBody $requestBody, callable $onSuccess, callable $onError)
    {
        (new MpesaBpbApi($requestBody))
            ->initiate($onSuccess, $onError);
    }

    public function bbg(BbgRequestBody $requestBody, callable $onSuccess, callable $onError)
    {
        (new MpesaBbgApi($requestBody))
            ->initiate($onSuccess, $onError);
    }

    public function generateQrCode(QrRequestBody $requestBody, callable $onSuccess, callable $onError)
    {
        (new MpesaQrCodeApi($requestBody))
            ->initiate($onSuccess, $onError);
    }
}
