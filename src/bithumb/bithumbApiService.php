<?php
namespace Pondol\CoinExchange;

use Pondol\Curl\CurlService;
use Pondol\CoinExchange\CoinExchangeMethod;

class BithumbApiService {// extends \App\Http\Controllers\Controller
	protected $api_host = "https://api.bithumb.com";

	protected $api_key;
	protected $api_secret;

	public function __construct() {}

    public function set_private($api_key, $api_secret){
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
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
		
		$rgParams = array(
				'uri'	=> $uri
		);

		if($params) {
			$rgParams = array_merge($rgParams, $params);
		}

		$api_url		= $this->api_host . $uri;
		$httpHeaders	= $this->_getHttpHeaders($uri, $rgParams, $this->api_key, $this->api_secret);
		
        $curl = new CurlService();
        $curl->request('POST', $api_url, ['body'=>$rgParams, 'headers'=>$httpHeaders]);//

        return json_decode($curl->body());

	}

    private function _getHttpHeaders($uri, $rgData, $apiKey, $apiSecret)
    {
        $strData    = http_build_query($rgData);
        $nNonce     = CoinExchangeMethod::usecTime();
        return array(
            'Api-Key: ' . $apiKey,
            'Api-Sign:' . base64_encode(hash_hmac('sha512', $uri . chr(0) . $strData . chr(0) . $nNonce, $apiSecret)),
            'Api-Nonce:' . $nNonce
        );
    }

}//end class BithumbApiService 