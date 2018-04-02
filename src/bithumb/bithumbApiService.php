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
     * chartApi
     * https://www.bithumb.com/resources/chart/BTC_xcoinTrade_01M.json?from=1520998281&to=1521084741
     * https://www.bithumb.com/resources/chart/[CURRENCY]_xcoinTrade_[TIME-GAP].json?from=1520998281&to=1521084741
     * TIME-GAP : 01M(1분), 10M - 10분(1일), 30M - 30분(1주간), 1H - 1시간(1개월),  6H -6시간(3개월), 24H(2년, 1년, 6개월), 
     * @param Array $params array[currency, from, to]
     */
    public function chartApi($params=[]){
        //$method = isset(method) ? $params['method']:'GET';
        $currency = isset($params['currency']) ? $params['currency']:'BTC';
        $to = isset($params['to']) ? $params['to']:time();
        $from = isset($params['from']) ? $params['from']:($to - 60*60*24*3);//default : 3day date
        $tick_gap = isset($params['tick_gap']) ? $params['tick_gap']:'01M';
        
         $api_url = 'https://www.bithumb.com/resources/chart/'.$currency.'_xcoinTrade_'.$tick_gap.'.json?from='.$from.'&to='.$to;
 
        $curl = new CurlService();
        $curl->request('GET', $api_url);//
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