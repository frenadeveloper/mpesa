<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Interfaces\BearerRequestBody;

class C2bUrlsRequestBody implements BearerRequestBody
{

    private $tokenRequestBody;
    private $validationUrl;
    private $confirmationUrl;
    private $shortCode;
    private $responseType;

    public function __construct($shortCode = null, $responseType = null, $validationUrl = null, $confirmationUrl = null, $tokenRequestBody = null)
    {
        $this->tokenRequestBody = $tokenRequestBody;
        $this->validationUrl = $validationUrl;
        $this->confirmationUrl = $confirmationUrl;
        $this->responseType = $responseType;
        $this->shortCode = $shortCode;
    }

    private function responseType()
    {
        return MpesaHelpers::getValue(
            $this->responseType,
            'Completed',
            'Response type is required'
        );
    }

    private function validationUrl()
    {
        return MpesaHelpers::getC2bCallbackUrl($this->validationUrl, 'validation');
    }

    private function confirmationUrl()
    {
        return MpesaHelpers::getC2bCallbackUrl($this->confirmationUrl, 'confirmation');
    }

    public function url(): string
    {
        return MpesaHelpers::getApiEndPointUrl('c2b');
    }

    public function postData(): array
    {
        return [
            "ShortCode" => MpesaHelpers::getC2bShortCode($this->shortCode),
            "ResponseType" => $this->responseType(),
            "ConfirmationURL" => $this->confirmationUrl(),
            "ValidationURL" => $this->validationUrl(),
        ];
    }

    public function tokenRequestBody()
    {
        return $this->tokenRequestBody;
    }
}
