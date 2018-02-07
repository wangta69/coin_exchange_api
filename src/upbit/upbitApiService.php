<?php
namespace Pondol\CoinExchange;

use Pondol\Curl\CurlService;

class UpbitApiService {// extends \App\Http\Controllers\Controller
	protected $api_host_v1 = "https://crix-api-endpoint.upbit.com/v1";


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