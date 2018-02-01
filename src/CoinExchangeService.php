<?php
namespace Pondol\CoinExchange;
use Illuminate\Http\Request;

use Pondol\CoinExchange\BithumbApiService;
use Pondol\CoinExchange\CoinoneApiService;

class CoinExchangeService{
        
    public static function callBithumbApi(Request $request){
        
        $api_url   = $request->api_url;//'user_transactions';
        $api_key   = $request->key;//'user_transactions';
        $api_secret   = $request->secret;//'user_transactions';
        $reqParams   = $request->reqParams;

        $api = new BithumbApiService($api_key, $api_secret);

        $result = $api->xcoinApiCall($api_url, $reqParams);//회원거래내역(실제 거래가 이루어진 것)
        return $result;
       
    }
    
    
    public static function callCoinoneApi(Request $request){

        $api_url    = $request->api_url;//'user_transactions';
        $access_token    = $request->key;//'user_transactions';
        $secret_key   = $request->secret;//'user_transactions';
        $reqParams   = $request->reqParams;
        
        $api_url    = "/transaction/history/";
        $access_token    = "5231d28d-4fa7-4c90-980a-afa8c3eaf3e9";
        $secret_key    = "152b3892-78c8-4d8a-ac82-e2f6f1e44ff9";
        
        $api = new CoinoneApiService($access_token, $secret_key);

        $result = $api->xcoinApiCall($api_url, $reqParams);//회원거래내역(실제 거래가 이루어진 것)
        return $result;
       
    }
}
    