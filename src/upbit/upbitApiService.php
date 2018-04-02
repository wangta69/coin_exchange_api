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
    
    
    /**
     * chartApi
     * https://crix-api-endpoint.upbit.com/v1/crix/candles/minutes/1?code=CRIX.UPBIT.KRW-BTC&count=2&to=2017-12-27 05:10:00
     * https://crix-api-endpoint.upbit.com/v1/crix/candles/minutes/[분단위]?code=CRIX.UPBIT.KRW-[CURRENCY]&count=[가져올 갯수]&to=[시작일]
     * 분단위 : 1, 5, 10, 30, 60
     * @param Array $params array[tick_gap, currency, count, to]
     */
    public function chartApi($params=[]){
        //$method = isset(method) ? $params['method']:'GET';
        $currency = isset($params['currency']) ? $params['currency']:'BTC';
        $to = isset($params['to']) ? $params['to']:date("Y-m-d H:i:s");
        $count = isset($params['count']) ? $params['count']:(60*24*3);//default : 3day date
        $tick_gap = isset($params['tick_gap']) ? $params['tick_gap']:'1';
        
        $api_url = $this->api_host_v1.'/crix/candles/minutes/'.$tick_gap.'?code=CRIX.UPBIT.KRW-'.$currency.'&count='.$count.'&to='.$to;
        $curl = new CurlService();
        $curl->request('GET', $api_url);//
        
        return json_decode($curl->body());
    }
    
    
    


}//end class BithumbApiService 