<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\B2cRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;

class MpesaB2cApi
{
    use InitiateRequestTrait;

    private B2cRequestBody $requestBody;

    public function __construct(B2cRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}
