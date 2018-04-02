<?php
namespace Pondol\CoinExchange;

use Pondol\Curl\CurlService;
//limit requests to no more than 10 per minute.
class BitfinexApiService {// extends \App\Http\Controllers\Controller
	protected $api_host = "https://api.bitfinex.com/v2";



	public function __construct() {}

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
        $curl = new CurlService();
        $curl->request($method, $api_url, $params);//
        return json_decode($curl->body());
    }
    
    //USDT market
    //simbol : BTCUSDT 
    //BTC, ETH, BNB, NEO, LTC, BCC, QTUM
    //simbol : TRXBTC 
}//end class BithumbApiService 