<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\StkpushRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;

class MpesaStkpushApi
{
    use InitiateRequestTrait;

    private StkpushRequestBody $requestBody;

    public function __construct(StkpushRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}

