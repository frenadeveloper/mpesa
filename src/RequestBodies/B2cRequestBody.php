<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Interfaces\BearerRequestBody;
use Frena\Mpesa\Traits\InitiatorTrait;

class B2cRequestBody implements BearerRequestBody
{
    use InitiatorTrait;

    private $tokenRequestBody;
    private $shortCode;
    private $commandID;
    private $timeoutUrl;
    private $callbackUrl;
    private $remarks;
    private $initiator;
    private $amount;
    private $occassion;
    private $phoneNo;

    public function __construct($phoneNo, $amount, $remarks, $commandID = "BusinessPayment", $callbackUrl = null, $timeoutUrl = null, $shortCode = null, array $initiator = [], $tokenRequestBody = null)
    {
        $this->tokenRequestBody = $tokenRequestBody;
        $this->phoneNo = $phoneNo;
        $this->commandID = $commandID;
        $this->shortCode = $shortCode;
        $this->remarks = $remarks;
        $this->callbackUrl = $callbackUrl;
        $this->timeoutUrl = $timeoutUrl;
        $this->initiator = $initiator;
        $this->amount = $amount;
    }

    public function url(): string
    {
        return MpesaHelpers::getApiEndPointUrl('b2c');
    }

    public function postData(): array
    {
        return [
            "OriginatorConversationID" => uniqid(),
            "InitiatorName" => $this->initiatorName(),
            "SecurityCredential" => $this->securityCredential(),
            "CommandID" => MpesaHelpers::getArrayItem(["SalaryPayment","BusinessPayment","PromotionPayment"], $this->commandID, 'Command ID'),
            "PartyA" => MpesaHelpers::getB2cShortCode($this->shortCode),
            "PartyB" => MpesaHelpers::getPhoneNo($this->phoneNo),
            "Amount" => MpesaHelpers::getAmount($this->amount),
            "Remarks" => MpesaHelpers::getValue($this->remarks, '','Remarks required'),
            "QueueTimeOutURL" => MpesaHelpers::getB2cCallbackUrl($this->timeoutUrl, 'timeout'),
            "ResultURL" => MpesaHelpers::getB2cCallbackUrl($this->callbackUrl, 'callback'),
        ];
    }

    public function tokenRequestBody()
    {
        return $this->tokenRequestBody;
    }
}
