<?php
/***********************************************
#
#      Filename: QrCodeRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-12 10:14:36
# Last Modified: 2017-10-12 11:50:08
***********************************************/

namespace Account\Request\V20171011;

class QrCodeRequest extends \DefaultRequest
{
    /**
     *  二维码有效时间(秒)
     **/
    private $expireSeconds;

    /**
     *  二维码类型
     **/
    private $actionName;

    /**
     *  二维码详情
     **/
    private $actionInfo;

    /**
     *  场景值ID(非0整形)
     **/
    private $sceneId;

    /**
     *  场景值ID(字符串)
     **/
    private $sceneStr;

    /**
     *  二维码 ticket
     **/
    private $ticket;

	public function __construct()
	{
		parent::__construct();
	}

    /**
     *  初始化 换取二维码 参数
     **/
    public function qrcodeInit($ticket)
    {
		parent::reqeustResponseInit("GET", "JSON", "Account", "qrcode");

        $this->setTicket($ticket);
    }

    /**
     *  初始化 创建二维码ticket 参数
     **/
    public function ticketInit($token = NULL, $scene = NULL, $expireSeconds = NULL)
    {
		parent::reqeustResponseInit("POST", "JSON", "Account", "ticket");

		parent::setAccessToken($token);

        NULL != $expireSeconds ? $this->tempInit($expireSeconds, $scene) : $this->permanentInit($scene);
    }

    /**
     *  初始化 临时 二维码 ticket 参数
     **/
    public function tempInit($expireSeconds, $scene)
    {
        $this->setExpireSeconds($expireSeconds);

        $type = is_string($scene) ? "QR_STR_SCENE" : "QR_SCENE";
        $this->setActionName($type);

        is_string($scene) ? $this->setSceneStr($scene) : $this->setSceneId($scene);

        $sceneArr = is_string($scene) ? array("scene_str" => $scene) : array("scene_id" => $scene);
        $info = array("scene" => $sceneArr);
        $this->setActionInfo($info);
    }

    /**
     *  初始化 永久 二维码 ticket 参数
     **/
    public function permanentInit($scene)
    {
        $type = is_string($scene) ? "QR_LIMIT_STR_SCENE" : "QR_LIMIT_SCENE";
        $this->setActionName($type);

        is_string($scene) ? $this->setSceneStr($scene) : $this->setSceneId($scene);

        $sceneArr = is_string($scene) ? array("scene_str" => $scene) : array("scene_id" => $scene);
        $info = array("scene" => $sceneArr);
        $this->setActionInfo($info);
    }

    /**
     *  设置 二维码有效时间
     **/
    public function setExpireSeconds($time)
    {
        $this->expireSeconds = $time;

        $this->queryParameters['expire_seconds'] = $time;
    }

    /**
     *  获取 二维码有效时间
     **/
    public function getExpireSeconds()
    {
        return $this->expireSeconds;
    }

    /**
     *  设置 二维码类型
     **/
    public function setActionName($type)
    {
        $this->actionName = $type;

        $this->queryParameters['action_name'] = $type;
    }

    /**
     *  获取 二维码类型
     **/
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     *  设置 二维码详情信息
     **/
    public function setActionInfo($info)
    {
        $this->actionInfo = $info;

        $this->queryParameters['action_info'] = $info;
    }

    /**
     *  获取 二维码详情信息
     **/
    public function getActionInfo()
    {
        return $this->actionInfo;
    }

    /**
     *  设置 场景值ID(非0整形)
     **/
    public function setSceneId($num)
    {
        $this->sceneId = $num;
    }

    /**
     *  获取 场景值ID(非0整形)
     **/
    public function getSceneId()
    {
        return $this->sceneId;
    }

    /**
     *  设置 场景值ID(字符串)
     **/
    public function setSceneStr($string)
    {
        $this->sceneStr = $string;
    }

    /**
     *  获取 场景值ID(字符串)
     **/
    public function getSceneStr()
    {
        return $this->sceneStr;
    }

    /**
     *  设置 二维码 ticket
     **/
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;

        $this->queryParameters['ticket'] = $ticket;
    }

    /**
     *  获取 二维码 ticket
     **/
    public function getTicket()
    {
        return $this->ticket;
    }
}
