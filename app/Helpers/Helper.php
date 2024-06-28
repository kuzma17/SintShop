<?php

function cleanPhoneUrl($phone){
    $phone = preg_replace("(\()", "", $phone);
    $phone = preg_replace("(\))", "", $phone);
    $phone = preg_replace("/\s+/", "", $phone);
    return trim($phone);
}

function cleanPhone($phone){
    $phone = cleanPhoneUrl($phone);
    $phone = preg_replace("(\+38)", "", $phone);
//    $phone = preg_replace("(\()", "", $phone);
//    $phone = preg_replace("(\))", "", $phone);
//    $phone = preg_replace("/\s+/", "", $phone);
    return $phone;
}

function cleanText($text){
    $text = trim($text);

    return $text;
}

function randomName(){
    return bin2hex(random_bytes(10));
}

function getParametersRequest()
{
    $selectData = request()->all();
    $values = [];
    foreach ($selectData as $key=>$val){
        if ($key === 'sort'){
            $values[$key] = $val;
        }else{
            $data = explode(',', $val);
            $int_data = [];
            foreach ($data as $item){
                $int_data[] = (int)$item;
            }
            $values[$key] = $int_data;
        }
    }

    return $values;

}
