# WXPayAPI

[![Build Status](https://travis-ci.org/ouranoshong/wx-pay-api.svg?branch=master)](https://travis-ci.org/ouranoshong/wx-pay-api)


wxpay_v3 api library

more detail see [wx office document](https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_1)

## Usage

#### Installation

```shell
$ composer require ouranoshong/wx-pay-api
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

#### Notify Entity

```php
// don't check signature
$notify = \WXPay\WXPayNotify::createFromXml('<xml>...</xml>');

// check signature
$notify = \WXPay\WXPayNotify::createFromXml('<xml>...</xml>', 'key');

// get signature from wei xin server push
$notify->sign;

// get something else
$nofiy->getXXX();

```

#### Reply Entity
```php
// reply success message to wx server
echo \WXPay\WXPayReply::createSuccessReply();

// reply fail messge to wx server
echo \WXPay\WXPayReply::createFailReply('fail message');

```

### Functions
```php
// sign `$data` with `$key` use md5
\WXPay\signature($data, $key);

// generate nonce string
\WXPay\generate_nonce_str($len);

// convert asocc array to xml
\WXPay\convert_arr_to_xml($arr);

// convert xml to asocc array
\WXPay\convert_xml_to_arr($xml);
```
