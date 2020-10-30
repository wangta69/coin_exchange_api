<?php
namespace Wangta69\CoinExchange;
use Illuminate\Http\Request;

class CoinExchangeMethod{

    public static function usecTime()
    {
        list($usec, $sec) = explode(' ', microtime());
        $usec = substr($usec, 2, 3);
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return $sec.$usec;
        }
        return intval($sec.$usec);
    }
}
