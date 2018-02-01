<?php
namespace Pondol\CoinExchange;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Response;
use View;
//use Pondol\CoinExchange\BithumbApiService;
use Pondol\CoinExchange\CoinExchangeService;

class CoinExchangeFormController extends \App\Http\Controllers\Controller {
        
    public function callApi(Request $request){
        $result = CoinExchangeService::callApi($request);//회원거래내역(실제 거래가 이루어진 것)
        //현재 내용을 받아서 적당한 폼을 생성하여 웹으로 돌려준다.
        
        $exchanger  = $request->exchanger;// = 'bithumb';
       // $api_url    = $request->api_url;//'user_transactions';
       // $reqParams  = $request->reqParams;
        
        switch($exchanger){
            case "bithumb":
                return $this->bithumb($request, $result);
                break;
        }
       
    }
    
    private function bithumb(Request $request, $result){
        $api_url    = $request->api_url;//'user_transactions';
        

        switch($api_url){
            case "/info/user_transactions":
                return $this->bithumb_user_transactions($request, $result);
                break;
        }
    }
    
    private function bithumb_user_transactions(Request $request, $result){
        
        print_r($result->data);
        return view('coinexchange::transactions', ['data'=>$result->data]);
        
    }
}
    
    
    