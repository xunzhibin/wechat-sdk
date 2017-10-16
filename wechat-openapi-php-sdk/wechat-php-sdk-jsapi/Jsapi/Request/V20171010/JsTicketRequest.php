<?php
/***********************************************
#
#      Filename: JsTicketRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-10 14:30:11
# Last Modified: 2017-10-10 15:36:29
***********************************************/

namespace Jsapi\Request\V20171010;

class JsTicketRequest extends \DefaultRequest
{
    /**
     *  access token
     **/
    // private $accessToken;

    /**
     *  请求类型
     **/
    private $type;

    /**
     *
     **/
    public function __construct($token = NULL)
    {
		parent::__construct();

		parent::reqeustResponseInit("GET", "JSON", "Jsapi", "ticket");
		
		parent::setAccessToken($token);
        $this->setType("jsapi");
    }

    /**
     *  设置 请求类型
     **/
    public function setType($type)
    {
        $this->type = $type;
        $this->queryParameters['type'] = $type;
    }

    /**
     *  获取 类型
     **/
    public function getType()
    {
        return $this->type;
    }
}
