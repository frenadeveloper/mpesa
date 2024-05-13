<?php

namespace Frena\Mpesa\RequestBodies;

use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Interfaces\BearerRequestBody;
use Frena\Mpesa\Traits\StkpushTrait;

class StkpushRequestBody implements BearerRequestBody
{
    use StkpushTrait;

    private $tokenRequestBody;
    private $phoneNo;
    private $amount;
    private $shortCode;
    private $accountNo;
    private $transactionType;
    private $passkey;
    private $callbackUrl;
    private $description;

    public function __construct($phoneNo, $amount, $accountNo = "", $description = "", $transactionType = "CustomerPayBillOnline", $callbackUrl = null, $shortCode = null, $passkey = null, $tokenRequestBody = null)
    {
        $this->tokenRequestBody = $tokenRequestBody;
        $this->accountNo = $accountNo;
        $this->transactionType = $transactionType;
        $this->shortCode = $shortCode;
        $this->phoneNo = $phoneNo;
        $this->amount = $amount;
        $this->description = $description;
        $this->callbackUrl = $callbackUrl;
        $this->passkey = $passkey;

        //dd(MpesaHelpers::getStkpushCallbackUrl($this->callbackUrl));
    }

    public function url(): string
    {
        return MpesaHelpers::getApiEndPointUrl('stkpush');
    }

    public function postData(): array
    {
        return [
            "BusinessShortCode" => MpesaHelpers::getC2bShortCode($this->shortCode),
            "Password" => $this->password(),
            "Timestamp" => $this->timestamp(),
            "TransactionType" => MpesaHelpers::getArrayItem([
                "CustomerPayBillOnline",
                "CustomerBuyGoodsOnline"
            ], $this->transactionType),

            "Amount" => MpesaHelpers::getAmount($this->amount),
            "PartyA" => MpesaHelpers::getPhoneNo($this->phoneNo),
            "PartyB" => MpesaHelpers::getC2bShortCode($this->shortCode),
            "PhoneNumber" => MpesaHelpers::getPhoneNo($this->phoneNo),
            "CallBackURL" => MpesaHelpers::getStkpushCallbackUrl($this->callbackUrl),
            "AccountReference" => $this->accountNo,
            "TransactionDesc" => $this->description
        ];
    }

    public function tokenRequestBody()
    {
        return $this->tokenRequestBody;
    }
}
