<?php

function cleanPhone($phone){
    $phone = preg_replace("(\+38)", "", $phone);
    $phone = preg_replace("(\()", "", $phone);
    $phone = preg_replace("(\))", "", $phone);
    $phone = preg_replace("/\s+/", "", $phone);
    return $phone;
}

function cleanText($text){
    $text = trim($text);


    return $text;
}
