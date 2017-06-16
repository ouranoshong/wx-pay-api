# WXPayAPI

wxpay_v3 api library

## Usage

```shell
composer require <package/name>
```

## UnifiedOrderPay
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

$response = new \WXPay\Response\UnifiedOrderResponse();

$client->setConfiguration($config);

$client->setHandlerName(\WXPay\Handler\UnifiedOrderHandler::class);

$client->handle($request, $response);

var_dump(json_encode($response->getResult(), JSON_PRETTY_PRINT));
```
