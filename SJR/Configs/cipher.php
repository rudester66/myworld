<?php

namespace SJR\Configs;

class cipher
{
    const CIPHER = "AES-256-CBC";
    const KEY = 'AA74CDCC2BBRT935136HH7B63C27';     // user define private key
    const IV = '5fgf5HJ5g27';                       // user define secret key

    public function __construct()
    {
    }

    static public function cipher($string)
    {
        $keyIV = self::keyIV();
        $output = openssl_encrypt($string, self::CIPHER,  $keyIV['key'], 0, $keyIV['iv']);
        return base64_encode($output);
    }

    static public function uncipher($string)
    {
        $keyIV = self::keyIV();
        return openssl_decrypt(base64_decode($string), self::CIPHER, $keyIV['key'], 0, $keyIV['iv']);
    }

    static private function keyIV(){
        return array(
            'key' => hash('sha256', self::KEY),
            'iv' => substr(hash('sha256', self::IV), 0, 16), // sha256 is hash_hmac_algo
        );
    }


}