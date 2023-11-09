<?php

namespace App\Import\ERC;

use GuzzleHttp\Client;

class ErcProducts
{
    protected $url_path;
    protected $token;
    protected $client;

    protected $login = 'shot_sint_odessa';
    protected $password = 'H044bB';
    function __construct(Client $client){
        $this->url_path = 'https://api.erc.ua/v1';
        $this->token = env('ERC_API2_TOKEN');
        $this->client = $client;

    }

    protected function optionDefault(){
        return [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF8',
            ],
        ];
    }

    protected function connect($url, $options, $method='GET'){

        try {
            $response = $this->client->request($method, $url, $options);
        }
        catch(\Exception $e) {
            $error = $e->getResponse();
            dump(json_decode($error->getBody()));
            return false;
        }

        return json_decode($response->getBody());
    }

    public function getToken(){

        $url = $this->url_path.'/auth';

        $str_body = "username=$this->login&password=$this->password";
        $options = array_merge($this->optionDefault(), [
            'body' => $str_body
        ]);

        $method = 'POST';

        return $this->connect($url, $options, $method);
    }

    public function getGoodInfo($sku, $lang='uk'){

        $url = $this->url_path.'/ware/'.$lang.'/sku/'.$sku;

        $options = $this->optionDefault();
        $options['headers']['X-AUTH-TOKEN'] = env('ERC_API2_TOKEN');

        return $this->connect($url, $options);
    }

}
