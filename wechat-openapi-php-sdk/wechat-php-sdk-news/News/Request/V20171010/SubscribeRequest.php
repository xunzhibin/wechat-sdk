<?php
/***********************************************
#
#      Filename: SubscribeRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-11 12:24:27
# Last Modified: 2017-10-11 17:09:13
***********************************************/

namespace News\Request\V20171010;

class SubscribeRequest extends \DefaultRequest
{
    /**
     *  接收者openid
     **/
    private $touser;

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
     *  点击跳转链接
     **/
    private $url;

    /**
     *  消息标题
     **/
    private $title;

    /**
     *  消息正文
     **/
    private $data;

    /**
     *  初始化 一次性订阅消息授权 参数
     **/
    public function authorizationInit($templateId = NULL, $scene = NULL, $redirectUrl = NULL, $reserved = NULL)
    {
		parent::reqeustResponseInit("GET", "JSON", "News", "subscribe_authorization");

        $this->setAction("get_confirm");
        $this->setAppid(APPID);
        $this->setScene($scene);
        $this->setTemplateId($templateId);
        $this->setRedirectUrl($redirectUrl);
        $this->setReserved($reserved);
    }

    /**
     *  初始化 一次性订阅消息模版 参数
     **/
    public function templateInit($token = NULL, $param)
    {
		parent::reqeustResponseInit("POST", "JSON", "News", "subscribe_msg_template");

		parent::setAccessToken($token);

        $this->setTouser($param['touser']);
        $this->setTemplateId($param['templateId']);
        $this->setUrl($param['url']);
        $this->setScene($param['scene']);
        $this->setTitle($param['title']);
        $this->setData($param['data']);
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

        $this->queryParameters['appid'] = $appid;
    }

    /**
     *  获取 公众号唯一标识
     **/
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     *  设置 订阅场景值
     **/
    public function setScene($scene)
    {
        $this->scene = $scene;

        $this->queryParameters['scene'] = $scene;
    }

    /**
     *  获取 订阅场景值
     **/
    public function getScene()
    {
        return $this->scene;
    }

    /**
     *  设置 模版ID
     **/
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;

        $this->queryParameters['template_id'] = $templateId;
    }

    /**
     *  获取 模版ID
     **/
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     *  设置 重定向回调地址
     **/
    public function setRedirectUrl($url)
    {
        $this->redirectUrl = $url;

        $this->queryParameters['redirect_url'] = $url;
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

    /**
     *  设置 接收者
     **/
    public function setTouser($touser)
    {
        $this->touser = $touser;

        $this->queryParameters['touser'] = $touser;
    }

    /**
     *  获取 接收者
     **/
    public function getTouser()
    {
        return $this->touser;
    }

    /**
     *  设置 跳转链接
     **/
    public function setUrl($url)
    {
        $this->url = $url;

        $this->queryParameters['url'] = $url;
    }

    /**
     *  获取 跳转链接
     **/
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *  设置 消息标题
     **/
    public function setTitle($title)
    {
        $this->title = $title;

        $this->queryParameters['title'] = $title;
    }

    /**
     *  获取 消息标题
     **/
    public  function getTitle()
    {
        return $this->title;
    }


    /**
     *  设置 消息正文
     **/
    public function setData($data)
    {
        $this->data = $data;

        $this->queryParameters['data'] = $data;
    }

    /**
     *  获取 消息正文
     **/
    public function getData()
    {
        return $this->data;
    }
}
