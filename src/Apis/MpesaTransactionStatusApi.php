<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\TransactionStatusRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;

class MpesaTransactionStatusApi
{
    use InitiateRequestTrait;

    private TransactionStatusRequestBody $requestBody;

    public function __construct(TransactionStatusRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}
