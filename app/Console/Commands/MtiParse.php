<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;

class MtiParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mti-parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MTI Parse';

    /**
     * Execute the console command.
     */

   protected function hexbin($temp)
    {
        $data = '';
        $len = strlen($temp);
        for ($i=0; $i < $len; $i+=2) {
            $data .= chr(hexdec(substr($temp,$i,2)));
        }
        return $data;
    }
    protected function signatureRequest($company, $key, $command, $time)
    {
        $str = $time.$command.$company.$key;
        return base64_encode($this->hexbin(sha1($str)));
    }

    public function handle(Client $client)
    {
        $key = 'CD4F4E1C-C8DF-4CDF-9925-0F40731BD87E'; //ключ
        $company = 251849; //идентификатор компании
        $time = date('d.m.Y H:i:s'); //текущая дата
        $command = 'PRICE'; //имя комманды (RESERVE_GET, ORDER_PUT, ORDER_STATUS, PRICE ...)
        $params = '<store_id>W600</store_id>'; //xml параметры

         //xml тело запроса
         $xml = '<?xml version="1.0" encoding="UTF-8"?>
         <request>
             <type>'.$command.'</type>
             <time>'.$time.'</time>
             <company>'.$company.'</company>
             <signature>'.$this->signatureRequest($company, $key, $command, $time).'</signature>
             <params>'.$params.'</params>
         </request>';

         $url = 'https://api.mti.ua/'; //адрес api

//         $ch = curl_init($url);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//         curl_setopt($ch, CURLOPT_POST, 1);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//         $output = curl_exec($ch); //ответ
//         curl_close($ch);


        $params = [
            'headers' => [
                'Content-Type' => 'text/xml; charset=UTF8',
            ],
            'body' => $xml,
        ];

        $response = $client->request('POST', $url, $params);
        $output = $response->getBody();


//        $xml   = simplexml_load_string($output);
//        $array = json_decode(json_encode((array) $xml), true);
//        $array = array($xml->getName() => $array);
        $xml = new \SimpleXMLElement($output);

        //dd($xml->result->children()[99022]);

        dd($xml->result->categorylist);

        $i=0;
        foreach ($xml->result->children() as $item){

           if ($i == 10){
               dd($item);
           }
          //  $this->info($item->name);

            $i++;
        }

        //$this->info($xml->result->children()[174]->products->product[0]->model);
    }
}
