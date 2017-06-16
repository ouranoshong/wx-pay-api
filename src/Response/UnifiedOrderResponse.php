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
    private $result;

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function getResult()
    {
        return $this->result;
    }
}
