<?php
namespace Pondol\CoinExchange;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Response;

//use Pondol\CoinExchange\BithumbApiService;
use Pondol\CoinExchange\CoinExchangeService;

class CoinExchangeController extends \App\Http\Controllers\Controller {
        
    public function callApi(Request $request){
        $result = CoinExchangeService::callApi($request);//회원거래내역(실제 거래가 이루어진 것)
        return Response::json($result, 200);
       
    }
}
    