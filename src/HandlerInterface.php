<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 6/16/17
 * Time: 1:53 PM
 */

namespace WXPay;

/**
 * Interface HandlerInterface
 *
 * @package WXPay
 */
interface HandlerInterface
{
    public function __invoke(RequestInterface $request, ResponseInterface $response);
}
