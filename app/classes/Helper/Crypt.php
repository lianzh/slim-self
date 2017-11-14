<?php

namespace SelfApp\Helper;

class Crypt
{

    /**
     * encode string with secret_key
     * 
     * @param  string $string
     * @param  string $secret_key
     * 
     * @return string 
     */
    public static function encode($string, $secret_key = 'selfapp')
    {
        $encode_str = '';
        $base64_str = base64_encode($string);
        $base64_str_len = strlen($base64_str);
        $base64_key = base64_encode($secret_key);
        $base64_key_len = strlen($base64_key);

        for ($i = 0; $i < $base64_str_len; $i++) {
            $str_ord = ord($base64_str[$i]);
            $key_ord = ord($base64_key[$i % $base64_key_len]);
            $ord = $str_ord ^ $key_ord;
            $chr = chr($ord);
            $encode_str .= $chr;
        }

        return base64_encode($encode_str);
    }

    /**
     * decode string with secret_key
     * 
     * @param  string $string
     * @param  string $secret_key
     * 
     * @return string 
     */
    public static function decode($string, $secret_key = 'selfapp')
    {
        $decode_str = '';

        $base64_str = base64_decode($string);
        $base64_str_len = strlen($base64_str);
        $base64_key = base64_encode($secret_key);
        $base64_key_len = strlen($base64_key);

        for ($i = 0; $i < $base64_str_len; $i++) {
            $ord = ord($base64_str[$i]);
            $key_ord = ord($base64_key[$i % $base64_key_len]);
            $str_ord = $ord ^ $key_ord;
            $chr = chr($str_ord);
            $decode_str .= $chr;
        }

        return base64_decode($decode_str);
    }

}