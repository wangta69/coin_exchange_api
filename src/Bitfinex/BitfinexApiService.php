<?php
namespace Wangta69\CoinExchange;

use Wangta69\Curl\CurlService;
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
     * `${url}/tickers?symbols=tBTCUSD,tLTCUSD,fUSD`,
     */
    public function publicApi($method, $endpoint, $params=[]){

        $api_url = $this->api_host.$endpoint;
        $curl = new CurlService();
        $curl->request($method, $api_url, $params);//
        return json_decode($curl->body());
    }


    public function get_symbols(){
        $method = 'GET';
        $params = null;
        $api_url = 'https://api.bitfinex.com/v1/symbols';
        $curl = new CurlService();
        $curl->request($method, $api_url, $params);//
        return json_decode($curl->body());
    }
}//end class BithumbApiService
