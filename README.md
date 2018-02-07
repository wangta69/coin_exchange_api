# COIN EXCHANGE API (가상화폐거래소 API)

## Installation
```
composer require wangta69/coin_exchange_api

composer require "wangta69/coin_exchange_api @dev"

```

Step 1) Add ServiceProvider to the providers array in `config/app.php`.
```
Pondol\CoinExchange\CoinExchangeServiceProvider::class,
```


## How To Use


### [ BITHUMB ] 
- BITHUMB API DOCUMENT : https://www.bithumb.com/u1/US127 <br />

#### Public 
```
use Pondol\CoinExchange\BithumbApiService;

$api = new BithumbApiService();
$result = $api->publicApi('POST', $uri);
```

#### Private
```
use Pondol\CoinExchange\BithumbApiService;

$api_url = '/info/user_transactions';
$connect_key = 'xxxxxx';
$secret_key = 'xxxxxxxx';
$reqParams = ['currency' => 'XRP', 'searchGb' => '0'];

$api = new BithumbApiService();
$api->set_private($api_key, $api_secret);
$result = $api->privateApiCall($api_url, $reqParams);
        
```


### [ COINONE ] 
- COINONE API DOCUMENT : https://doc.coinone.co.kr (use api V2 version)<br />

#### Public 
```
use Pondol\CoinExchange\CoinoneApiService;

$api = new CoinoneApiService();
$result = $api->publicApi('POST', $uri);
```

#### Private
```
use Pondol\CoinExchange\CoinoneApiService;


$api = new CoinoneApiService();
$api->set_private($api_key, $api_secret);
$result = $api->privateApiCall($api_url, $reqParams);
        
```

### [ KORBIT ] 
- COINRAIL API DOCUMENT : https://apidocs.korbit.co.kr<br />

#### Public 
```
use Pondol\CoinExchange\KorbitApiService;;

$api = new KorbitApiService();
$result = $api->publicApi('GET', $uri);
```

### [ UPBIT ] 
- COINRAIL API DOCUMENT : None<br />

#### Public 
```
use Pondol\CoinExchange\UpbitApiService;;

$api = new UpbitApiService();
$result = $api->publicApi('GET', $uri);
```


### [ COINNEST ] 
- COINNET API DOCUMENT : https://www.coinnest.co.kr/doc/intro.html<br />

#### Public 
```
use Pondol\CoinExchange\CoinnestApiService;
----
$uri = '/api/pub/ticker?coin=btc';
$api = new CoinnestApiService();
$result = $api->publicApi('GET', $uri);
```

#### Private
```
use Pondol\CoinExchange\CoinnestApiService;

$api = new CoinnestApiService();
$api->set_private($api_key, $api_secret);
$result = $api->privateApiCall($api_url, $reqParams);
```

### [ COINRAIL ] 
- COINRAIL API DOCUMENT : https://coinrail.co.kr/api/document<br />

#### Public 
```
use Pondol\CoinExchange\CoinrailApiService;

$api = new CoinrailApiService();
$result = $api->publicApi('GET', $uri);
```

#### Private
```
use Pondol\CoinExchange\CoinrailApiService;

$api = new CoinrailApiService();
$api->set_private($api_key, $api_secret);
$result = $api->privateApiCall($api_url, $reqParams);
```


### [ COINCHECK ] 
- COINRAIL API DOCUMENT : NONE<br />

#### Public 
```
use Pondol\CoinExchange\CoincheckApiService;;

$api = new CoincheckApiService();
$result = $api->publicApi('GET', $uri);
```

### [ HUOBIPRO ] 
- COINRAIL API DOCUMENT : https://github.com/huobiapi/API_Docs_en/wiki/REST_Reference <br />

#### Public 
```
use Pondol\CoinExchange\HuobiproApiService;;

$api = new HuobiproApiService();
$result = $api->publicApi('GET', $uri);
```


