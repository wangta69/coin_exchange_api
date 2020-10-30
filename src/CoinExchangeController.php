<?php
namespace Wangta69\CoinExchange;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Response;

//use Wangta69\CoinExchange\BithumbApiService;
use Wangta69\CoinExchange\CoinExchangeService;

class CoinExchangeController extends \App\Http\Controllers\Controller {

    //public function callBithumbApi(Request $request){
    public function callApi(Request $request, $exchanger){
        switch($exchanger){
            case 'bithumb':
                $result = CoinExchangeService::callBithumbApi($request);//회원거래내역(실제 거래가 이루어진 것)
                return Response::json($result, 200);
                break;
            case 'coinone':
                $result = CoinExchangeService::callCoinoneApi($request);//회원거래내역(실제 거래가 이루어진 것)
                return Response::json($result, 200);
                break;
        }

    }
}
