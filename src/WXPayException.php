<?php
namespace WXPay;
/**
 * 微信支付API异常类
 *
 * Class WxPayException
 * @package wxpay
 * @author goldeagle
 */
class WXPayException extends \Exception
{
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
