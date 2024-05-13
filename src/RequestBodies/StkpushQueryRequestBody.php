<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Interfaces\BearerRequestBody;
use Frena\Mpesa\Traits\StkpushTrait;

class StkpushQueryRequestBody implements BearerRequestBody
{

    use StkpushTrait;

    private $tokenRequestBody;
    private $shortCode;
    private $passkey;
    private $checkoutRequestID;

    public function __construct($checkoutRequestID , $shortCode = null, $passkey = null,  $tokenRequestBody = null)
    {
        $this->tokenRequestBody = $tokenRequestBody;
        $this->checkoutRequestID = $checkoutRequestID;
        $this->passkey = $passkey;
        $this->shortCode = $shortCode;
    }

    public function url(): string
    {
        return MpesaHelpers::getApiEndPointUrl('stkpush', 'query_url');
    }

    public function postData(): array
    {
        return [
            "BusinessShortCode" => MpesaHelpers::getC2bShortCode($this->shortCode),
            "CheckoutRequestID" => $this->checkoutRequestID,
            "Password" => $this->password(),
            "Timestamp" => $this->timestamp(),
        ];
    }

    public function tokenRequestBody()
    {
        return $this->tokenRequestBody;
    }
}
