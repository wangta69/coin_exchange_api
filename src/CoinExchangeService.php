<?php
namespace Pondol\CoinExchange;
use Illuminate\Http\Request;

use Pondol\CoinExchange\BithumbApiService;
use Pondol\CoinExchange\CoinoneApiService;


/**
참조 API
(KR) coinone api : https://doc.coinone.co.kr/
(KR) bithumb api : https://www.bithumb.com/u1/US127
(KR) korbit api : https://apidocs.korbit.co.kr/ 
(KR) upbit : 공식 api가 존재 하지 않음  : https://steemit.com/kr/@segyepark/api
https://crix-api-endpoint.upbit.com/v1/crix/trades/ticks?code=CRIX.UPBIT.KRW-ETH&count=1
(CHI) huobipro : https://github.com/huobiapi/API_Docs_en/wiki/REST_Reference (24시간 전가격 없음)
(JP) coincheck https://coincheck.com/api/rate/all (24시간 전가격 없음)
 */

class CoinExchangeService{
        
    public static function callBithumbApi(Request $request){
        
        $api_url    = $request->api_url;//'user_transactions';
        $api_key    = $request->key;//'user_transactions';
        $api_secret = $request->secret;//'user_transactions';
        $reqParams  = $request->reqParams;

        $api = new BithumbApiService($api_key, $api_secret);

        $result = $api->xcoinApiCall($api_url, $reqParams);//회원거래내역(실제 거래가 이루어진 것)
        return $result;
       
    }
    
    
    public static function callCoinoneApi(Request $request){

        $api_url        = $request->api_url;//'user_transactions';
        $access_token   = $request->key;//'user_transactions';
        $secret_key     = $request->secret;//'user_transactions';
        $reqParams      = $request->reqParams;
        
        $api = new CoinoneApiService($access_token, $secret_key);

        $result = $api->xcoinApiCall($api_url, $reqParams);//회원거래내역(실제 거래가 이루어진 것)
        return $result;
       
    }
}
    