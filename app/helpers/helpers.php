<?php

/**
 * This function will six characters long
 *
 * @return string
 */
function generateOTP(){
    return mt_rand(111111,999999);
}

/**
 * This function will remove the html special characters
 *
 * @param  string $spl_chars
 * @return string
 */
function htmlEntityDecode($spl_chars){
    $temp_chars = html_entity_decode($spl_chars, ENT_QUOTES);
    if($temp_chars != $spl_chars){
        return htmlEntityDecode($temp_chars);
    }
    return $spl_chars;
}

/**
 * This function will generate random string
 *
 * @param  int $length
 * @return string
 */
function randomString($length){
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++){
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}

/**
 * This function will return the client ip adderess
 */
function getClientIp(){
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
