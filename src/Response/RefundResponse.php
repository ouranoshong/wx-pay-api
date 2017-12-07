<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 12/6/17
 * Time: 10:04 AM
 */

namespace WXPay\Response;


use WXPay\ResponseInterface;

class RefundResponse implements ResponseInterface
{
    private $result;

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function getResult()
    {
        return $this->result;
    }

    /**
     * @var string
     * @name 返回状态码
     */
    public function getReturnCode() {
       return $this->result['return_code'];
    }

    /**
     * @var string
     * @name 返回信息
     */
    public function getReturnMsg() {
        return $this->result['return_msg'];
    }

    /**
     * @return mixed
     * @name 业务结果
     */
    public function getResultCode() {
        return $this->result['result_code'];
    }

    /**
     * @var string
     * @name 错误代码
     */
    public function getErrCode() {
        return $this->result['err_code'];
    }

    /**
     * @var string
     * @name 错误代码描述
     */
    public function getErrCodeDes() {
        return $this->result['err_code_des'];
    }

    /**
     * @var string
     * @name 商户号
     */
    public function getMchId() {
        return $this->result['mch_id'];
    }

    /**
     * @var string
     * @name 设备号
     */
    public function getDeviceInfo() {
        return $this->result['device_info'];
    }

    /**
     * @var string
     * @name 随机字符串
     */
    public function getNonceStr() {
        return $this->result['nonce_str'];
    }

    /**
     * @var string
     * @name 签名
     */
    public function getSign() {
        return $this->result['sign'];
    }

    /**
     * @var string
     * @name 微信订单号
     */
    public function getTransactionId() {
        return $this->result['transaction_id'];
    }

    /**
     * @var string
     * @name 商户订单号
     */
    public function getOutTradeNo() {
        return $this->result['out_trade_no'];
    }

    /**
     * @var string
     * @name 商户退款单号
     */
    public function getOutRefundNo() {
        return $this->result['out_refund_no'];
    }

    /**
     * @var string
     * @name 微信退款单号
     */
    public function getRefundId() {
        return $this->result['refund_id'];
    }

    /**
     * @var string
     * @name 退款渠道
     */
    public function getRefundChannel() {
        return $this->result['refund_channel'];
    }

    /**
     * @var string
     * @name 申请退款金额
     */
    public function getRefundFee() {
        return $this->result['refund_fee'];
    }

    /**
     * @var string
     * @name 退款金额
     */
    public function getSettlementRefundFee() {
        return $this->result['settlement_refund_fee'];
    }

    /**
     * @var string
     * @name 订单金额
     */
    public function getTotalFee() {
        return $this->result['total_fee'];
    }

    /**
     * @var string
     * @name 应结订单金额
     */
    public function getSettlementTotalFee() {
        return $this->result['settlement_total_fee'];
    }

    /**
     * @var string
     * @name 订单金额货币种类
     */
    public function getFeeType() {
        return $this->result['fee_type'];
    }

    /**
     * @var string
     * @name 现金支付金额
     */
    public function getCashFee() {
        return $this->result['cash_fee'];
    }

    /**
     * @var string
     * @name 现金退款金额
     */
    public function getCashRefundFee() {
        return $this->result['cash_refund_fee'];
    }

    /**
     * @var string
     * @name 代金券类型
     */
    public function getCouponType($index) {
        return $this->result['coupon_type_'.$index];
    }

    /**
     * @var string
     * @name 代金券退款金额
     */
    public function getCouponRefundFee($typeIndex) {
        return $this->result['coupon_refund_fee_'.$typeIndex];
    }

    /**
     * @var string
     * @name 退款代金券使用数量
     */
    public function getCouponRefundCount($typeIndex) {
        return $this->result['coupon_refund_count_'.$typeIndex];
    }

    /**
     * @var string
     * @name 单个退款代金券支付金额
     */
    public function getEachCouponRefundFee($typeIndex, $row) {
        return $this->result['coupon_refund_fee_'.$typeIndex.'_'.$row];
    }

    /**
     * @name 退款代金券批次ID
     * @param $typeIndex
     * @param $row
     *
     * @return mixed
     */
    public function getCouponRefundBatchId($typeIndex, $row) {
        return $this->result['coupon_refund_batch_id_'.$typeIndex.'_'.$row];
    }

    /**
     * @name 退款代金券ID
     * @param $typeIndex
     * @param $row
     *
     * @return mixed
     */
    public function getCouponRefundId($typeIndex, $row) {
        return $this->result['coupon_refund_id_'.$typeIndex.'_'.$row];
    }
}
