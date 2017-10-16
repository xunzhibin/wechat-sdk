<?php
/***********************************************
#
#      Filename: UserinfoRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-27 13:09:27
# Last Modified: 2017-10-10 10:26:40
***********************************************/

namespace Oauth\Request\V20170926;

class UserinfoRequest extends SnsRequest
{
	/**
     *  网页授权接口调用凭证
     **/
    private $accessToken;
	
	/**
     *  用户的唯一标识
     **/
    private $openid;

    public function __construct()
    {
		parent::__construct("snsapi_userinfo");

		parent::setServiceId("Oauth2");
    }

	
	/**
     *  初始化 获取 Userinfo  参数
     **/
	public function initUserinfo($accessToken, $openid)
	{
		$this->setAccessToken($accessToken);
		$this->setOpenid($openid);
		$this->setProduct("userinfo");
	}

	/**
     *  设置 网页授权接口调用凭证
     **/
	 public function setAccessToken($accessToken)
	 {
        $this->accessToken = $accessToken;
        $this->queryParameters["access_token"] = $accessToken;
	 }

    /**
     *  获取 网页授权接口调用凭证
     **/
    public function getAccessToken()
    {
        return $this->accessToken;
    }

	/**
     *  设置 用户的唯一标识
     **/
	 public function setOpenid($openid)
	 {
        $this->openid = $openid;
        $this->queryParameters["openid"] = $openid;
	 }

    /**
     *  获取 用户的唯一标识
     **/
    public function getOpenid()
    {
        return $this->openid;
    }
}
