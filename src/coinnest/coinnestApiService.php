<?php
namespace Wangta69\CoinExchange;

use Wangta69\Curl\CurlService;

class CoinnestApiService {// extends \App\Http\Controllers\Controller
	protected $api_host = "https://api.coinnest.co.kr";

	protected $pubkey;
	protected $prikey;

	public function __construct() {}

    public function set_private($pubkey, $prikey){
        $this->pubkey = $pubkey;
        $this->prikey = $prikey;
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

        $api_url        = $this->api_host . $uri;
        $httpHeaders    = $this->_getHttpHeaders($uri, $rgParams, $this->pubkey, $this->prikey);

        $curl = new CurlService();
        $curl->request('POST', $api_url, ['body'=>$this->wrapParam($params)]);//

        return json_decode($curl->body());
    }

    /**
     * Wrap Request Parmas
     */
    private function wrapParam($data=array()){
        # Public Key
        $data['key'] = $this->pubkey;
        # Increment Vars
        $mt = explode(' ', microtime());
        $data['nonce'] = $mt[1] . substr($mt[0], 2, 3);
        $signature = $this->makeSignature($data,$this->prikey);
        $data['signature'] = $signature;
        return $data;
    }


    /**
     * Generate Signature
     */
    private function makeSignature($data,$priKey){
        return hash_hmac('sha256', http_build_query($data), md5($priKey));
    }




}//end class BithumbApiService
