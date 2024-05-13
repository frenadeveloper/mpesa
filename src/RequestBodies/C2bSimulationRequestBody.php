<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Interfaces\BearerRequestBody;

class C2bSimulationRequestBody implements BearerRequestBody
{

    private $tokenRequestBody;
    private $phoneNo;
    private $amount;
    private $shortCode;
    private $accountNo;
    private $commandID;

    public function __construct($phoneNo ,$amount, $accountNo = "", $commandID = "CustomerPayBillOnline", $shortCode = null, $tokenRequestBody = null)
    {
        $this->tokenRequestBody = $tokenRequestBody;
        $this->accountNo = $accountNo;
        $this->commandID = $commandID;
        $this->shortCode = $shortCode;
        $this->phoneNo = $phoneNo;
        $this->amount = $amount;
    }

    public function url(): string
    {
        return MpesaHelpers::getApiEndPointUrl('c2b', 'simulation_url');
    }

    public function postData(): array
    {
        return [
            "ShortCode" => MpesaHelpers::getC2bShortCode($this->shortCode),
            "CommandID" => MpesaHelpers::getC2bCommandID($this->commandID),
            "Amount" => MpesaHelpers::getAmount($this->amount),
            "Msisdn" => MpesaHelpers::getPhoneNo($this->phoneNo),
            "BillRefNumber" => $this->accountNo,
        ];
    }

    public function tokenRequestBody()
    {
        return $this->tokenRequestBody;
    }
}
