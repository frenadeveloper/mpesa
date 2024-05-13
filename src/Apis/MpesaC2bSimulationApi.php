<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\C2bSimulationRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;

class MpesaC2bSimulationApi
{
    use InitiateRequestTrait;

    private C2bSimulationRequestBody $requestBody;

    public function __construct(C2bSimulationRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}

