<?php
/***********************************************
#
#      Filename: ShortUrlRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-11 17:26:31
# Last Modified: 2017-10-11 17:51:08
***********************************************/

namespace Account\Request\V20171011;

class ShortUrlRequest extends \DefaultRequest
{
    /**
     *  动作
     **/
    private $action;

    /**
     *  长链接
     **/
    private $longUrl;

	public function __construct($token = NULL, $url = NULL)
	{
		parent::__construct();
		
		parent::reqeustResponseInit("POST", "JSON", "Account", "short_url");

		parent::setAccessToken($token);
		
		$this->setAction("long2short");
        $this->setLongUrl($url);
	}

    /**
     *  设置 动作
     **/
    public function setAction($action)
    {
        $this->action = $action;

        $this->queryParameters['action'] = $action;
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

        $this->queryParameters['long_url'] = $url;
    }

    /**
     *  获取 长链接
     **/
    public  function getLongUrl()
    {
        return $this->longUrl;
    }
}
