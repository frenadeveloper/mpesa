<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Interfaces\BearerRequestBody;
use Frena\Mpesa\Traits\InitiatorTrait;

class BbgRequestBody implements BearerRequestBody
{
    use InitiatorTrait;

    private $tokenRequestBody;
    private $senderShortCode;
    private $recieverIdentifierType;
    private $timeoutUrl;
    private $callbackUrl;
    private $remarks;
    private $initiator;
    private $amount;
    private $recieverShortCode;
    private $senderIdentifierType;
    private $requesterPhoneNo;
    private $accountReference;

    public function __construct($recieverShortCode, $accountReference, $amount, $remarks, $recieverIdentifierType = "4", $senderIdentifierType = "4", $requesterPhoneNo = null, $callbackUrl = null, $timeoutUrl = null, $senderShortCode = null, array $initiator = [], $tokenRequestBody = null)
    {
        $this->tokenRequestBody = $tokenRequestBody;
        $this->accountReference = $accountReference;
        $this->recieverIdentifierType = $recieverIdentifierType;
        $this->senderShortCode = $senderShortCode;
        $this->remarks = $remarks;
        $this->callbackUrl = $callbackUrl;
        $this->timeoutUrl = $timeoutUrl;
        $this->initiator = $initiator;
        $this->amount = $amount;
        $this->recieverShortCode = $recieverShortCode;
        $this->senderIdentifierType = $senderIdentifierType;
        $this->requesterPhoneNo = $requesterPhoneNo;
    }

    public function url(): string
    {
        return MpesaHelpers::getApiEndPointUrl('bbg');
    }

    public function postData(): array
    {
        return [
            "Initiator" => $this->initiatorName(),
            "SecurityCredential" => $this->securityCredential(),
            'AccountReference' => MpesaHelpers::getValue($this->accountReference, '', 'Account reference is required.'),
            "CommandID" => 'BusinessBuyGoods',
            "PartyA" => MpesaHelpers::getBpbShortCode($this->senderShortCode),
            "PartyB" => MpesaHelpers::getValue($this->recieverShortCode, '', 'Reciever short code is required.'),
            "Amount" => MpesaHelpers::getAmount($this->amount),
            "Requester" => MpesaHelpers::getPhoneNo($this->requesterPhoneNo, false),
            "SenderIdentifierType" => MpesaHelpers::getIdentifierType($this->senderIdentifierType),
            "RecieverIdentifierType" => MpesaHelpers::getIdentifierType($this->recieverIdentifierType),
            "Remarks" => MpesaHelpers::getValue($this->remarks, '','Remarks required'),
            "QueueTimeOutURL" => MpesaHelpers::getBbgCallbackUrl($this->timeoutUrl, 'timeout'),
            "ResultURL" => MpesaHelpers::getBbgCallbackUrl($this->callbackUrl, 'callback'),
        ];
    }

    public function tokenRequestBody()
    {
        return $this->tokenRequestBody;
    }
}
