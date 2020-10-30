<?php
namespace Wangta69\CoinExchange;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Response;
use View;
//use Wangta69\CoinExchange\BithumbApiService;
use Wangta69\CoinExchange\CoinExchangeService;

class CoinExchangeFormController extends \App\Http\Controllers\Controller {

    public function callApi(Request $request, $exchanger){


        //현재 내용을 받아서 적당한 폼을 생성하여 웹으로 돌려준다.

       // $exchanger  = $request->exchanger;// = 'bithumb';
       // $api_url    = $request->api_url;//'user_transactions';
       // $reqParams  = $request->reqParams;

        switch($exchanger){
            case "bithumb":
                $result = CoinExchangeService::callBithumbApi($request);
                return $this->bithumb($request, $result);
                break;
            case "coinone":
                $result = CoinExchangeService::callCoinoneApi($request);
                return $this->coinone($request, $result);
                break;
        }

    }


    //COINONE START
    private function coinone (Request $request, $result){
        $api_url    = $request->api_url;//'user_transactions';
        switch($api_url){
            case "/account/user_info/"://회원 정보
                return $this->coinone_account($request, $result);
                break;
            case "/transaction/history/"://회원거래내역
                return $this->coinone_user_transactions($request, $result);
                break;
            default:
                return Response::json($result, 200);
                break;
        }
    }

     /**
     * COINONE /info/account 회원 정보
     */
    private function coinone_account(Request $request, $result){
        return view('coinexchange::account', ['item'=>$result->userInfo, 'request'=>$request, 'exchanger'=>'coinone']);

    }

    /**
     * COINONE /info/user_transactions 회원거래내역
     */
    private function coinone_user_transactions(Request $request, $result){

        foreach ($result->data as $index => $item){

            $item->search_str = $this->code['bithumb']['search'][$item->search];
            $item->krw_currency = $this->ch_currency_to_krw($item, $request->reqParams['currency']);
            $item->currency_remain = $this->ch_currency_remain($item, $request->reqParams['currency']);
        }
        return view('coinexchange::transactions', ['data'=>$result->data, 'request'=>$request]);

    }

    //COINONE END

    //BITHUMB START
    private function bithumb(Request $request, $result){
        $api_url    = $request->api_url;//'user_transactions';


        switch($api_url){
            case "/info/account"://회원 정보
                return $this->bithumb_account($request, $result);
                break;
            case "/info/user_transactions"://회원거래내역
                return $this->bithumb_user_transactions($request, $result);
                break;
            default:
                return Response::json($result, 200);
                break;
        }
    }
    //private $code = array('bithumb'=>array('search'=>array('0' => '전체', '1' => '구매완료', '2' => '판매완료', '3' => '출금중', '4' => '입금', '5' => '출금', '9' => 'KRW입금중')));
    private $code = array('bithumb'=>array('search'=>array(0 => '전체', 1 => '구매완료', 2 => '판매완료', 3 => '출금중', 4 => '입금', 5 => '출금', 9 => 'KRW입금중')));



    /**
     * BITHUMB /info/account 회원 정보
     */
    private function bithumb_account(Request $request, $result){
        return view('coinexchange::account', ['item'=>$result->data, 'request'=>$request, 'exchanger'=>'bithumb']);

    }

    /**
     * BITHUMB /info/user_transactions 회원거래내역
     */
    private function bithumb_user_transactions(Request $request, $result){

        foreach ($result->data as $index => $item){

            $item->search_str = $this->code['bithumb']['search'][$item->search];
            $item->krw_currency = $this->ch_currency_to_krw($item, $request->reqParams['currency']);
            $item->currency_remain = $this->ch_currency_remain($item, $request->reqParams['currency']);
        }
        return view('coinexchange::transactions', ['data'=>$result->data, 'request'=>$request]);

    }


    private function ch_currency_to_krw($item, $currency){
        switch($currency){
            case 'BTC':return $item->btc1krw;break;//비트코인
            case 'ETH':return $item->eth1krw;break;//이더리움
            case 'DASH':return $item->dash1krw;break;//대시
            case 'LTC':return $item->ltc1krw;break;//라이트코인
            case 'ETC':return $item->etc1krw;break;//이더리움 클래식
            case 'XRP':return $item->xrp1krw;break;//리플
            case 'BCH':return $item->bch1krw;break;//비트코인 캐시
            case 'XMR':return $item->xmr1krw;break;//모네로
            case 'ZEC':return $item->zec1krw;break;//제트캐시
            case 'QTUM':return $item->qtum1krw;break;//퀀텀
        }
    }

    private function ch_currency_remain($item, $currency){
        switch($currency){
            case 'BTC':return $item->xrp_remain;break;//비트코인
            case 'ETH':return $item->eth_remain;break;//이더리움
            case 'DASH':return $item->dash_remain;break;//대시
            case 'LTC':return $item->ltc_remain;break;//라이트코인
            case 'ETC':return $item->etc_remain;break;//이더리움 클래식
            case 'XRP':return $item->xrp_remain;break;//리플
            case 'BCH':return $item->bch_remain;break;//비트코인 캐시
            case 'XMR':return $item->xmr_remain;break;//모네로
            case 'ZEC':return $item->zec_remain;break;//제트캐시
            case 'QTUM':return $item->qtum_remain;break;//퀀텀
        }
    }

    //BITHUMB END
}
