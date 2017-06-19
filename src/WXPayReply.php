<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 19/06/2017
 * Time: 8:06 PM
 */

namespace WXPay;


/**
 * Class WXPayReply
 * @package WXPay
 */
class WXPayReply
{

    /**
     *
     */
    const RETURN_CODE_SUCCESS = 'SUCCESS';
    /**
     *
     */
    const RETURN_CODE_FAIL = 'FAIL';
    /**
     *
     */
    const RETURN_MSG_OK = 'OK';

    /**
     * @var
     */
    protected $data;


    /**
     * @param $value
     */
    public function setReturnCode($value) {
        $this->data['return_code'] = $value;
    }

    /**
     * @param $value
     */
    public function setReturnMessage($value) {
        $this->data['return_msg'] = $value;
    }

    /**
     * @param
     * @return string
     */
    public function getReturnCode() {
        return $this->data['return_code'];
    }

    /**
     * @param
     * @return string
     */
    public function getReturnMessage() {
       return $this->data['return_msg'];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return convert_arr_to_xml((array)$this->data);
    }

    /**
     * @return WXPayReply
     */
    public static function createSuccessReply() {
        $reply = new self();
        $reply->setReturnCode(self::RETURN_CODE_SUCCESS);
        $reply->setReturnMessage(self::RETURN_MSG_OK);
        return $reply;
    }

    /**
     * @param $errorMsg
     * @return WXPayReply
     */
    public static function createFailReply($errorMsg) {
        $reply = new self();
        $reply->setReturnCode(self::RETURN_CODE_FAIL);
        $reply->setReturnMessage($errorMsg);
        return $reply;
    }
}