<?php 

namespace Frena\Mpesa\Helpers;

use Frena\Mpesa\Exceptions\MpesaException;

class MpesaRequest {

    private string $url;
    private  array $headers;
    private  array $postData;

    public function __construct(string $url, array $headers, array $postData = [])
    {
        $this->url = $url;
        $this->postData = $postData;
        $this->headers = $headers;

        //dd($headers);
    }

    public function send() {

        try {

            $ch = curl_init($this->url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

            if(count($this->postData)) {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->postData));
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            

            return app()->make(MpesaResponse::class)->data($response);
        } catch (MpesaException $th) {
            throw $th;
        } catch (\Throwable $th) {
            throw $th;
        }

    }

}