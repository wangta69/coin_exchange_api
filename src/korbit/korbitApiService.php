<?php
namespace Wangta69\CoinExchange;

use Wangta69\Curl\CurlService;

class KorbitApiService {// extends \App\Http\Controllers\Controller
	protected $api_host_v1 = "https://api.korbit.co.kr/v1";


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
        $api_url = $this->api_host_v1.$uri;
        $curl = new CurlService();
        $curl->request($method, $api_url, $params);//
        return json_decode($curl->body());
    }


}//end class BithumbApiService
