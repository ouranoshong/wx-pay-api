<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 6/16/17
 * Time: 2:32 PM
 */

namespace WXPay\Handler;

use WXPay\HandlerInterface;
use WXPay\Request\UnifiedOrderRequest;
use WXPay\RequestInterface;
use WXPay\ResponseInterface;
use WXPay\Utils;
use WXPay\WXPayConfig;

class UnifiedOrderHandler implements HandlerInterface
{
    /**
     * @var \WXPay\WXPayConfig
     */
    private $config;

    public function __construct(WXPayConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \WXPay\RequestInterface  $request
     * @param \WXPay\ResponseInterface $response
     *
     * @return mixed
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $config = $this->config;

        $url = $config->url . '/'. $request->apiMethod();

        if ($request instanceof UnifiedOrderRequest) {

            $request->setAppId($config->appId);
            $request->setMchId($config->mchId);
            $request->setNonceStr(Utils::getNonceStr());

            if(!isset($request->getParams()['trade_type'])) {
                $request->setTradeType('JSAPI');
            }

            if (!isset($request->getParams()['notify_url'])) {
                $request->setNotifyUrl($config->notifyUrl);
            }

            $requestData = array_filter($request->getParams());
            $sign = Utils::signature($requestData, $config->key);
            $requestData['sign'] = $sign;
            $xmlData = Utils::toXml($requestData);
            $result= Utils::postXmlCurl($xmlData, $url);
            return Utils::initResponseFromXml($result, $response);
        }

        return $url;
    }

}
