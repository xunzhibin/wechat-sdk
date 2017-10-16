<?php
/***********************************************
#
#      Filename: AutoreplyRuleRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-10 12:44:35
# Last Modified: 2017-10-10 13:03:23
***********************************************/

namespace News\Request\V20171010;

// class AutoreplyRuleRequest extends \AcsRequest
class AutoreplyRuleRequest extends \DefaultRequest
{
    /**
     *  access token
     **/
    // private $accessToken;

    public function __construct($token)
    {
        // parent::setMethod("GET");
        // parent::setAcceptFormat("JSON");

        // parent::setServiceId("News");
        // parent::setProduct("autoreply_rule");
		parent::reqeustResponseInit("GET", "JSON", "News", "autoreply_rule");

		parent::setAccessToken($token);
    }

    /**
     *  初始化 获取 自动回复规则 参数
     **/
    // public function init($token)
    // {
        // $this->setAccessToken($token);
    // }

    /**
     *  设置 access token
     **/
    // public  function setAccessToken($token)
    // {
        // $this->accessToken = $token;
        // $this->queryParameters['access_token'] = $token;
    // }

    /**
     *  获取 access token
     **/
    // public function getAccessToken()
    // {
        // return $this->accessToken;
    // }
}
