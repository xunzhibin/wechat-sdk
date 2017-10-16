<?php
/***********************************************
#
#      Filename: Acs_client.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-27 10:28:52
# Last Modified: 2017-10-11 09:54:13
***********************************************/

class AcsClient
{
    public function __construct()
    {

    }

    /**
     *  获取 响应结果
     **/
    public function getAcsResponse($request)
    {
        $httpResponse = $this->doActionImpl($request);

        $responseObject = $this->parseAcsResponse($httpResponse->getBody(), $request->getAcceptFormat());
        // var_dump($responseObject);

		if( FALSE == $httpResponse->isSuccess() )
		{
			if(ERRORTHRESHOLD)
			{
				throw new ClientException("Result: Errno: " . $httpResponse->getBody(), $httpResponse->getStatus());
			}

			return FALSE;
        }

        return $responseObject;
    }

    /**
     *  发起 请求
     **/
    private function doActionImpl($request)
    {
        $request = $this->prepareRequest($request);

		$domain = EndpointProvider::findProductDomain($request->getServiceId(), $request->getProduct());

        $requestUrl = $request->composeUrl($domain);
        // var_dump($requestUrl);

		$retryTimes = 0;//重拨次数
        $maxRetryNumber = 3;//最大重拨次数
        $autoRetry = TRUE;//自动重拨
		do
		{
			$postFields = (count($request->getDomainParameters()) > 0) ? $request->getDomainParameters() : $request->getContent();

			$httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), $postFields, $request->getHeaders());

			$retryTimes++;

		}while(500 <= $httpResponse->getStatus() && $autoRetry && $retryTimes < $maxRetryNumber);

		return $httpResponse;
    }
	
    /**
     *  获取 请求 url
     **/
	 public function getRequestUrl($request)
	 {
		$domain = EndpointProvider::findProductDomain($request->getServiceId(), $request->getProduct());

        $requestUrl = $request->composeUrl($domain);
		
		return $requestUrl;
	 }

    /**
     *  准备 请求
     **/
    private function prepareRequest($request)
    {
        if(null == $request->getAcceptFormat())
        {
            $request->setAcceptFormat("JSON");
        }

        if(null == $request->getMethod())
        {
            $request->setMethod("GET");
        }

        return $request;
    }

    /**
     *  解析 响应 结果
     **/
    private function parseAcsResponse($body, $format)
    {
        if($format == "JSON")
        {
            $response_object = json_decode($body, true);
        }
        else if($format == "XML")
        {
            $response_object = @simplexml_load_string($body);
        }

        return $response_object;
    }
}
