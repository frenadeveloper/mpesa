<?php

namespace Frena\Mpesa\Traits;

use Frena\Mpesa\Helpers\MpesaHelpers;

trait StkpushTrait 
{

    private function passkey()
    {
        return MpesaHelpers::getValue(
            $this->passkey, 
            config('mpesa.passkey'), 
            'Passkey is required.'
        );
    }

    private function timestamp()
    {
        return date('YmdHis');
    }
    

    private function password()
    {
        $businessShortCode = MpesaHelpers::getC2bShortCode($this->shortCode);
        $passkey = $this->passkey();
        $timestamp = $this->timestamp();
        return base64_encode($businessShortCode . $passkey . $timestamp);
    }
}
