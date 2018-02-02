<?php
namespace Pondol\CoinExchange;

use Pondol\Curl\CurlService;

class BithumbApiService {// extends \App\Http\Controllers\Controller
	protected $api_url = "https://api.bithumb.com";

	protected $api_key;
	protected $api_secret;

	public function __construct($api_key, $api_secret) {
		$this->api_key = $api_key;
		$this->api_secret = $api_secret;

	}

	/**
	 * @param String $endpoint :  Api Detail Url except First
     * @param Array $params : params for Request
	 * @return JsonObject 
	 */
	public function xcoinApiCall($endpoint, $params=null) {
		
		$rgParams = array(
				'endpoint'	=> $endpoint
		);

		if($params) {
			$rgParams = array_merge($rgParams, $params);
		}

		$api_host		= $this->api_url . $endpoint;
		$httpHeaders	= $this->_getHttpHeaders($endpoint, $rgParams, $this->api_key, $this->api_secret);
		
        $curl = new CurlService();
        $curl->request('POST', $api_host, ['body'=>$rgParams, 'headers'=>$httpHeaders]);//

        return json_decode($curl->body());

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

    private function _getHttpHeaders($endpoint, $rgData, $apiKey, $apiSecret)
    {

        $strData    = http_build_query($rgData);
        $nNonce     = $this->usecTime();
        return array(
            'Api-Key: ' . $apiKey,
            'Api-Sign:' . base64_encode(hash_hmac('sha512', $endpoint . chr(0) . $strData . chr(0) . $nNonce, $apiSecret)),
            'Api-Nonce:' . $nNonce
        );
    }

}//end class BithumbApiService 