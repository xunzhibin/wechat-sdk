<?php
/***********************************************
#
#      Filename: Acs_request.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-26 16:37:47
# Last Modified: 2017-09-27 11:23:30
***********************************************/

class AcsRequest
{
    /**
     *  request http(协议类型)
     **/
    protected $protocolType = "https";

    /**
     *  request param(参数)
     **/
    protected $queryParameters = array();

    /**
     * request method(方法)
     **/
    protected $method;

    /**
     *  request header(请求头)
     **/
    protected $headers = array();

    /**
     *  域 参数
     **/
    protected $domainParameters = array();

    /**
     *  参数
     **/
    protected $content;

	/**
     *  响应 格式
     **/
	protected $acceptFormat;

    public function __construct()
    {

    }

    /**
     *  组成 请求 URL
     **/
    public function composeUrl($domain)
    {
        $apiParams = $this->getQueryParameters();
		// var_dump($apiParams);

		if ($this->getMethod() == "POST")
		{
            $requestUrl = $this->getProtocol() . "://" . $domain;

            foreach ($apiParams as $apiParamKey => $apiParamValue)
			{
				$replace = "%" . strtoupper($apiParamKey). "%";
				if(strpos($requestUrl, $replace) !== FALSE)
				{
					$requestUrl = str_replace($replace, $apiParamValue, $requestUrl);
					continue;
				}

                $this->putDomainParameters($apiParamKey, $apiParamValue);
            }

            return $requestUrl;
        }
		else
		{
            $requestUrl = $this->getProtocol() . "://" . $domain . "?";

            foreach ($apiParams as $apiParamKey => $apiParamValue)
			{
                $requestUrl .= "$apiParamKey=" . urlencode($apiParamValue) . "&";
            }

            return substr($requestUrl, 0, -1);
        }
    }

	/**
     *  获取 请求 协议类型
     **/ 
    public function setProtocol($protocol)
    {
        $this->protocolType = $protocol;
    }

	/**
     *  获取 请求 协议类型
     **/
    public function getProtocol()
    {
        return $this->protocolType;
    }

    /**
     *  获取 请求 参数
     **/
    public function getQueryParameters()
    {
        return $this->queryParameters;
    }

    /**
     *  设置 请求 方法
     **/
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     *  获取 请求 方法
     **/
    public function getMethod()
    {
        return $this->method;
    }

    /**
     *  添加 请求头信息
     **/
    public function addHeader($headeKey, $headerValue)
    {
        $this->headers[$headeKey] = $headerValue;
    }

    /**
     *  获取 请求头信息
     **/
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     *  设置 响应 接收格式
     **/
    public function setAcceptFormat($format)
    {
        $this->acceptFormat = $format;
    }

    /**
     *  获取 响应 接收格式
     **/
    public function getAcceptFormat()
    {
        return $this->acceptFormat;
    }

    /**
     *   添加 域 参数(post参数)
     **/
    public function putDomainParameters($name, $value)
    {
        $this->domainParameters[$name] = $value;
    }

    /**
     *  获取 域 参数
     **/
    public function getDomainParameters()
    {
        return $this->domainParameters;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    /**
     *  设置 当前 微信服务
     **/
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    /**
     *  获取 当前微信服务
     **/
	public function getServiceId()
    {
        return $this->serviceId;
    }

	/**
     *  设置 请求产品
     **/
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     *  获取 请求产品
     **/
    public function getProduct()
    {
        return $this->product;
    }
}
