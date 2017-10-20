<?php
/***********************************************
#
#      Filename: DefaultClient.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-13 13:00:54
# Last Modified: 2017-10-13 13:58:47
***********************************************/

class DefaultClient extends AcsClient
{
    /**
     *  调用接口凭证
     **/
    private $accessToken;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  初始化 请求、响应 类型
     **/
    public function reqeustResponseInit($method, $format, $serviceId, $product)
    {
        parent::setMethod($method);
		parent::setAcceptFormat($format);

        parent::setServiceId($serviceId);
        parent::setProduct($product);
    }

    /**
     *  设置 接口凭证
     **/
    public function setAccessToken($token)
    {
        $this->accessToken = $token;
    }

    /**
     *  获取 接口凭证
     **/
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
