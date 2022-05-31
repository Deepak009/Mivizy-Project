<?php

namespace App\Libs;

use GuzzleHttp\Client;

class MSG91
{
    private $client;
    private $auth_key;

    const base_uri = "https://api.msg91.com";

    /**
     * Constructor function
     *
     */
    public function __construct()
    {
        $this->auth_key = config("msg91.auth_key");
        $this->client = new Client([
                                        "base_uri" => self::base_uri,
                                        "headers" => [
                                                        "content-type" => "application/json"
                                                    ],
                                    ]);
    }

    /**
     * Get request
     *
     * @param   string      $url
     * @param   array      $params
     */
    public function get($url, $params =[])
    {
        if(!in_array(config('app.env'),['prod', 'production'])){
            \Log::debug("SMS request:".PHP_EOL."URL: {$url}", $params);
            return false;
        }
        $params["authkey"] = $this->auth_key;
        return $this->client->get($url, [
            "query" => $params
        ]);
    }

    /**
     * Send OTP
     *
     * @param   string      $country_code
     * @param   string      $phone_number
     * @param   string      $otp
     */
    public function sentOTP($country_code, $phone_number, $otp)
    {
        $params = [
            "template_id" => config('msg91.otp_template_id'),
            "mobile" => "{$country_code}{$phone_number}",
            "otp" => $otp
        ];
        $response = $this->get('/api/v5/otp', $params);
        if($response && in_array($response->getStatusCode(),[200])){
            $res = json_decode($response->getBody(),true);
            return $res["type"] == "success";
        }
        return false;
    }
}
