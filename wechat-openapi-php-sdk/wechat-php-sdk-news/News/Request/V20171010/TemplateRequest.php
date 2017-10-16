<?php
/***********************************************
#
#      Filename: TemplateRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-11 09:57:39
# Last Modified: 2017-10-11 16:12:31
***********************************************/

namespace News\Request\V20171010;

class TemplateRequest extends \DefaultRequest
{
    /**
     *  模板ID
     **/
    private $templateId;

    /**
     *  模版库中模版编号
     **/
    private $templateIdShort;

    /**
     *  接收者openid
     **/
    private $touser;

    /**
     *  模版跳转链接
     **/
    private $url;

    /**
     *  跳小程序所需数据
     **/
    private $miniprogram;

    /**
     *  模版数据
     **/
    private $data;

    public function __construct()
    {
		parent::__construct();
    }

    /**
     *  初始化 获取模板ID 参数
     **/
    public function getInit($token = NULL, $templateIdShort = NULL)
    {
		parent::reqeustResponseInit("POST", "JSON", "News", "template_id");

		parent::setAccessToken($token);

        $this->setTemplateIdShort($templateIdShort);
    }

    /**
     *  初始化 获取模版列表 参数
     **/
    public function listInit($token = NULL)
    {
		parent::reqeustResponseInit("GET", "JSON", "News", "list_template");

		parent::setAccessToken($token);
    }

    /**
     *  初始化 删除模版 参数
     **/
    public function delInit($token = NULL, $templateId = NULL)
    {
		parent::reqeustResponseInit("POST", "JSON", "News", "del_template");

		parent::setAccessToken($token);

        $this->setTemplateId($templateId);
    }

    /**
     *  初始化 发送模版消息 参数
     **/
    public function sendInit($token = NULL, $param)
    {
		parent::reqeustResponseInit("POST", "JSON", "News", "send");

		parent::setAccessToken($token);

        foreach($param as $key => $val)
        {
            $func = "set" . ucfirst($key);

            if(method_exists($this, $func))
            {
                $this->$func($val);
            }
        }
    }

    /**
     *  设置 模板id
     **/
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
        $this->queryParameters['template_id'] = $templateId;
    }

    /**
     *  获取 模板id
     **/
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     *  设置 模版编号
     **/
    public function setTemplateIdShort($templateIdShort)
    {
        $this->templateIdShort = $templateIdShort;

        $this->queryParameters['template_id_short'] = $templateIdShort;
    }

    /**
     *  获取 模版编号
     **/
    public function getTemplateIdShort()
    {
        return $this->templateIdShort;
    }

    /**
     *  设置 接收者openid
     **/
    public function setTouser($touser)
    {
        $this->touser = $touser;

        $this->queryParameters['touser'] = $touser;
    }

    /**
     *  获取 接收者openid
     **/
    public function getTouser()
    {
        return $this->touser;
    }

    /**
     *  设置 模版跳转链接
     **/
    public function setUrl($url)
    {
        $this->url = $url;

        $this->queryParameters['url'] = $url;
    }

    /**
     *  获取 模版跳转链接
     **/
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *  设置 跳小程序所需数据
     **/
    public function setMiniprogram($miniprogram)
    {
        $this->miniprogram = $miniprogram;

        $this->queryParameters['miniprogram'] = $miniprogram;
    }

    /**
     *  获取 跳小程序所需数据
     **/
    public function getMiniprogram()
    {
        return $this->miniprogram;
    }

    /**
     *  设置 模版 数据
     **/
    public function setData($data)
    {
        $this->data = $data;

        $this->queryParameters['data'] = $data;
    }

    /**
     *  获取 模版数据
     **/
    public function getData()
    {
        return $this->data;
    }
}
