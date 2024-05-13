<?php

namespace Frena\Mpesa\Traits;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Illuminate\Support\Arr;

trait InitiatorTrait
{

    private function initiatorName()
    {
        return MpesaHelpers::getValue(
            Arr::get($this->initiator, 'name'),
            Arr::get(config('mpesa.initiator'), 'name'),
            'Initiator name is required.'
        );
    }

    private function initiatorPassword()
    {
        return MpesaHelpers::getValue(
            Arr::get($this->initiator, 'password'),
            Arr::get(config('mpesa.initiator'), 'password'),
            'Initiator password is required.'
        );
    }

    private function securityCredential()
    {
        return MpesaHelpers::getValue(
            '',
            Arr::get(config('mpesa.initiator'), 'security_credential'),
            'Security credential is required.'
        );
    }
}
