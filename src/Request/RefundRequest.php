<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 12/6/17
 * Time: 9:55 AM
 */

namespace WXPay\Request;


use WXPay\RequestInterface;

class RefundRequest implements RequestInterface
{
    private $params;

    public function apiMethod()
    {
        return 'secapi/pay/refund';
    }

    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $value
     * @var string
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
     * @name 微信订单号
     */
    public function setTransactionId($value) {
        $this->params['transaction_id'] = $value;
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
     * @name 商户退款单号
     */
    public function setOutRefundNo($value) {
        $this->params['out_refund_no'] = $value;
    }

    /**
     * @var string
     * @name 订单金额
     */
    public function setTotalFee($value) {
        $this->params['total_fee'] = $value;
    }

    /**
     * @var string
     * @name 退款金额
     */
    public function setRefundFee($value) {
        $this->params['refund_fee'] = $value;
    }

    /**
     * @var string
     * @name 货币种类
     */
    public function setRefundFeeType($value) {
        $this->params['refund_fee_type'] = $value;
    }

    /**
     * @var string
     * @name 操作员
     */
    public function setOpUserId($value) {
        $this->params['op_user_id'] = $value;
    }

    /**
     * @var string
     * @name 退款资金来源
     */
    public function setRefundAccount($value) {
        $this->params['refund_account'] = $value;
    }

}
