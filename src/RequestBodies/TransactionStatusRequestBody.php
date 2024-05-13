<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Interfaces\BearerRequestBody;
use Frena\Mpesa\Traits\InitiatorTrait;

class TransactionStatusRequestBody implements BearerRequestBody
{
    use InitiatorTrait;

    private $tokenRequestBody;
    private $shortCode;
    private $identifierType;
    private $timeoutUrl;
    private $callbackUrl;
    private $remarks;
    private $initiator;
    private $originatorConversationID;
    private $occassion;
    private $transactionID;

    public function __construct($transactionID, $originatorConversationID, $remarks, array $initiator = [], $identifierType = "4", $callbackUrl = null, $timeoutUrl = null, $shortCode = null, $tokenRequestBody = null)
    {
        $this->tokenRequestBody = $tokenRequestBody;
        $this->transactionID = $transactionID;
        $this->identifierType = $identifierType;
        $this->shortCode = $shortCode;
        $this->remarks = $remarks;
        $this->callbackUrl = $callbackUrl;
        $this->timeoutUrl = $timeoutUrl;
        $this->initiator = $initiator;
        $this->originatorConversationID = $originatorConversationID;
    }

    public function url(): string
    {
        return MpesaHelpers::getApiEndPointUrl('transaction_status');
    }

    public function postData(): array
    {
        return [
            "Initiator" => $this->initiatorName(),
            "SecurityCredential" => $this->securityCredential(),
            "CommandID" => 'TransactionStatusQuery',
            'TransactionID' => MpesaHelpers::getValue(
                $this->transactionID, 
                '', 
                'Transaction ID is required'
            ),
            "PartyA" => MpesaHelpers::getC2bShortCode($this->shortCode),
            "OriginatorConversationID" => $this->originatorConversationID,
            "IdentifierType" => MpesaHelpers::getIdentifierType($this->identifierType),
            "Remarks" => MpesaHelpers::getValue($this->remarks, '','Remarks required'),
            "QueueTimeOutURL" => MpesaHelpers::getTransactionStatusCallbackUrl($this->timeoutUrl, 'timeout'),
            "ResultURL" => MpesaHelpers::getTransactionStatusCallbackUrl($this->callbackUrl, 'callback'),
        ];
    }

    public function tokenRequestBody()
    {
        return $this->tokenRequestBody;
    }
}
