<?php

namespace Frena\Mpesa\Traits;

use Frena\Mpesa\Exceptions\MpesaException;
use Frena\Mpesa\Helpers\MpesaBearerRequest;
use Frena\Mpesa\Helpers\MpesaError;

trait InitiateRequestTrait {

    public function initiate(callable $onSuccess, callable $onError)
    {
        try {
            $data = (new MpesaBearerRequest($this->requestBody))->send();
            $onSuccess($data);
        } catch (MpesaException $th) {
            $onError($th->getMpesaError());
        } catch (\Throwable $th) {
            $onError(new MpesaError($th->getMessage(), '500'));
        }
    }

}