<?php

namespace App\Import\ERC;

use GuzzleHttp\Client;

class ErcStore
{
    protected $email;
    protected $pass;
    protected $path_url;
    protected $client;

    function __construct(Client $client)
    {
        $this->email = env('ERC_API_EMAIL');
        $this->pass = env('ERC_API_PASSWORD');
        $this->path_url = 'https://connect.erc.ua/connectservice/api/specprice';
        $this->client = $client;
    }

    protected function dataDefault(){
        return [
            "email" => $this->email,
            "pass" => $this->pass,
            'IsJson' => true,
        ];
    }

    protected function connect($url, $data){

        $data_string = json_encode($data);

        $options = [
            'headers' => [
                'Content-Type' => 'application/json; charset=UTF8',
                'Content-Length' => strlen($data_string)
            ],
            'body' => $data_string
        ];

        $response = $this->client->request("POST", $url, $options);
        return json_decode($response->getBody());
    }

    public function getCurrency($date=null){

        if (!$date){
            $date = date('d.m.Y', time());
        }

        $data = array_merge($this->dataDefault(), [
            "infotype" => 7,
            "CurrencyRateDate" => $date
        ]);

        $url = $this->path_url.'/DoExport';
        $response = $this->connect($url, $data);
        return $response;
    }

    public function getGoods($categories, $lang=null){

        $data = array_merge($this->dataDefault(), [
            "infotype" => 6,
            "OnlyFree" => true,
            "CategoryId" => $categories,
            "lang" => $lang
        ]);

        $url = $this->path_url.'/DoExport';
        $response = $this->connect($url, $data);
        return $response;
    }

    public function getVendors($lang=null){

        $data = array_merge($this->dataDefault(), [
            "infotype" => 6,
            "lang" => $lang
        ]);

        $url = $this->path_url.'/GetVendors';
        $response = $this->connect($url, $data);
        return $response;
    }

    public function getActions($lang=null){

        $data = array_merge($this->dataDefault(), [
            "infotype" => 8,
            "lang" => $lang
        ]);

        $url = $this->path_url.'/DoExport';
        $response = $this->connect($url, $data);
        return $response;
    }

    public function getCodeCategories($lang=null){

        $data = array_merge($this->dataDefault(), [
            "lang" => $lang
        ]);

        $url = $this->path_url.'/GetCategories';
        $response = $this->connect($url, $data);
        return $response;
    }



}
