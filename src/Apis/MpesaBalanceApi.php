<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\BalanceRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;

class MpesaBalanceApi
{
    use InitiateRequestTrait;

    private BalanceRequestBody $requestBody;

    public function __construct(BalanceRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}
