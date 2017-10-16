<?php
/***********************************************
#
#      Filename: JsapiClient.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-10 16:22:34
# Last Modified: 2017-10-10 17:29:37
***********************************************/

class JsapiClient extends AcsClient
{
    /**
     *  验证配置
     **/
    private $config;

    /**
     *  jsapi ticket
     **/
    private $ticket;

    /**
     *  随机字符串
     **/
    private $nonceStr;

    /**
     *  时间戳
     **/
    private $timestamp;

    /**
     *  当前 URL
     **/
    private $url;

    /**
     *  签名
     **/
    private $signature;

    public function __construct($ticket = NULL, $url = NULL)
    {
		parent::__construct();

		$this->setJsapiTicket($ticket);
        $this->setNonceStr();
        $this->setTimestamp();
        $this->setUrl($url);
        $this->setSignature();
    }

    /**
     *  获取 js api 权限验证配置
     **/
    public function getJsapiConfig()
    {
        return array(
            'appId' => APPID,
            'timestamp' => $this->getTimestamp(),
            'nonceStr' => $this->getNonceStr(),
            'signature' => $this->getSignature()
        );
    }

    /**
     *  获取 配置参数
     **/
    public function getConfig()
    {
        return $this->config;
    }

    /**
     *  设置 jsapi tecket
     **/
    public function setJsapiTicket($ticket)
    {
        $this->ticket = $ticket;
        $this->config['jsapi_ticket'] = $ticket;
    }

    /**
     *  获取 jsapi ticket
     **/
    public function getJsapiTicket()
    {
        return $this->ticket;
    }

    /**
     *  设置 随机字符串
     **/
    public function setNonceStr($str = NULL)
    {
        $str = $str ? $str : $this->nonceStrInit();

        $this->nonceStr = $str;

        $this->config['nonceStr'] = $str;
    }

    /**
     *  获取 随机字符串
     **/
    public function getNonceStr()
    {
        return $this->nonceStr;
    }

    /**
     *  随机字符串 初始化
     **/
    private function nonceStrInit($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";

        for($i = 0; $i < $length; $i++)
        {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }

        return $str;
    }

    /**
     *  设置 时间戳
     **/
    public function setTimestamp($time = NULL)
    {
        $time = $time ? $time : time();

        $this->timestamp = $time;

        $this->config['timestamp'] = $time;
    }

    /**
     *  获取 时间戳
     **/
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     *  设置 当前URL
     **/
    public function setUrl($url = NULL)
    {
        $url = $url ? $url : $this->urlInit();

        $this->url = $url;

        $this->config['url'] = $url;
    }

    /**
     *  获取 当前URL
     **/
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *  初始化 当前URL
     **/
    public function urlInit()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return $url;
    }

    /**
     *  设置 签名
     **/
    public function setSignature($signature = NULL)
    {
        $signature = $signature ? $signature : $this->signatureInit();

        $this->signature = $signature;

        $this->config['signature'] = $signature;
    }

    /**
     *  获取 签名
     **/
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     *  初始化 签名
     **/
    public function signatureInit()
    {
        $string = "jsapi_ticket=" . $this->getJsapiTicket() . "&noncestr=" . $this->getNonceStr() . "&timestamp=" . $this->getTimestamp() . "&url=" . $this->getUrl();

        $this->config['signature_stirng'] = $string;

        $signature  = sha1($string);

        return $signature;
    }
}
