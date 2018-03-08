<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 6/16/17
 * Time: 2:20 PM
 */

namespace WXPay\Request;


use WXPay\RequestInterface;

class UnifiedOrderRequest implements RequestInterface
{

    const TRADE_TYPE_JS_API = 'JSAPI';
    const TRADE_TYPE_NATIVE = 'NATIVE';
    const TRADE_TYPE_APP = 'APP';

    /**
     * @var
     */
    private $params;

    public function apiMethod()
    {
        return 'pay/unifiedorder';
    }

    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $value
     * @name 小程序ID
     */
    public function setAppId($value) {
        $this->params['appid'] = $value;
    }

    /**
     * @var string
     * @name 商户号
     */
    public function setMchId($value) {
        $this->params['mch_id'] = $value;
    }

    /**
     * @var string
     * @name 设备号
     */
    public function setDeviceInfo($value) {
        $this->params['device_info'] = $value;
    }

    /**
     * @var string
     * @name 随机字符串
     */
    public function setNonceStr($value) {
        $this->params['nonce_str'] = $value;
    }

    /**
     * @var string
     * @name 签名
     */
    public function setSign($value) {
        $this->params['sign'] = $value;
    }

    /**
     * @var string
     * @name 签名类型
     */
    public function setSignType($value) {
        $this->params['sign_type'] = $value;
    }

    /**
     * @var string
     * @name 商品描述
     */
    public function setBody($value) {
        $this->params['body'] = $value;
    }

    /**
     * @var string
     * @name 商品详情
     */
    public function setDetail($value) {
        $this->params['detail'] = $value;
    }

    /**
     * @var string
     * @name 附加数据
     */
    public function setAttach($value) {
        $this->params['attach'] = $value;
    }

    /**
     * @var string
     * @name 终端IP
     */
    public function setSpBillCreateIp($value) {
        $this->params['spbill_create_ip'] = $value;
    }

    /**
     * @var string
     * @name 商户订单号
     */
    public function setOutTradeNo($value) {
        $this->params['out_trade_no'] = $value;
    }

    /**
     * @var string
     * @name 货币类型
     */
    public function setFeeType($value) {
        $this->params['fee_type'] = $value;
    }

    /**
     * @var string
     * @name 总金额
     */
    public function setTotalFee($value) {
        $this->params['total_fee'] = $value;
    }

    /**
     * @var string
     * @name 交易起始时间
     */
    public function setTimeStart($value) {
        $this->params['time_start'] = $value;
    }

    /**
     * @var string
     * @name 交易结束时间
     */
    public function setTimeExpire($value) {
        $this->params['time_expire'] = $value;
    }

    /**
     * @var string
     * @name 商品标记
     */
    public function setGoodsTag($value) {
        $this->params['goods_tag'] = $value;
    }

    /**
     * @var string
     * @name 通知地址
     */
    public function setNotifyUrl($value) {
        $this->params['notify_url'] = $value;
    }

    /**
     * @var string
     * @name 交易类型
     */
    public function setTradeType($value) {
        $this->params['trade_type'] = $value;
    }

    /**
     * @var string
     * @name 指定支付方式
     */
    public function setLimitPay($value) {
        $this->params['limit_pay'] = $value;
    }

    /**
     * @var string
     * @name 用户标识
     */
    public function setOpenid($value) {
        $this->params['openid'] = $value;
    }
}
