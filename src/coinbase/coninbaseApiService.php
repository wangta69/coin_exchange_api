<?php
namespace Pondol\CoinExchange;

use Pondol\Curl\CurlService;
//limit requests to no more than 10 per minute.
class CoinBaseApiService {// extends \App\Http\Controllers\Controller
	protected $api_host = "https://api.coinbase.com/v2";


// buy : GET https://api.coinbase.com/v2/prices/:currency_pair/buy    currency_pair : BTC-USD
// sell : GET https://api.coinbase.com/v2/prices/:currency_pair/sell
	public function __construct() {
	    $this->curl = new CurlService();
	}

    /**
     * public Api Call
     * @param $method String POST/GET/DELETE...
     * @param $endpoint String "/uri"
     * @param $params Array ['body', 'headers']
     * @return Json Object
     * /api/v1/ticker/24hr return all basic on BTC
     */
    public function publicApi($method, $endpoint, $params=[]){

        $api_url = $this->api_host.$endpoint;
       // $curl = new CurlService();
       // $curl->request($method, $api_url, $params);//
        $this->curl->request($method, $api_url, $params);//
        return json_decode($this->curl->body());
    }

        // return

    public function get_response(){
        return $this->curl->get_response();
    }

    public function info(){
        return $this->curl->info();
    }

     public function http_code(){
        return $this->curl->http_code();
    }

    public function header_size(){
        return $this->curl->header_size();
    }

    public function header(){
        return $this->curl->header();
    }

    public function body(){
        return $this->curl->body();
    }

    public function err_message(){
        return $this->curl->err_message();
    }



    //USDT market
    //simbol : BTCUSDT
    //BTC, ETH, BNB, NEO, LTC, BCC, QTUM
    //simbol : TRXBTC
}//end class BithumbApiService
