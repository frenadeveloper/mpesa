<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Interfaces\BearerRequestBody;

class QrRequestBody implements BearerRequestBody
{
    private $tokenRequestBody;
    private $creditPartyIdentifier;
    private $size;
    private $transactionTypeCode;
    private $refNo;
    private $amount;
    private $merchantName;

    public function __construct($merchantName, $transactionTypeCode,  $creditPartyIdentifier, $refNo, $amount,  $size = "300", $tokenRequestBody = null)
    {
        $this->tokenRequestBody = $tokenRequestBody;
        $this->merchantName = $merchantName;
        $this->creditPartyIdentifier = $creditPartyIdentifier;
        $this->refNo = $refNo;
        $this->transactionTypeCode = $transactionTypeCode;
        $this->size = $size;
        $this->amount = $amount;
    }

    public function url(): string
    {
        return MpesaHelpers::getApiEndPointUrl('qr_code');
    }

    public function postData(): array
    {
        return [
            "MerchantName" => $this->merchantName,
            "RefNo" => $this->refNo,
            "TrxCode" => MpesaHelpers::getTransactionTypeCode($this->transactionTypeCode),
            "CPI" => $this->creditPartyIdentifier,
            "Size" => $this->size,
            "Amount" => MpesaHelpers::getAmount($this->amount),
        ];
    }

    public function tokenRequestBody()
    {
        return $this->tokenRequestBody;
    }
}
