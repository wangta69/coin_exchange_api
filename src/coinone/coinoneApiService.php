<?php
namespace Pondol\CoinExchange;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Validator;
use Response;
use Auth;

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

	private function request($strHost, $strMemod='GET', $playload=array(), $httpHeaders=array())
	{
	    
        echo " ==============";
		$ch = curl_init();

		// SSL: 여부
		if(stripos($strHost, 'https://') !== FALSE) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		}

		if(strtoupper($strMemod) == 'HEAD') {
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'HEAD' );
			curl_setopt( $ch, CURLOPT_HEADER, 1 );
			curl_setopt( $ch, CURLOPT_NOBODY, true );
			curl_setopt( $ch, CURLOPT_URL, $strHost );
		}
		else {
			// POST/GET 설정
			//if(strtoupper($strMemod) == 'POST') {

				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_URL, $strHost);
				curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
				curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($playload));
                //curl_setopt($ch, CURLOPT_POSTFIELDS, $playload);
			//}
			//else {
			//	curl_setopt($ch, CURLOPT_URL, $strHost . ((strpos($strHost, '?') === FALSE) ? '?' : '&') . http_build_query($playload));
			//}
			curl_setopt($ch, CURLOPT_HEADER, 0);
		}
        
		if(isset($httpHeaders) && is_array($httpHeaders) && !empty($httpHeaders)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeaders);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		if( !$response = curl_exec($ch) ) {
			$response = curl_error($ch);
		}
		curl_close($ch);

		return $response;
	}


    private function _getHttpHeaders($payload, $secret_key)
    {

        $strData    = http_build_query($rgData);
        $nNonce     = $this->usecTime();
        return array(
            'Api-Key: ' . $apiKey,
            'Api-Sign:' . base64_encode(hash_hmac('sha512', $endpoint . chr(0) . $strData . chr(0) . $nNonce, $secret_key)),
            'Api-Nonce:' . $nNonce
        );
    }
    
    
/*
	private function _getHttpHeaders($endpoint, $rgData, $apiKey, $apiSecret)
	{

		$strData	= http_build_query($rgData);
		$nNonce		= $this->usecTime();
		return array(
			'Api-Key: ' . $apiKey,
			'Api-Sign:' . base64_encode(hash_hmac('sha512', $endpoint . chr(0) . $strData . chr(0) . $nNonce, $apiSecret)),
			'Api-Nonce:' . $nNonce
		);
	}
    */

	/*
	 * function		execute
	 * parameter	string, array
	 * return		object
	 */
	public function xcoinApiCall($endpoint, $params=null) {
		

		$rgParams = array(
				'endpoint'	=> $endpoint
		);

		if($params) {
			$rgParams = array_merge($rgParams, $params);
		}

		$api_host		= $this->api_url . $endpoint;
        
        
        echo $api_host.PHP_EOL;
        $access_token = '5231d28d-4fa7-4c90-980a-afa8c3eaf3e9';
        $secret_key = '152b3892-78c8-4d8a-ac82-e2f6f1e44ff9';
        $payload = ["access_token"=> $access_token,  "currency"=> "btc",  "nonce"=> 1517469209916 ];
        $encoded_payload = base64_encode(json_encode($payload));
        
       // echo $encoded_payload;
        $signature = hash_hmac('sha512', $encoded_payload, strtoupper($secret_key));
        echo $signature;
      //  base64_encode(hash_hmac('sha512', $endpoint . chr(0) . $strData . chr(0) . $nNonce, $apiSecret)),
  
/*    
        var signature = crypto
  .createHmac("sha512", SECRET_KEY.toUpperCase())
  .update(payload)
  .digest('hex');
  
  */
  
  $httpHeaders = [
  'content-type'=>'application/json',
  'X-COINONE-PAYLOAD'=> $encoded_payload,
  'X-COINONE-SIGNATURE'=> $signature
];

print_r($httpHeaders);

/*
console.log(headers);
var options = {
  url: url,
  headers: headers,
  body: payload
};

request.post(options,
  function(error, response, body) {
    console.log(body);
});

*/


		//$httpHeaders	= $this->_getHttpHeaders($endpoint, $rgParams, $this->access_token, $this->secret_key);
		//$httpHeaders  = $this->_getHttpHeaders($encoded_payload, $this->secret_key);
		//$rgResult = $this->request($api_host, 'POST', $payload, $httpHeaders);
        $rgResult = $this->request($api_host, 'POST', array('data'=>$encoded_payload), $httpHeaders);
		$rgResultDecode = json_decode($rgResult);


		return $rgResultDecode;

	}
    
    
    

}//end class CoinoneApiService 