<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\BbgRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;

class MpesaBbgApi
{
    use InitiateRequestTrait;

    private BbgRequestBody $requestBody;

    public function __construct(BbgRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}

