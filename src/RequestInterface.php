<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 6/16/17
 * Time: 1:54 PM
 */

namespace WXPay;


interface RequestInterface
{
    /**
     * @return string
     */
    public function apiMethod();

    /**
     * @return array
     */
    public function getParams();
}
