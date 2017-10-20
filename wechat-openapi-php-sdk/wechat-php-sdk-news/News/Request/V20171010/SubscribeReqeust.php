<?php
/***********************************************
#
#      Filename: SubscribeReqeust.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-11 12:24:27
# Last Modified: 2017-10-11 12:48:47
***********************************************/

namespace News\Request\V20171010;

class SubscribeReqeust extends \AcsRequest
{
    /**
     *  动作
     **/
    private $action;

    /**
     *  公众号唯一标识
     **/
    private $appid;

    /**
     *  订阅场景值
     **/
    private $scene;

    /**
     *  订阅消息模版ID
     **/
    private $templateId;

    /**
     *  重定向回调地址
     **/
    private $redirectUrl;

    /**
     *  请求和回调的状态
     **/
    private $resrved;

    /**
     *  初始化 参数
     **/
    public function init($templateId = NULL, $scene = NULL, $redirectUrl = NULL, $reserved = NULL)
    {
        $this->setAction("get_confirm");
        $this->setAppid(APPID);
        $this->setScene($scene);
        $this->setTemplateId($templateId);
        $this->setRedirectUrl($redirectUrl);
        $this->setReserved($reserved . "#wechat_redirect");
    }

    /**
     *  设置 请求动作
     **/
    public function setAction($action)
    {
        $this->action = $action;

        $this->queryParameters['action'] = $action;
    }

    /**
     *  获取 请求动作
     **/
    public function getAction()
    {
        return $this->action;
    }

    /**
     *  设置 公众号唯一标识
     **/
    public function setAppid($appid)
    {
        $this->appid = $appid;

        $this->queryparameters['appid'] = $appid;
    }

    /**
     *  获取 公众号唯一标识
     **/
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     *  设置 重定向回调地址
     **/
    public function setRedirectUrl($url)
    {
        $this->redirectUrl = $url;

        $this->queryParam['redirect_url'] = $url;
    }

    /**
     *  获取 重定向回调地址
     **/
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     *  设置 请求和回调 状态
     **/
    public function setReserved($reserved)
    {
        $this->reserved = $reserved;

        $this->queryParameters['reserved'] = $reserved;
    }

    /**
     *  获取 请求和回调 状态
     **/
    public function getReserved()
    {
        return $this->reserved;
    }
}
