<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Interfaces\BearerRequestBody;
use Frena\Mpesa\Traits\InitiatorTrait;

class BalanceRequestBody implements BearerRequestBody
{
    use InitiatorTrait;

    private $tokenRequestBody;
    private $shortCode;
    private $identifierType;
    private $timeoutUrl;
    private $callbackUrl;
    private $remarks;
    private $initiator;

    public function __construct(array $initiator = [], $identifierType = "4", $remarks = "", $callbackUrl = null, $timeoutUrl = null, $shortCode = null, $tokenRequestBody = null)
    {
        $this->tokenRequestBody = $tokenRequestBody;
        $this->identifierType = $identifierType;
        $this->shortCode = $shortCode;
        $this->remarks = $remarks;
        $this->callbackUrl = $callbackUrl;
        $this->timeoutUrl = $timeoutUrl;
        $this->initiator = $initiator;
    }

    public function url(): string
    {
        return MpesaHelpers::getApiEndPointUrl('balance');
    }

    public function postData(): array
    {
        return [
            "Initiator" => $this->initiatorName(),
            "SecurityCredential" => $this->securityCredential(),
            "CommandID" => 'AccountBalance',
            "PartyA" => MpesaHelpers::getC2bShortCode($this->shortCode),
            "IdentifierType" => MpesaHelpers::getArrayItem(['1','2','4'],$this->identifierType),
            "Remarks" => MpesaHelpers::getValue($this->remarks, 'Current Balance','Remarks required'),
            "QueueTimeOutURL" => MpesaHelpers::getBalanceCallbackUrl($this->timeoutUrl, 'timeout'),
            "ResultURL" => MpesaHelpers::getBalanceCallbackUrl($this->callbackUrl, 'callback'),
        ];
    }

    public function tokenRequestBody()
    {
        return $this->tokenRequestBody;
    }
}
