<?php

namespace Frena\Mpesa\Exceptions;

use Exception;
use Frena\Mpesa\Helpers\MpesaError;

class MpesaException extends Exception
{
    private MpesaError $mpesaError;
    private $errorCode;

    public function __construct($error, $code = null)
    {
        if($error instanceof MpesaError) {
            $this->errorCode = $error->getMessage();
            $this->message = $error->getMessage();
            $this->mpesaError = $error;
        } else {
            $this->message = $error;
            $this->errorCode = $code;
            $this->mpesaError = new MpesaError($error);
        }
        
    }

    public function getMpesaError(): MpesaError {
        return $this->mpesaError;
    }

    public function getErrorCode() {
        return $this->errorCode;
    }
    
}
