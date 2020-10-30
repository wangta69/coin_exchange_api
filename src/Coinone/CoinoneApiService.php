<?php
namespace Wangta69\CoinExchange;

use Wangta69\Curl\CurlService;
use Wangta69\CoinExchange\CoinExchangeMethod;

class CoinoneApiService {
	protected $api_host = "https://api.coinone.co.kr";
    protected $api_host_v2 = "https://api.coinone.co.kr/v2";
	protected $access_token;
	protected $secret_key;


    public function __construct() {}

    public function set_private($api_key, $api_secret){
        $this->access_token = $api_key;
        $this->secret_key = $api_secret;
    }


        /**
     * public Api Call
     * @param $method String POST/GET/DELETE...
     * @param $uri String "/uri"
     * @param $params Array ['body', 'headers']
     * @return Json Object
     */
    public function publicApi($method, $uri, $params=[]){
        $api_url = $this->api_host.$uri;
        $curl = new CurlService();
        $curl->request($method, $api_url, $params);//
        return json_decode($curl->body());
    }


    /**
     * @param String $uri :  Api Detail Url except First
     * @param Array $params : params for Request
     * @return JsonObject
     */
	public function privateApiCall($uri, $params=null) {

		$api_url		= $this->api_host_v2 . $uri;

        $params = ["access_token"=> $this->access_token,  "currency"=> "btc",  "nonce"=> CoinExchangeMethod::usecTime() ];

        $payload = base64_encode(json_encode($params));

       // echo $encoded_payload;
        $signature = hash_hmac('sha512', $payload, strtoupper($this->secret_key));

        $httpHeaders = [
            'X-COINONE-PAYLOAD: ' . $payload,
            'X-COINONE-SIGNATURE: ' . $signature
        ];

		$curl = new CurlService();
        $curl->requestJson('POST', $api_url, ['body'=>$payload, 'headers'=>$httpHeaders]);//

        return json_decode($curl->body());
	}


        /**
     * chartApi
     * https://crix-api-endpoint.upbit.com/v1/crix/candles/minutes/1?code=CRIX.UPBIT.KRW-BTC&count=2&to=2017-12-27 05:10:00
     * https://crix-api-endpoint.upbit.com/v1/crix/candles/minutes/[분단위]?code=CRIX.UPBIT.KRW-[CURRENCY]&count=[가져올 갯수]&to=[시작일]
     * 분단위 : 1, 5, 10, 30, 60
     * @param Array $params array[tick_gap, currency, count, to]
     */
    public function chartApi($params=[]){
        //$method = isset(method) ? $params['method']:'GET';
        $currency = isset($params['currency']) ? $params['currency']:'BTC';
        $to = isset($params['to']) ? $params['to']:date("Y-m-d H:i:s");
        $count = isset($params['count']) ? $params['count']:(60*24*3);//default : 3day date
        $tick_gap = isset($params['tick_gap']) ? $params['tick_gap']:'1';

        //$api_url = $this->api_host_v1.'/crix/candles/minutes/'.$tick_gap.'?code=CRIX.UPBIT.KRW-'.$currency.'&count='.$count.'&to='.$to;
        $api_url = 'https://coinone.co.kr/chart/olhc/?site=coinone&type=1m';
        $curl = new CurlService();

        $headers = [];
        //$headers[] = 'Host: coinone.co.kr';
        $headers[] = 'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:33.0) Gecko/20100101 Firefox/33.0';
        $headers[] = 'Accept: */*';
        //$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $headers[] = 'Accept-Language: en-GB,en-US;q=0.8,en;q=0.6';
        $headers[] = 'Accept-Encoding: gzip, deflate, sdch';//#remove this line for readable/greppable formatting
        //$headers[] = 'Accept-Encoding: gzip, deflate';//#remove this line for readable/greppable formatting
        //$headers[] = 'Content-Encoding: gzip';
       // $headers[] = 'Referer: https://coinone.co.kr/support/';
        //$headers[] = 'Cookie: all required cookies will appear here';
        //$headers[] = 'Connection: keep-alive';


        $curl->request('GET', $api_url, ['cookies'=>true, 'headers'=>$headers]);//

        print_r($curl->body());
        return json_decode($curl->body());
    }
}//end class CoinoneApiService
