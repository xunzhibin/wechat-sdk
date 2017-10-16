<?php
/***********************************************
#
#      Filename: UserRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-10 17:33:54
# Last Modified: 2017-10-10 19:19:29
***********************************************/

namespace User\Request\V20171010;

class UserRequest extends \DefaultRequest
{

    /**
     *  openid
     **/
    private $openid;

    /**
     *  语言
     **/
    private $lang;
	
	/**
     *  用户 列表
     **/
    private $userList;

    public function __construct()
    {
		parent::__construct();
    }

    /**
     *  初始化 获取用户信息 参数
     **/
    public function infoInit($token, $openid, $lang = "zh_CN")
    {
		parent::reqeustResponseInit("GET", "JSON", "User", "info");
		
		parent::setAccessToken($token);

        $this->setOpenid($openid);
        $this->setLang($lang);
    }
    /**
     *  初始化 批量获取用户信息 参数
     **/
    public function batchInfoInit($token, $openids, $lang = "zh_CN")
    {
		parent::reqeustResponseInit("POST", "JSON", "User", "batch_info");
		
		parent::setAccessToken($token);

        $this->setUserList($openids, $lang);
    }

    /**
     *  设置 openid
     **/
    public function setOpenid($openid)
    {
        $this->openid = $openid;

        $this->queryParameters['openid'] = $openid;
    }

    /**
     *  获取 openid
     **/
    public function getOpenid()
    {
        return $this->openid;
    }

    /**
     *  设置 语言
     **/
    public function setLang($lang)
    {
        $this->lang = $lang;

        $this->queryParameters['lang'] = $lang;
    }

    /**
     *  获取 语言
     **/
    public function getLang()
    {
        return $this->lang;
    }
	
	/**
     *  设置 用户列表
     **/
    public function setUserList($openids, $lang)
    {
		$openidArr = is_array($openids) ? $openids : array($openids);
		foreach($openidArr as $openid)
		{
			$this->userList[] = array(
				"openid" => $openid,
				"lang" => $lang
			);
		}

        $this->queryParameters['user_list'] = $this->userList;
    }

    /**
     *  获取 用户列表
     **/
    public function getUserList()
    {
        return $this->userList;
    }
}
