<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 12/6/17
 * Time: 10:38 AM
 */

namespace WXPay\Handler;


use function WXPay\convert_arr_to_xml;
use function WXPay\convert_xml_to_arr;
use function WXPay\generate_nonce_str;
use WXPay\HandlerInterface;
use function WXPay\post_xml_cert;
use WXPay\Request\RefundRequest;
use WXPay\RequestInterface;
use WXPay\ResponseInterface;
use function WXPay\signature;
use WXPay\WXPayConfig;

class RefundHandler implements HandlerInterface
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
        $options = [];
        $url = $config->url .'/'. $request->apiMethod();

        if ($request instanceof RefundRequest) {
            $request->setMchId($config->mchId);
            $request->setAppId($config->appId);
            $request->setNonceStr(generate_nonce_str());

            $requestData = array_filter($request->getParams());
            $sign = signature($requestData, $config->key);
            $requestData['sign'] = $sign;

            if ($config->sslPemPath) {
                $options['pem'] = $config->sslPemPath;
            }

            if ($config->sslKeyPath) {
                $options['key'] = $config->sslKeyPath;
            }

            $xmlData = convert_arr_to_xml($requestData);
            $result= post_xml_cert($url, $xmlData, $options);
            $response->setResult(convert_xml_to_arr($result));
        }

        return $response;
    }

}
