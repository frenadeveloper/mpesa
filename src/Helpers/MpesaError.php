<?php

namespace Frena\Mpesa\Helpers; 


class MpesaError {
    private $message;
    private $code;

    public function __construct($message, $code = null)
    {
        $this->message = $message;
        $this->code = $code;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getCode() {
        return $this->code;
    }
}