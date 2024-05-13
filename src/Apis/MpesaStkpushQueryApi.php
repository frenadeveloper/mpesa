<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\StkpushQueryRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;

class MpesaStkpushQueryApi
{
    use InitiateRequestTrait;

    private StkpushQueryRequestBody $requestBody;

    public function __construct(StkpushQueryRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}

