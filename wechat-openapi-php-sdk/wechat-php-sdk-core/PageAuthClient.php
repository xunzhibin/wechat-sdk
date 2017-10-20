<?php
/***********************************************
#
#      Filename: PageAuthClient.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-27 16:17:39
# Last Modified: 2017-10-10 11:18:39
***********************************************/

class PageAuthClient extends AcsClient
{
    public function __construct()
    {
    }

    /**
     *  获取 授权用户基本数据
     **/
    public function getBase($request)
    {
		$result = $this->getAccessToken($request);

		return $result;
    }

    /**
     *  获取 授权用户信息
     **/
    public function getUserinfo($request)
    {
		$result = $this->getInfo($request);

		return $result;
    }

    /**
     *  获取 code
     **/
    private function getCode($request)
    {
        if(!isset($_GET['code']))
        {
			$domain = EndpointProvider::findProductDomain($request->getServiceId(), $request->getProduct());
            $requestUrl = $request->composeUrl($domain);
			var_dump($requestUrl, $_SERVER);exit;

            Header("Location: $requestUrl");

			exit();
        }
        else
        {
            return $_GET['code'];
        }
    }

    /**
     *  获取 access_token
     **/
    private function getAccessToken($request)
    {
        //获取 code
		$code = $this->getCode($request);

        //初始化 请求参数
		$request->initAccessToken($code);

        //请求 获取响应
		$result = $this->getAcsResponse($request);

        return $result;
    }

	/**
     *  获取 userinfo
     **/
    private function getInfo($request)
    {
        $result = $this->getAccessToken($request);
        if(isset($result["errcode"]) && $result["errcode"] !== 0)
		{
			return $result;
		}

        //初始化 请求参数
		$request->initUserinfo($result['access_token'], $result['openid']);

        //请求 获取 响应
		$result = $this->getAcsResponse($request);

        return $result;
    }
}
