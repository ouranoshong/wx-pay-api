<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 6/16/17
 * Time: 1:54 PM
 */

namespace WXPay;


interface ResponseInterface
{
    public function setResult($result);

    public function getResult();
}
