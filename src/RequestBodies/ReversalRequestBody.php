<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Interfaces\BearerRequestBody;
use Frena\Mpesa\Traits\InitiatorTrait;

class ReversalRequestBody implements BearerRequestBody
{
    use InitiatorTrait;

    private $tokenRequestBody;
    private $shortCode;
    private $recieverIdentifierType;
    private $timeoutUrl;
    private $callbackUrl;
    private $remarks;
    private $initiator;
    private $amount;
    private $occassion;
    private $transactionID;

    public function __construct($transactionID, $amount, $remarks, $recieverIdentifierType = "11", $callbackUrl = null, $timeoutUrl = null, $shortCode = null, array $initiator = [], $tokenRequestBody = null)
    {
        $this->tokenRequestBody = $tokenRequestBody;
        $this->transactionID = $transactionID;
        $this->recieverIdentifierType = $recieverIdentifierType;
        $this->shortCode = $shortCode;
        $this->remarks = $remarks;
        $this->callbackUrl = $callbackUrl;
        $this->timeoutUrl = $timeoutUrl;
        $this->initiator = $initiator;
        $this->amount = $amount;
    }

    public function url(): string
    {
        return MpesaHelpers::getApiEndPointUrl('reversal');
    }

    public function postData(): array
    {
        return [
            "Initiator" => $this->initiatorName(),
            "SecurityCredential" => $this->securityCredential(),
            "CommandID" => 'TransactionReversal',
            'TransactionID' => MpesaHelpers::getValue(
                $this->transactionID, 
                '', 
                'Transaction ID is required'
            ),
            "ReceiverParty" => MpesaHelpers::getC2bShortCode($this->shortCode),
            "Amount" => MpesaHelpers::getAmount($this->amount),
            "RecieverIdentifierType" => MpesaHelpers::getIdentifierType($this->recieverIdentifierType),
            "Remarks" => MpesaHelpers::getValue($this->remarks, '','Remarks required'),
            "QueueTimeOutURL" => MpesaHelpers::getReversalCallbackUrl($this->timeoutUrl, 'timeout'),
            "ResultURL" => MpesaHelpers::getReversalCallbackUrl($this->callbackUrl, 'callback'),
        ];
    }

    public function tokenRequestBody()
    {
        return $this->tokenRequestBody;
    }
}
