<?php
/***********************************************
#
#      Filename: AccessToken.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-30 10:29:07
# Last Modified: 2017-10-10 11:53:25
***********************************************/

namespace Token\Request\V20170930;

class AccessTokenRequest extends \DefaultRequest
{
    /**
     *  appid(用户唯一凭证)
     **/
    private $appid;

    /**
     *  appsecret(用户唯一凭证密钥)
     **/
    private $appsecret;

    /**
     *  授权类型(固定值)
     **/
    private $grant_type;

    public function __construct()
    {
		parent::__construct();

		parent::reqeustResponseInit("GET", "JSON", "access_token", "token");
		
		$this->setGrantType("client_credential");
        $this->setAppid(APPID);
        $this->setAppsecret(APPSECRET);
    }

    /**
     *  设置 appid
     **/
    public function setAppid($appid)
    {
        $this->appid = $appid;
        $this->queryParameters["appid"] = $appid;
    }

    /**
     *  获取 appid
     **/
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     *  设置 appsecret
     **/
    public function setAppsecret($secret)
    {
        $this->secret = $secret;
        $this->queryParameters["secret"] = $secret;
    }

    /**
     *  获取 appsecret
     **/
    public function getAppsecret()
    {
        return $this->secret;
    }

    /**
     *  设置 授权类型
     **/
    public function setGrantType($grant_type)
    {
        $this->grant_type = $grant_type;
        $this->queryParameters["grant_type"] = $grant_type;
    }

    /**
     *  获取 授权类型
     **/
    public function getGrantType()
    {
        return $this->grant_type;
    }
}
