<?php
/***********************************************
#
#      Filename: Http_helper.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-25 11:57:49
# Last Modified: 2017-10-10 19:18:30
***********************************************/

class HttpHelper
{
    /**
     *  PHP成功链接服务器后，服务器无响应时，超时时间(秒)
     **/
    public static $connectTimeout = 30;

    /**
     *  PHP成功链接服务器，服务器返回数据的 开始 到 结束 的时长，超出后，自动断开链接
     **/
    public static $readTimeout = 80;

    /**
     *  统一 cURL 异步请求
     **/
    public static function curl($url, $httpMethod = "GET", $postFields = NULL, $headers = NULL)
    {
        //初始化 cURL 会话
        $ch = curl_init();

        //设置 http请求Method(方法)
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $httpMethod);

        //设置代理
        if(ENABLE_HTTP_PROXY)
        {
            //代理认证模式
            curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
            //代理服务器地址
            curl_setopt($ch, CURLOPT_PROXY, HTTP_PROXY_IP);
            //代理服务器端口
            curl_setopt($ch, CURLOPT_PROXPROT, HTTP_PROXY_PROT);
            //使用http代理模式
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        }

        //设置 请求URL地址
        curl_setopt($ch, CURLOPT_URL, $url);

        //不显示错误
        curl_setopt($ch, CURLOPT_FAILONERROR, FALSE);

        //将curl_exec()获取的信息以字符串返回；FALSE 直接输出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        //设置 使用HTTP协议中POST 请求操作的请求参数
        curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($postFields) ? self::getPostHttpBody($postFields) : $postFields);

        //设置 接收数据时，超时时间
        if(self::$readTimeout)
        {
            curl_setopt($ch, CURLOPT_TIMEOUT, self::$readTimeout);
        }

        //设置 服务器无响应，超时时间
        if(self::$connectTimeout)
        {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$connectTimeout);
        }

        // HTTPS 请求
        if(strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https")
        {
            //禁止cRUL验证对等证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            //不检查名称
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        //设置 头信息
        if(is_array($headers) && count($headers) > 0)
        {
            $httpHeaders = self::getHttpHeaders($headers);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeaders);
        }

        //获取 返回结果
        $result = curl_exec($ch);

        //获取 最后一个收到的HTTP代码
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //获取最后一次cURL操作的错误代码；无错误时，返回0
        if(curl_errno($ch) && ERRORTHRESHOLD)//错误
        {
            throw new ClientException("Server unreachable: Errno: " . curl_errno($ch) . " " . curl_error($ch), "SDK.ServerUnreachable");
        }

        //关闭cURL会话
        curl_close($ch);

        //设置 返回参数
        $httpResponse = new HttpResponse();
        //设置 返回状态
        $httpResponse->setStatus($code);
        //设置 返回数据
        $httpResponse->setBody($result);

        return $httpResponse;
    }

    /**
     *  获取 请求 post 参数
     **/
    public static function getPostHttpBody($postFields)
    {
		$content = json_encode($postFields, JSON_UNESCAPED_UNICODE);
		// var_dump($content);

		return $content;
        // $content = '';

        // foreach($postFields as $param => $val)
        // {
            // $content .= "$param=" . urlencode($val) . "&";
        // }

        // return substr($content, 0, -1);
    }

    /**
     *  获取 请求头
     **/
    public static function getHttpHeaders($headers)
    {
        $http_header = array();

        foreach($headers as $key => $val)
        {
            array_push($http_header, $key . ":" . $val);
        }

        return $http_header;
    }
}
