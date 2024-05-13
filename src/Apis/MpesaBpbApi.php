<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\BpbRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;

class MpesaBpbApi
{
    use InitiateRequestTrait;

    private BpbRequestBody $requestBody;

    public function __construct(BpbRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}

