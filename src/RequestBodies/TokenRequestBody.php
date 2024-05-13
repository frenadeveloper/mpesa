<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;

class TokenRequestBody
{

    private $consumerKey;
    private $consumerSecret;

    public function __construct($consumerKey = null, $consumerSecret = null)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
    }

    private function consumerKey()
    {
        return MpesaHelpers::getValue(
            $this->consumerKey,
            config('mpesa.consumer_key'),
            'Consumer key is required'
        );
    }

    private function consumerSecret()
    {
        return MpesaHelpers::getValue(
            $this->consumerSecret,
            config('mpesa.consumer_secret'),
            'Consumer secret is required'
        );
    }

    public function password()
    {
        return base64_encode($this->consumerKey() . ':' . $this->consumerSecret());
    }

    public function url()
    {
        return MpesaHelpers::getApiEndPointUrl('auth');
    }
}
