<?php
/***********************************************
#
#      Filename: BaseRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-27 13:07:54
# Last Modified: 2017-10-10 10:25:48
***********************************************/

namespace Oauth\Request\V20170926;

class SnsRequest extends \AcsRequest
{
	/**
     *  公众号唯一标识(应用ID)
     **/
    private $appid;

	/**
     *  公众号的appsecret
     **/
    private $secret;

    /**
     *  授权后回调链接地址
     **/
    private $redirect_uri;

	/**
     *  返回类型
     **/
    private $response_type;

	/**
     *  授权作用范围
     **/
    private $scope;

	/**
     *  重定向回调携带参数
     **/
    private $state;

	/**
     *  第一步获取的code参数
     **/
    private $code;

	/**
     *  授权类型(固定值)
     **/
    private $grant_type;


    public function __construct($scope)
    {
		parent::setMethod("GET");
		parent::setAcceptFormat("JSON");

		$this->initCode($scope);
    }

	/**
     *  初始化 获取 code  参数
     **/
	private function initCode($scope)
	{
		$this->setAppid(APPID);
		$this->setRedirectUri(CODEREDIRECTURI);
		$this->setResponseType("code");
		$this->setScope($scope);
		$this->setState("STATE#wechat_redirect");
		$this->setProduct("code");
	}

	/**
     *  初始化 获取 access_token  参数
     **/
	public function initAccessToken($code)
	{
		$this->setSecret(APPSECRET);
		$this->setCode($code);
		$this->setGrantType("authorization_code");
		$this->setProduct("access_token");
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
     *  设置 secret
     **/
    public function setSecret($secret)
    {
        $this->secret = $secret;
        $this->queryParameters["secret"] = $secret;
    }

    /**
     *  获取 secret
     **/
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     *  设置 授权后回调链接地址
     **/
    public function setRedirectUri($redirectUri)
    {
        $this->redirect_uri = $redirectUri;
        $this->queryParameters["redirect_uri"] = $redirectUri;
    }

    /**
     *  获取 授权后回调链接地址
     **/
    public function getRedirectUri()
    {
        return $this->redirect_uri;
    }

    /**
     *  设置 返回类型
     **/
    public function setResponseType($responseType)
    {
        $this->response_type = $responseType;
        $this->queryParameters["response_type"] = $responseType;
    }

    /**
     *  获取 返回类型
     **/
    public function getResponseType()
    {
        return $this->response_type;
    }

    /**
     *  设置 授权作用域
     **/
    public function setScope($scope)
    {
        $this->scope = $scope;
        $this->queryParameters["scope"] = $scope;
    }

    /**
     *  获取 授权作用域
     **/
    public function getScope()
    {
        return $this->scope;
    }

    /**
     *  设置 回调携带参数
     **/
    public function setState($state)
    {
        $this->state = $state;
        $this->queryParameters["state"] = $state;
    }

    /**
     *  获取 回调携带参数
     **/
    public function getState()
    {
        return $this->state;
    }

	/**
     *  设置 code参数
     **/
    public function setCode($code)
    {
        $this->code = $code;
        $this->queryParameters["code"] = $code;
    }

    /**
     *  获取 code参数
     **/
    public function getCode()
    {
        return $this->code;
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
