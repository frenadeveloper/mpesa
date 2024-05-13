<?php

namespace Frena\Mpesa\Helpers;

use Frena\Mpesa\Exceptions\MpesaException;
use Illuminate\Support\Arr;

class MpesaHelpers
{

    public static function getResponseDesc(array $response) {
        return Arr::get($response, 'ResponseDesc') ?? Arr::get($response, 'ResponseDescription');
    }

    public static function getValue($value, $defaultValue, $errorMessage, $isRequired = true)
    {
        if (empty($value)) {
            $value = $defaultValue;
        }

        if (empty($value) && $isRequired) {
            throw new MpesaException(new MpesaError($errorMessage));
        }

        return $value;
    }

    public static function getApiEndPointUrl($api, $key = 'endpoint_url')
    {
        $apiDetails = MpesaApiDetails::$api();

        if (config('mpesa.env') === 'live') {
            $domain = config('mpesa.live_domain');
        } else {
            $domain = config('mpesa.sandbox_domain');
        }

        return self::joinUrl($domain , $apiDetails[$key]);
    }

    public static function getAmount($amount)
    {
        $error = null;

        if (empty($amount)) {
            $error = 'Amount is required.';
        } else if (!is_numeric($amount)) {
            $error = "Amount should be numeric.";
        } else if ($amount < 1) {
            $error = "Amount should be greater or equal to one.";
        }

        if ($error) {
            throw new MpesaException($error);
        }

        return $amount;
    }
    

    public static function getC2bCommandID($commandID)
    {
        return self::getArrayItem(
            ['CustomerBuyGoodsOnline', 'CustomerPayBillOnline'],
            $commandID,
            'Command ID'
        );
    }

    public static function getTransactionTypeCode($transactionTypeCode)
    {
        return self::getArrayItem(
            array_keys(self::transactionTypeCodes()),
            $transactionTypeCode,
            'Transaction type code'
        );
    }

    public static function getIdentifierType($identifierType)
    {
        return self::getArrayItem(
            array_keys(self::identifierTypes()),
            $identifierType,
            'Identifier type'
        );
    }

    public static function getArrayItem($items, $item, $itemName = 'Item', $required = true)
    {
        $items = self::toArray($items);

        if (!in_array($item, $items)) {
            if ($required) {
                throw new MpesaException($itemName . ' should either be ' . implode(', ', $items));
            }
            $item = null;
        }

        return $item;
    }

    public static function getC2bShortCode($shortCode = null)
    {
        return MpesaHelpers::getValue(
            $shortCode,
            Arr::get(config('mpesa.short_codes'), 'c2b'),
            'Short code is required'
        );
    }

    public static function getBpbShortCode($shortCode = null)
    {
        return MpesaHelpers::getValue(
            $shortCode,
            Arr::get(config('mpesa.short_codes'), 'bpb'),
            'Short code is required'
        );
    }

    public static function getB2cShortCode($shortCode = null)
    {
        return MpesaHelpers::getValue(
            $shortCode,
            Arr::get(config('mpesa.short_codes'), 'b2c'),
            'Short code is required'
        );
    }

    public static function getPhoneNo($phoneNo, $isRequired = true)
    {
        if(empty($phoneNo) && !$isRequired) {
            return $phoneNo;
        }

        if (empty($phoneNo)) {
            throw new MpesaException("Phone number is required");
        } else if (!is_numeric($phoneNo)) {
            throw new MpesaException("Phone number should be numeric.");
        } else if (strlen($phoneNo) !== 12) {
            throw new MpesaException("Phone number should contain 12 digits.");
        } else if (!str($phoneNo)->startsWith('254')) {
            throw new MpesaException("Phone number should start with '254'.");
        }

        return $phoneNo;
    }

    public static function toArray($items)
    {
        if (!empty($items) && !is_array($items)) {
            return [$items];
        }

        return $items;
    }

    public static function joinUrl($url, $suffix)
    {
        $suffix = array_map(function ($item) {
            return ltrim(rtrim($item, '/'), '/');
        }, self::toArray($suffix));

        return rtrim($url, '/') . '/' . implode('/', $suffix);
    }

    public static function getTransactionStatusCallbackUrl($url, $callbackType)
    {
        return self::getCallbackUrl(
            $url,
            $callbackType,
            ['callback', 'timeout'],
            'transaction_status'
        );
    }

    public static function getB2cCallbackUrl($url, $callbackType)
    {
        return self::getCallbackUrl(
            $url,
            $callbackType,
            ['callback', 'timeout'],
            'b2c'
        );
    }

    public static function getBpbCallbackUrl($url, $callbackType)
    {
        return self::getCallbackUrl(
            $url,
            $callbackType,
            ['callback', 'timeout'],
            'bpb'
        );
    }

    public static function getBbgCallbackUrl($url, $callbackType)
    {
        return self::getCallbackUrl(
            $url,
            $callbackType,
            ['callback', 'timeout'],
            'bbg'
        );
    }

    public static function getReversalCallbackUrl($url, $callbackType)
    {
        return self::getCallbackUrl(
            $url,
            $callbackType,
            ['callback', 'timeout'],
            'reversal'
        );
    }

    public static function getBalanceCallbackUrl($url, $callbackType)
    {
        return self::getCallbackUrl(
            $url,
            $callbackType,
            ['callback', 'timeout'],
            'balance'
        );
    }

    public static function getC2bCallbackUrl($url, $callbackType)
    {
        return self::getCallbackUrl(
            $url,
            $callbackType,
            ['validation', 'confirmation'],
            'c2b'
        );
    }

    public static function getStkpushCallbackUrl($url = null)
    {
        return self::getCallbackUrl(
            $url,
            'callback',
            'callback',
            'stkpush'
        );
    }

    private static function getCallbackUrl($url, $callbackType, $callbackTypes, $api)
    {
        $callbackTypes = self::toArray($callbackTypes);

        if (!in_array($callbackType, $callbackTypes)) {
            throw new MpesaException('Callback type should be either "' . implode('" or "', $callbackTypes) . '".');
        }

        if (empty($url)) {
            $url = Arr::get(MpesaApiDetails::$api(), $callbackType . '_url');
            if (empty($url) && !empty(config('mpesa.api_url'))) {
                $url = self::joinUrl(config('mpesa.api_url'), [$api, $callbackType]);
            }
        }

        if (empty($url)) {
            throw new MpesaException(ucfirst($callbackType) . " url is required.");
        }

        return $url;
    }

    public static function transactionTypeCodes()
    {
        return [
            'BG' => 'Pay Merchant (Buy Goods)',
            'WA' => 'Withdraw Cash at Agent Till',
            'PB' => 'Paybill or Business number',
            'SM' => 'Send Money(Mobile number)',
            'SB' => 'Sent to Business. Business number CPI in MSISDN format.',
        ];
    }

    public static function identifierTypes()
    {
        return [
            '1' => 'MSISDN',
            '2' => 'TillNumber',
            '3' => 'SPShortCode',
            '4' => 'OrganizationShortCode',
            '5' => 'IdentityID',
            '6' => 'O2CLink',
            '9' => 'SPOperatorCode',
            '10' => 'POSNumber',
            '11' => 'OrganizationOperatorUserName',
            '12' => 'OrganizationOperatorCode',
            '13' =>  'VoucherCode'
        ];
    }

    public static function stringToJson($content): array {
        if(empty($content)) {
            throw new MpesaException('Empty content.');
        } 
        return json_decode($content, true);
    }
}
