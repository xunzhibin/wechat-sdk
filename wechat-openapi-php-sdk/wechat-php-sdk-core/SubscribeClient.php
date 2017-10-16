<?php
/***********************************************
#
#      Filename: SubscribeClient.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-11 15:28:14
# Last Modified: 2017-10-11 15:48:06
***********************************************/

class SubscribeClient extends AcsClient
{
    public function __construct()
    {
    }

    /**
     *  一次性订阅消息授权
     **/
    public function subscribeMsgAuthorization($request)
    {
        $requestUrl = $this->getRequestUrl($request);

        $requestUrl .= "#wechat_redirect";
        //var_dump($requestUrl);

        Header("Location: $requestUrl");

		exit();
    }
}
