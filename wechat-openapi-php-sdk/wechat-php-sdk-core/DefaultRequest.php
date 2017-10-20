<?php
/***********************************************
#
#      Filename: DefaultRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-13 13:00:54
# Last Modified: 2017-10-13 15:05:26
***********************************************/

class DefaultRequest extends AcsRequest
{
    /**
     *  调用接口凭证
     **/
    private $accessToken;
	
    /**
     *  上传标识
     **/
    private $upload = FALSE;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  初始化 请求、响应 类型
     **/
    public function requestResponseInit($method, $format, $serviceId, $product)
    {
		$this->requestParamInit();

        parent::setMethod($method);
		parent::setAcceptFormat($format);

        parent::setServiceId($serviceId);
        parent::setProduct($product);
    }

    /**
     *  初始化 request 参数
     **/
	public function requestParamInit()
	{
		$this->queryParameters = array();
	}

    /**
     *  设置 接口凭证
     **/
    public function setAccessToken($token)
    {
        $this->accessToken = $token;
		
		$this->queryParameters['access_token'] = $token;
    }

    /**
     *  获取 接口凭证
     **/
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     *  设置 上传标识
     **/
    public function setUpload($upload)
    {
        $this->upload = $upload;
    }

    /**
     *  获取 上传标识
     **/
    public function getUpload()
    {
        return $this->upload;
    }
}
