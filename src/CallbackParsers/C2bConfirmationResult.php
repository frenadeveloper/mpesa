<?php

namespace Frena\Mpesa\CallbackParsers;

use Frena\Mpesa\Helpers\MpesaHelpers;

class C2bConfirmationResult {

    private array $result = [];

    public function __construct(string $result)
    {
        $this->result = MpesaHelpers::stringToJson($result);
    }

    public function result() {
        return $this->result;
    }

}