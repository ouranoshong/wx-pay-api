<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 6/16/17
 * Time: 1:44 PM
 */

namespace WXPay;


class WXPayClient
{
    /**
     * @var \WXPay\WXPayConfig
     */
    private $_configuration = null;

    /**
     * @var string
     */
    private $_handler = null;


    public function setConfiguration(WXPayConfig $config)
    {
        $this->_configuration = $config;
    }

    public function setHandlerName($name)
    {
        $this->_handler = $name;
    }

    public function isDebug() {
        return $this->_configuration->debug;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     * @throws WXPayException
     * @throws \ReflectionException
     */
    public function handle(RequestInterface $request, ResponseInterface $response)
    {

        if (!$this->_handler) throw new WXPayException('Please set a handler first!');

        if (in_array(HandlerInterface::class, array_keys((new \ReflectionClass($this->_handler))->getInterfaces()))) {

            if (!$this->_configuration) throw new WXPayException('Please set a configuration first!');

            $handler = $this->_handler;

            $handlerInstance = new $handler($this->_configuration);

            return $handlerInstance($request, $response);

        } else {
            throw new WXPayException('Please set a handler first!');
        }
    }

}
