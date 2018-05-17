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
        //    const TRADE_TYPE_JS_API = 'JSAPI';
        //    const TRADE_TYPE_NATIVE = 'NATIVE';
        //    const TRADE_TYPE_APP = 'APP';
        $this->assertEquals('JSAPI', \WXPay\Request\UnifiedOrderRequest::TRADE_TYPE_JS_API);
        $this->assertEquals('NATIVE', \WXPay\Request\UnifiedOrderRequest::TRADE_TYPE_NATIVE);
        $this->assertEquals('APP', \WXPay\Request\UnifiedOrderRequest::TRADE_TYPE_APP);
    }
}