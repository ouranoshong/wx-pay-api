<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 6/16/17
 * Time: 3:07 PM
 */

namespace WXPay\Response;


use WXPay\ResponseInterface;

class UnifiedOrderResponse implements ResponseInterface
{
    /**
     * @var array
     */
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
     * @return string
     */
    public function getReturnCode() {
        return $this->result['return_code'];
    }

    /**
     * @var string
     * @name 返回信息
     * @return string
     */
    public function getReturnMsg() {
        return $this->result['return_msg'];
    }

    /**
     * @var int
     * @name 商户号
     * @return int
     */
    public function getMchId() {
        return $this->result['mch_id'];
    }

    /**
     * @var string
     * @name 设备号
     * @return string
     */
    public function getDeviceInfo() {
        return $this->result['device_info'];
    }

    /**
     * @var string
     * @name 随机字符串
     * @return string
     */
    public function getNonceStr() {
        return $this->result['nonce_str'];
    }

    /**
     * @var string
     * @name 签名
     * @return string
     */
    public function getSign() {
        return $this->result['sign'];
    }

    /**
     * @var string
     * @name 业务结果
     * @return string
     */
    public function getResultCode() {
        return $this->result['result_code'];
    }

    /**
     * @var string
     * @name 错误代码
     * @return string
     */
    public function getErrCode() {
        return $this->result['err_code'];
    }

    /**
     * @var string
     * @name 错误代码描述
     * @return string
     */
    public function getErrCodeDes() {
        return $this->result['err_code_des'];
    }

    /**
     * @var string
     * @name 交易类型
     * @return string
     */
    public function getTradeType() {
        return $this->result['trade_type'];
    }

    /**
     * @var string
     * @name 预支付交易会话标识
     * @return string
     */
    public function getPrepayId() {
        return $this->result['prepay_id'];
    }

    /**
     * @var string
     * @name 二维码链接
     * @return string
     */
    public function getCodeUrl() {
        return $this->result['code_url'];
    }
}
