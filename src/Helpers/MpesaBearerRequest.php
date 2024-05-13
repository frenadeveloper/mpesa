<?php

namespace Frena\Mpesa\Helpers;

use Exception;
use Frena\Mpesa\Apis\MpesaTokenApi;
use Frena\Mpesa\Exceptions\MpesaException;
use Frena\Mpesa\Interfaces\BearerRequestBody;

class MpesaBearerRequest
{

    private string $url;
    private $tokenRequestBody;
    private  array $postData;

    public function __construct(BearerRequestBody $requestBody)
    {
        
        $this->url = $requestBody->url();
        $this->postData = $requestBody->postData();
        $this->tokenRequestBody = $requestBody->tokenRequestBody();

        //dd($requestBody->postData());
    }

    public function send()
    {
        try {
            $headers = [
                'Authorization: Bearer ' . $this->token(),
                'Content-Type: application/json'
            ];

            return (new MpesaRequest($this->url, $headers, $this->postData))
                ->send();
        } catch (Exception $th) {
            throw $th;
        } catch (MpesaException $th) {
            throw $th;
        }
    }

    private function token()
    {
        return (new MpesaTokenApi($this->tokenRequestBody))
            ->fetch()
            ->token();
    }
}
