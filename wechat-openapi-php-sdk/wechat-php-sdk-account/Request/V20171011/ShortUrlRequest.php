<?php
/***********************************************
#
#      Filename: ShortUrlRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-11 17:26:31
# Last Modified: 2017-10-11 17:42:25
***********************************************/

namespace Account\Request\V20171011;

class ShortUrlRequest extends \AcsRequest
{
    /**
     *  access token
     **/
    private $accessToken;

    /**
     *  动作
     **/
    private $action;

    /**
     *  长链接
     **/
    private $longUrl;

    /**
     *  初始化 长链接转短链接 参数
     **/
    public function init($token = NULL, $url = NULL)
    {
        parent::setMethod("POST");
        parent::setAcceptFormat("JSON");

        parent::setServiceId("Account");
        parent::setProduct("short_url");

        $this->setAccessToken($token);
        $this->setAction("long2short");
        $this->setLongUrl($url);
    }

    /**
     *  设置 access token
     **/
    public function setAccessToken($token)
    {
        $this->accessToken = $token;

        $this->qeuryParameters['access_token'] = $token;
    }

    /**
     * 获取 access token
     **/
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     *  设置 动作
     **/
    public function setAction($action)
    {
        $this->action = $action;

        $this->qeuryParameters['action'] = $action;
    }

    /**
     *  获取 动作
     **/
    public function getAction()
    {
        return $this->action;
    }

    /**
     *  设置 长链接
     **/
    public function setLongUrl($url)
    {
        $this->longUrl = $url;

        $this->qeuryParameters['long_url'] = $url;
    }

    /**
     *  获取 长链接
     **/
    public  function getLongUrl()
    {
        return $this->longUrl;
    }
}
