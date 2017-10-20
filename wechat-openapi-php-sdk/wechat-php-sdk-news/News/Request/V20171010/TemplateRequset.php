<?php
/***********************************************
#
#      Filename: TemplateRequset.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-11 09:57:39
# Last Modified: 2017-10-11 10:08:06
***********************************************/

namespace News\Request\V20171010;

class TemplateRequest extends \AcsRequest
{
    /**
     *  access token
     **/
    private $accessToken;

    public function __construct()
    {
    }

    /**
     *  初始化 获取模版列表 参数
     **/
    public function listInit($token = NULL)
    {
        parent::setMethod("GET");
        parent::setAcceptFormat("JSON");

        parent::setServiceId("News");
        parent::setProduct("list_template");

        $this->setAccessToken($token);
    }

    /**
     *  设置 access token
     **/
    public function setAccessToken($token)
    {
        $this->accessToken = $token;

        $this->queryParameters['access_token'] = $token;
    }

    /**
     *  获取 access token
     **/
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
