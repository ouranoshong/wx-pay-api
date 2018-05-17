<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 06/12/2017
 * Time: 3:15 PM
 */

namespace WXPay;


use function Sodium\crypto_aead_aes256gcm_decrypt;

class WXPayRefundNotify
{
    private $data = [];

    private $reqInfo;

    /**
     * @param $xml
     * @throws WXPayException
     */
    public function setFromXML($xml) {
        foreach(convert_xml_to_arr($xml) as $key => $value) {
            switch ($key) {
                case 'req_info' :
                    $this->reqInfo = $value;
                    break;
                default:
                    $this->data[$key] = $value;
            }
        }
    }

    /**
     * @param $xml
     * @param $key
     * @return WXPayRefundNotify
     * @throws WXPayException
     */
    public static function createFromXML($xml, $key) {

        $notify = new self();
        $notify->setFromXML($xml);

        if ($data = $notify->decode($notify->reqInfo, $key)) {
            $notify->setFromXML($data);
        }

        return $notify;
    }

    /**
     * @param $reqInfo
     * @param $key
     * @return string
     */
    public function decode($reqInfo, $key) {
        $reqInfo = base64_decode($reqInfo);
        $key = strtolower(md5($key));
        return openssl_decrypt($reqInfo, "aes-256-ecb", $key, OPENSSL_RAW_DATA);
    }

    /**
     * @var string
     * @name 返回状态码
     * @return string
     */
    public function getReturnCode() {
        return isset($this->data['return_code']) ? $this->data['return_code'] : '';
    }

    /**
     * @var string
     * @name 返回信息
     * @return string
     */
    public function getReturnMsg() {
        return isset($this->data['return_msg']) ? $this->data['return_msg'] : '';
    }

    /**
     * @var string
     * @name 微信订单号
     * @return string
     */
    public function getTransactionId() {
        return isset($this->data['transaction_id']) ? $this->data['transaction_id'] : '';
    }

    /**
     * @var string
     * @name 商户订单号
     * @return string
     */
    public function getOutTradeNo() {
        return isset($this->data['out_trade_no']) ? $this->data['out_trade_no'] : '';
    }

    /**
     * @var string
     * @name 微信退款单号
     * @return string
     */
    public function getRefundId() {
        return isset($this->data['refund_id']) ? $this->data['refund_id'] : '';
    }

    /**
     * @var string
     * @name 商户退款单号
     * @return string
     */
    public function getOutRefundNo() {
        return isset($this->data['out_refund_no']) ? $this->data['out_refund_no'] : '';
    }

    /**
     * @var string
     * @name 订单金额
     * @return string
     */
    public function getTotalFee() {
        return isset($this->data['total_fee']) ? $this->data['total_fee'] : '';
    }

    /**
     * @var string
     * @name 应结订单金额
     * @return string
     */
    public function getSettlementTotalFee() {
        return isset($this->data['settlement_total_fee']) ? $this->data['settlement_total_fee'] : '';
    }

    /**
     * @var string
     * @name 申请退款金额
     * @return string
     */
    public function getRefundFee() {
        return isset($this->data['refund_fee']) ? $this->data['refund_fee'] : '';
    }

    /**
     * @var string
     * @name 退款金额
     * @return string
     */
    public function getSettlementRefundFee() {
        return isset($this->data['settlement_refund_fee']) ? $this->data['settlement_refund_fee'] : '';
    }

    /**
     * @var string
     * @name 退款状态
     * @return string
     */
    public function getRefundStatus() {
        return isset($this->data['refund_status']) ? $this->data['refund_status'] : '';
    }

    /**
     * @var string
     * @name 退款成功时间
     * @return string
     */
    public function getSuccessTime() {
        return isset($this->data['success_time']) ? $this->data['success_time'] : '';
    }

    /**
     * @var string
     * @name 退款入账账户
     * @return string
     */
    public function getRefundRecvAccout() {
        return isset($this->data['refund_recv_accout']) ? $this->data['refund_recv_accout'] : '';
    }

    /**
     * @var string
     * @name 退款资金来源
     * @return string
     */
    public function getRefundAccount() {
        return isset($this->data['refund_account']) ? $this->data['refund_account'] : '';
    }

    /**
     * @var string
     * @name 退款发起来源
     * @return string
     */
    public function getRefundRequestSource() {
        return isset($this->data['refund_request_source']) ? $this->data['refund_request_source'] : '';
    }

    /**
     * @return mixed|string
     * @name 支付应用id
     */
    public function getAppId() {
        return isset($this->data['appid']) ? $this->data['appid'] : '';
    }

    /**
     * @return mixed|string
     * @name 商户号
     */
    public function getMchId() {
        return isset($this->data['mch_id']) ? $this->data['mch_id'] : '';
    }
}