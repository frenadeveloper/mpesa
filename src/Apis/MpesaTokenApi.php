<?php

namespace Frena\Mpesa\Apis;

use Frena\Mpesa\Exceptions\MpesaException;
use Frena\Mpesa\Helpers\MpesaHelpers;
use Frena\Mpesa\Helpers\MpesaRequest;
use Frena\Mpesa\RequestBodies\TokenRequestBody;
use Illuminate\Support\Arr;

class MpesaTokenApi
{

    private TokenRequestBody $requestBody;
    private $token;

    public function __construct($requestBody = null)
    {

        $this->requestBody = MpesaHelpers::getValue(
            $requestBody,
            new TokenRequestBody,
            'Request body is required'
        );
    }

    public function fetch()
    {

        try {
            $data = app()->make(MpesaRequest::class, [
                'url' => $this->requestBody->url(),
                'headers' => ['Authorization: Basic ' . $this->requestBody->password()]
            ])->send();

            $this->token = Arr::get($data, 'access_token');
        } catch (MpesaException $th) {
            throw $th;
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this;
    }

    public function token()
    {
        return $this->token;
    }
}
