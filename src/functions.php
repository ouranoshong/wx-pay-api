<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 18/06/2017
 * Time: 10:28 PM
 */

namespace WXPay;

function signature(array $data, $key)
{
    ksort($data);
    $string = to_url_params($data);
    //签名步骤二：在string后加入KEY
    $string = $string . "&key=" . $key;
    //签名步骤三：MD5加密
    $string = md5($string);
    //签名步骤四：所有字符转为大写
    $result = strtoupper($string);
    return $result;
}


/**
 * 格式化参数格式化成url参数
 *
 * @param $values array
 *
 * @return string
 */
function to_url_params(array $values)
{
    $buff = "";
    foreach ($values as $k => $v) {
        if ($k != "sign" && $v != "" && !is_array($v)) {
            $buff .= $k . "=" . $v . "&";
        }
    }

    $buff = trim($buff, "&");
    return $buff;
}

/**
 *
 * 产生随机字符串，不长于32位
 * @param int $length
 * @return string 产生的随机字符串
 */
function generate_nonce_str($length = 32)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}

/**
 * 以post方式提交xml到对应的接口url
 *
 * @param string $xml 需要post的xml数据
 * @param string $url url
 * @param int $second url执行超时时间，默认30s
 * @return string
 * @throws WXPayException
 */
function post_xml($url, $xml, $second = 30)
{
    $ch = curl_init();
    //设置超时
    curl_setopt($ch, CURLOPT_TIMEOUT, $second);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);//严格校验
    //设置header
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);


    //post提交方式
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    //运行curl
    $data = curl_exec($ch);
    //返回结果
    if ($data) {
        curl_close($ch);
        return $data;
    } else {
        $error = curl_errno($ch);
        curl_close($ch);
        throw new WXPayException("curl出错，错误码:$error");
    }
}


/**
 * 获取毫秒级别的时间戳
 */
function generate_micro_second()
{
    //获取毫秒的时间戳
    $time = explode(" ", microtime());
    $time = $time[1] . ($time[0] * 1000);
    $time2 = explode(".", $time);
    $time = $time2[0];
    return $time;
}

/**
 * 输出xml字符
 *
 * @param $values
 *
 * @return string
 * @throws \WXPay\WXPayException
 */
function convert_arr_to_xml($values)
{
    if (!is_array($values)
        || count($values) <= 0
    ) {
        throw new WXPayException("数组数据异常！");
    }

    $xml = "<xml>";
    foreach ($values as $key => $val) {
        if (is_numeric($val)) {
            $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
        } else {
            $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
    }
    $xml .= "</xml>";
    return $xml;
}

/**
 * 将xml转为array
 * @param string $xml
 * @return array|mixed
 * @throws \wxpay\WXPayException
 */
function convert_xml_to_arr($xml)
{
    if (!$xml) {
        throw new WXPayException("xml数据异常！");
    }
    //将XML转为array
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
}


/**
 * 以post方式提交xml到对应的接口url
 *
 * @param string $xml 需要post的xml数据
 * @param string $url url
 * @param array $options
 * @return string
 * @throws WXPayException
 * @
 *
 */
function post_xml_cert($url, $xml, $options = [])
{
    $ch = curl_init();
    //设置超时
    curl_setopt($ch, CURLOPT_TIMEOUT, isset($options['second']) ? $options['second'] : 30);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);//严格校验
    //设置header
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    //要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    if (isset($options['pem'])) {
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLCERT, $options['pem']);
    }

    if (isset($options['key'])) {
        curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLKEY, $options['key']);
    }

    //post提交方式
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    //运行curl
    $data = curl_exec($ch);

    //返回结果
    if ($data) {
        curl_close($ch);
        return $data;
    } else {
        $error = curl_errno($ch);
        curl_close($ch);
        throw new WXPayException("curl出错，错误码:$error");
    }
}
