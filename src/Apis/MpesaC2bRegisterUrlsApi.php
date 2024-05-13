<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\C2bUrlsRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;


class MpesaC2bRegisterUrlsApi
{
    use InitiateRequestTrait;

    private C2bUrlsRequestBody $requestBody;

    public function __construct(C2bUrlsRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}

