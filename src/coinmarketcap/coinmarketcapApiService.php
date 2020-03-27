<?php
namespace Pondol\CoinExchange;

use Pondol\Curl\CurlService;
//limit requests to no more than 10 per minute.
class CoinmarketcapApiService {// extends \App\Http\Controllers\Controller
	protected $api_host = "https://pro-api.coinmarketcap.com/v1";
    protected $graph_host = "https://graphs2.coinmarketcap.com/currencies";

	//protected $pubkey;
	//protected $prikey;

	public function __construct() {}
    public function set_key($apiKey){
        $this->apikey = $apiKey;
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
        $params['headers'] = [
          'Accepts: application/json',
          'X-CMC_PRO_API_KEY: '. $this->apikey
      ];

        $curl->request($method, $api_url, $params);//
        return json_decode($curl->body());
    }


    /**
     * public Api Call
     * @param $coin : bitcoin....
     * @param $startDt : 1488161968000;
     * @param $endDt 1519697968000
     * @return Json Object
     */
    public function publicGraphApi($coin, $startDt, $endDt){
        //https://graphs2.coinmarketcap.com/currencies/bitcoin/1488161968000/1519697968000/
        $api_url = $this->graph_host."/".$coin."/".$startDt."/".$endDt;
        $curl = new CurlService();
        $curl->request('GET', $api_url);//
        return json_decode($curl->body());
    }
}//end class BithumbApiService
