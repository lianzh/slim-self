<?php

namespace SelfApp\Helper;

final class Uuid
{

	public static function build()
	{
		static $being_timestamp = 1421833799;
		static $mask = '0123456789abcdefghijklmnopqrstuvwxyz';
		static $suffix_len = 3

	    $time = explode(' ', microtime());
	    $id = ($time[1] - $being_timestamp) . sprintf('%06u', substr($time[0], 2, 6));
	    if ($suffix_len > 0) {
	        $id .= substr(sprintf('%010u', mt_rand()), 0, $suffix_len);
	    }

	    $si = explode(' ', php_uname());
        $sn = $si[0] == 'Windows' ? $si[2] : $si[1];
        if (empty($sn)) {
            $sn = '--';
        }

        $sn = trim(str_replace(' ', '-', $sn));
        $x = sprintf("%u", crc32("{$sn}/{$id}"));

	    $m = '';
	    while ($x > 0) {
	        $s = $x % 36;
	        $m .= $mask[$s];
	        $x = floor($x / 36);
	    }
	    return $m;
	}

}