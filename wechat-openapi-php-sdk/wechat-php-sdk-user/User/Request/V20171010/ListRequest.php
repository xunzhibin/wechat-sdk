<?php
/***********************************************
#
#      Filename: ListRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-10 19:21:21
# Last Modified: 2017-10-10 19:36:36
***********************************************/

namespace User\Request\V20171010;

class ListRequest extends \DefaultRequest
{
    /**
     *  下一个 openid(列表)
     **/
    private $nextOpenid;

    public function __construct($accessToken = NULL, $nextOpenId = NULL)
    {
		parent::__construct();
		
		parent::requestResponseInit("GET", "JSON", "User", "list");
		
		parent::setAccessToken($accessToken);
		
		$this->setNextOpenid($nextOpenId);
    }

    /**
     *  设置 下一个 openid
     **/
    public function setNextOpenid($openid)
    {
        $this->nextOpenid = $openid;

        $this->queryParameters['next_openid'] = $openid;
    }

    /**
     *  获取 下一个 openid
     **/
    public function getNextOpenid()
    {
        return $this->nextOpenid;
    }

}
