<?php
namespace Pondol\CoinExchange;

use Pondol\Curl\CurlService;
use Pondol\CoinExchange\CoinExchangeMethod;

class CoinrailApiService {
	protected $api_host = "https://api.coinrail.co.kr";

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
		
		$api_url		= $this->api_host . $uri;

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
}//end class CoinoneApiService 