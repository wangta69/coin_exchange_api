<?php
namespace Wangta69\CoinExchange;

use Wangta69\Curl\CurlService;

class CoincheckApiService {// extends \App\Http\Controllers\Controller
	protected $api_host = "https://coincheck.com/api";


	public function __construct() {}

    public function set_private(){

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


}//end class BithumbApiService
