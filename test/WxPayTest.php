<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 2018/5/17
 * Time: 4:33 PM
 */

class WxPayTest extends \PHPUnit\Framework\TestCase
{
    public function testInitRequest() {
        $request = new \WXPay\Request\UnifiedOrderRequest();
        $request->setAppId('appId');
        $request->setSign('sign');
        $request->setBody('body');
        $request->setMchId('mchId');
        $request->setOpenid('openId');
        $request->setOutTradeNo('outTradeNo');
        $request->setAttach('attach');
        $request->setDetail('detail');
        $request->setDeviceInfo('deviceInfo');
        $request->setFeeType('feeType');
        $request->setGoodsTag('goodsTag');
        $request->setNonceStr('nonce');
        $request->setNotifyUrl('notifyUrl');
        $request->setLimitPay('limitPay');
        $request->setTotalFee('totalFee');
        $request->setTradeType('tradeType');
        $request->setSpBillCreateIp('ip');
        $request->setTimeStart('start');
        $request->setTimeExpire('expired');
        
        $this->assertEquals(serialize([
            'appid' => 'appId',
            'sign' => 'sign',
            'body' => 'body',
            'mch_id' => 'mchId',
            'openid' => 'openId',
            'out_trade_no' => 'outTradeNo',
            'attach' => 'attach',
            'detail' => 'detail',
            'device_info' => 'deviceInfo',
            'fee_type' => 'feeType',
            'goods_tag' => 'goodsTag',
            'nonce_str' => 'nonce',
            'notify_url' => 'notifyUrl',
            'limit_pay' => 'limitPay',
            'total_fee' => 'totalFee',
            'trade_type' => 'tradeType',
            'spbill_create_ip' => 'ip',
            'time_start' => 'start',
            'time_expire' => 'expired'
        ]), serialize($request->getParams()));
    }

    public function testConst() {
        $this->assertEquals('JSAPI', \WXPay\Request\UnifiedOrderRequest::TRADE_TYPE_JS_API);
        $this->assertEquals('NATIVE', \WXPay\Request\UnifiedOrderRequest::TRADE_TYPE_NATIVE);
        $this->assertEquals('APP', \WXPay\Request\UnifiedOrderRequest::TRADE_TYPE_APP);
    }

    public function testResponse() {
        $response = new \WXPay\Response\UnifiedOrderResponse();

        $result = [
            'appid' => 'appId',
            'sign' => 'sign',
            'mch_id' => 'mchId',
            'device_info' => 'deviceInfo',
            'nonce_str' => 'nonce',
            'trade_type' => 'tradeType',
            'code_url' => 'code_url',
            'prepay_id' => 'PrepayId',
            'err_code' => 'err_code',
            'err_code_des' => 'err_code_des',
            'result_code' => 'result_code',
            'return_code' => 'return_code',
            'return_msg' => 'return_msg'
        ];

        $response->setResult($result);

        $response->getAppId();

        $this->assertEquals('appId', $response->getAppId());
        $this->assertEquals('sign', $response->getSign());
        $this->assertEquals('mchId', $response->getMchId());

        $this->assertEquals('deviceInfo', $response->getDeviceInfo());
        $this->assertEquals('tradeType', $response->getTradeType());
        $this->assertEquals('nonce', $response->getNonceStr());
        $this->assertEquals('code_url', $response->getCodeUrl());
        $this->assertEquals('PrepayId', $response->getPrepayId());

        $this->assertEquals('err_code', $response->getErrCode());
        $this->assertEquals('err_code_des', $response->getErrCodeDes());
        $this->assertEquals('result_code', $response->getResultCode());
        $this->assertEquals('return_code', $response->getReturnCode());
        $this->assertEquals('return_msg', $response->getReturnMsg());

        $this->assertEquals(serialize($result), serialize($response->getResult()));
    }

    /**
     * @throws ReflectionException
     * @throws \WXPay\WXPayException
     *
     * @expectedException \WXPay\WXPayException
     */
    public function testWxPayClientWithoutHandler()
    {
        $config = new \WXPay\WXPayConfig();

        $client = new \WXPay\WXPayClient();

        $client->setConfiguration($config);

        $client->handle(new \WXPay\Request\UnifiedOrderRequest(), new \WXPay\Response\UnifiedOrderResponse());

    }

    /**
     * @throws ReflectionException
     * @throws \WXPay\WXPayException
     *
     * @expectedException \WXPay\WXPayException
     */
    public function testWxPayClientWithWrongHandler()
    {
        $config = new \WXPay\WXPayConfig();

        $client = new \WXPay\WXPayClient();

        $client->setConfiguration($config);

        $client->setHandlerName(FakeHandler::class);

        $client->handle(new \WXPay\Request\UnifiedOrderRequest(), new \WXPay\Response\UnifiedOrderResponse());

    }


    /**
     * @throws ReflectionException
     * @throws \WXPay\WXPayException
     *
     * @expectedException \WXPay\WXPayException
     */
    public function testWxPayClientWithoutConfiguration()
    {
        $client = new \WXPay\WXPayClient();

        $client->setHandlerName(FakeHandler::class);

        $client->handle(new \WXPay\Request\UnifiedOrderRequest(), new \WXPay\Response\UnifiedOrderResponse());

    }
}

class FakeHandler
{

}