<?php

namespace Frena\Mpesa\Helpers;

use Frena\Mpesa\Exceptions\MpesaException;
use Illuminate\Support\Arr;

class MpesaApiDetails {

    public static function __callStatic($name, $arguments)
    {
        $apis = config('mpesa.apis');

        if(!Arr::exists($apis, $name)) {
            throw new MpesaException(new MpesaError($name ." is not found."));
        }

        return $apis[$name];
    }

}