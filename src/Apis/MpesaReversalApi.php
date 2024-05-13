<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\ReversalRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;

class MpesaReversalApi
{
    use InitiateRequestTrait;

    private ReversalRequestBody $requestBody;

    public function __construct(ReversalRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}

