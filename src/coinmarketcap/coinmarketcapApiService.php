<?php
namespace Pondol\CoinExchange;

use Pondol\Curl\CurlService;

class CoinmarketcapApiService {// extends \App\Http\Controllers\Controller
	protected $api_host = "https://api.coinmarketcap.com/v1";

	//protected $pubkey;
	//protected $prikey;

	public function __construct() {}
/*
    public function set_private($pubkey, $prikey){
        $this->pubkey = $pubkey;
        $this->prikey = $prikey;
    }
    */
    /**
     * public Api Call
     * @param $method String POST/GET/DELETE...
     * @param $uri String "/uri"
     * @param $params Array ['body', 'headers']
     * @return Json Object 
     */
    public function publicApi($method, $uri, $params=[]){
        
        $api_url = $this->api_host.$uri;
        echo $api_url;
        $curl = new CurlService();
        $curl->request($method, $api_url, $params);//
        return json_decode($curl->body());
    }
    



    
    

}//end class BithumbApiService 