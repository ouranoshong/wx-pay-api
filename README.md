# WXPayAPI

wxpay_v3 api library

more detail see [wx office document](https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_1)

## Usage

```shell
composer require <package/name>
```

#### UnifiedOrderPay Api
```php
$client = new \WXPay\WXPayClient();

$config = new \WXPay\WXPayConfig();

$config->appId = '';
$config->mchId = '';
$config->key = '';
$config->notifyUrl = '';

$request = new \WXPay\Request\UnifiedOrderRequest();

$request->setBody('');
$request->setOutTradeNo('');
$request->setTotalFee();
$request->setSpBillCreateIp('');
$request->setOpenid('');

// or set other api parameter
$request->setXXX();

$response = new \WXPay\Response\UnifiedOrderResponse();

$client->setConfiguration($config);

$client->setHandlerName(\WXPay\Handler\UnifiedOrderHandler::class);

$client->handle($request, $response);

// print all response default
var_dump(json_encode($response->getResult(), JSON_PRETTY_PRINT));

// get specify reponse message (in camlcase)
$response->getXXX();

```

#### Notify Listener to listen WXPay notify message

To be continue..