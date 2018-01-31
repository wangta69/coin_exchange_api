<?php
namespace Pondol\CoinExchange;
use Illuminate\Http\Request;

use Pondol\CoinExchange\BithumbApiService;

class CoinExchangeService{
        
    public static function callApi(Request $request){
        
        $exchanger  = $request->exchanger;// = 'bithumb';
        $api_url   = $request->api_url;//'user_transactions';
        $api_key   = $request->key;//'user_transactions';
        $api_secret   = $request->secret;//'user_transactions';
        $reqParams   = $request->reqParams;

        $api = new BithumbApiService($api_key, $api_secret);

        $result = $api->xcoinApiCall($api_url, $reqParams);//회원거래내역(실제 거래가 이루어진 것)
        return $result;
       
    }
}
    