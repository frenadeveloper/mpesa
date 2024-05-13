<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\RequestBodies\QrRequestBody;
use Frena\Mpesa\Traits\InitiateRequestTrait;

class MpesaQrCodeApi
{
    use InitiateRequestTrait;

    private QrRequestBody $requestBody;

    public function __construct(QrRequestBody $requestBody)
    {
        $this->requestBody = $requestBody;
    }
}

