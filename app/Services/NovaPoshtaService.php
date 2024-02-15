<?php

namespace App\Services;

use Daaner\NovaPoshta\Models\Address;
use phpDocumentor\Reflection\Types\This;

class NovaPoshtaService
{
    protected $address;
    public function __construct(Address $address)
    {
        $this->address = $address;
    }

//    public function searchCity_($key)
//    {
//
//        //return $this->getCities($key);
//
//        $data = $this->address->searchSettlements($this->cleanData($key));
//
//        if ($data['success']){
//            $result = $data['result'][0]['Addresses'];
//
//            return array_map(function ($item){
//                return [
//                    'name' => $item['MainDescription'],
//                    'description' => $item['Present'],
//                    'ref' => $item['Ref']
//                ];
//            }, $result);
//
//        }
//
//        return null;
//    }
//
//    public function getWarehouses_($city_ref, $page)
//    {
//        //return $this->getWarehouse2($city_ref, $page);
//
//        $data = $this->address->getWarehouseSettlements($city_ref);
//
//        if ($data['success']) {
//            $result = $data['result'];
//
//            return array_map(function ($item){
//                return [
//                    'name' => $item['ShortAddress'],
//                    'name_ru' => $item['ShortAddressRu'],
//                    'description' => $item['Description'],
//                    'description_ru' => $item['DescriptionRu'],
//                    'ref' => $item['Ref']
//                ];
//            }, $result);
//
//        }
//
//        return $data;
//
//    }

    protected function cleanData($str)
    {
        return trim($str);
    }

    public function searchCity($key)
    {
        $data = $this->address->getCities($this->cleanData($key));


        if ($data['success']){
            $items = $data['result'];

           return array_map(function ($item){
//                return [
//                    'name' => $item[$this->getNameKeyLang('Description')],
//                    'type' => $item[$this->getNameKeyLang('SettlementTypeDescription')],
//                    'area' => $item[$this->getNameKeyLang('AreaDescription')],
//                    'ref' => $item['Ref']
//                ];

               $type = $this->getCityType($item[$this->getNameKeyLang('SettlementTypeDescription')]);
               $city = $item[$this->getNameKeyLang('Description')];
               $area = $item[$this->getNameKeyLang('AreaDescription')].' обл.';

               return [
                   'name' => $type.' '.$city.' '.$area,
                   'ref' => $item['Ref']
               ];

            }, $items);

        }

        return null;
    }

    public function getWarehouses($ref, $page=1)
    {
        $part = 50;
        $this->address->setLimit($part);
        $this->address->setPage($page);

        $data = $this->address->getWarehouses($ref, false);

       // $maxPage = ceil($data['info']['info']['totalCount'] / $part);

        //dd($data);

        if ($data['success']) {
            $items = $data['result'];

            $res = [];
            foreach ($items as $item){
                $res[$item['Number']] = [
                    'name' => $item[$this->getNameKeyLang('Description')],
//                    //'short' => $item[$this->getlocale('ShortAddress')],
                    'ref' => $item['Ref']
                ];
            }
            return $res;
        }
        return null;
    }

    protected function getNameKeyLang($string)
    {
       $locale = app()->getLocale();

       if ($locale === 'ru'){
           return $string.'Ru';
       }

       return $string;
    }

    protected function getCityType($type)
    {
        switch ($type) {
            case 'село':
                return 'c.';
            case 'поселок городского типа':
                return 'пгт.';
            case 'селище міського типу':
                return 'смт.';
            case 'город':
                return 'г.';
            case 'місто':
                return 'м.';
        }
        return $type;
    }

}