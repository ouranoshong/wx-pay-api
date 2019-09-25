<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 6/16/17
 * Time: 2:32 PM
 */

namespace WXPay\Handler;

use function WXPay\convert_arr_to_xml;
use function WXPay\convert_xml_to_arr;
use function WXPay\generate_nonce_str;
use WXPay\HandlerInterface;
use function WXPay\post_xml;
use WXPay\Request\UnifiedOrderRequest;
use WXPay\RequestInterface;
use WXPay\ResponseInterface;
use function WXPay\signature;
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
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     * @throws \WXPay\WXPayException
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $config = $this->config;

        $url = $config->url . '/'. $request->apiMethod();

        if ($request instanceof UnifiedOrderRequest) {

            $request->setAppId($config->appId);
            $request->setMchId($config->mchId);
            $request->setNonceStr(generate_nonce_str());

            if(!isset($request->getParams()['trade_type'])) {
                $request->setTradeType('JSAPI');
            }

            if (!isset($request->getParams()['notify_url'])) {
                $request->setNotifyUrl($config->notifyUrl);
            }

            $requestData = array_filter($request->getParams());
            $sign = signature($requestData, $config->key);
            $requestData['sign'] = $sign;
            $xmlData = convert_arr_to_xml($requestData);
            $result= post_xml($url, $xmlData);
            $response->setResult(convert_xml_to_arr($result));

            if ($config->payHandler) {
            	call_user_func($config->payHandler, $xmlData, $result);
			}
        }

        return $response;
    }

}
