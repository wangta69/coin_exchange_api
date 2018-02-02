<?php
namespace Pondol\CoinExchange;

use Pondol\Curl\CurlService;

class CoinoneApiService {// extends \App\Http\Controllers\Controller
	protected $api_url = "https://api.coinone.co.kr/v2";///transaction/history/

	protected $access_token;
	protected $secret_key;

	public function __construct($access_token, $secret_key) {
		$this->access_token = $access_token;
		$this->secret_key = $secret_key;

	}


	
	private function usecTime() 
	{
		list($usec, $sec) = explode(' ', microtime());
		$usec = substr($usec, 2, 3); 
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return $sec.$usec;
		}
		return intval($sec.$usec);
	}
    
    /**
     * @param String $endpoint :  Api Detail Url except First
     * @param Array $params : params for Request
     * @return JsonObject 
     */
	public function xcoinApiCall($endpoint, $params=null) {
		
		$api_host		= $this->api_url . $endpoint;

        $params = ["access_token"=> $this->access_token,  "currency"=> "btc",  "nonce"=> $this->usecTime() ];
        
        $payload = base64_encode(json_encode($params));
        
       // echo $encoded_payload;
        $signature = hash_hmac('sha512', $payload, strtoupper($this->secret_key));

        $httpHeaders = [
            'X-COINONE-PAYLOAD: ' . $payload,
            'X-COINONE-SIGNATURE: ' . $signature
        ];

		$curl = new CurlService();
        $curl->requestJson('POST', $api_host, ['body'=>$payload, 'headers'=>$httpHeaders]);//

        return json_decode($curl->body());


	}
    
    
    

}//end class CoinoneApiService 