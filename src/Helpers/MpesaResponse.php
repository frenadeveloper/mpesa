<?php

namespace Frena\Mpesa\Helpers;

use Frena\Mpesa\Exceptions\MpesaException;
use Illuminate\Support\Arr;

class MpesaResponse {

    public function data($response) {
        
        if(empty($response)) {
            throw new MpesaException(new MpesaError('No response from mpesa'));
        }

        $response = json_decode($response, true);

        if(Arr::exists($response, 'errorMessage')) {
            throw new MpesaException(new MpesaError($response['errorMessage'], $response['errorCode']));
        }

        if(Arr::exists($response, 'ResponseCode') &&  !in_array(((string) $response['ResponseCode']), ['0','00'])) {
            throw new MpesaException(
                new MpesaError(MpesaHelpers::getResponseDesc($response), $response['ResponseCode'])
            );
        }

        return $response;
    }


}