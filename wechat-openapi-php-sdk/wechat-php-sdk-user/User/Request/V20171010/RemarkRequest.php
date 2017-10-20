<?php
/***********************************************
#
#      Filename: RemarkRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-19 16:25:04
# Last Modified: 2017-10-19 16:32:47
***********************************************/

namespace User\Request\V20171010;

class RemarkRequest extends \DefaultRequest
{
    /**
     *  用户openid
     **/
    private $openid;

    /**
     *  备注名
     **/
    private $remark;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  初始化 设置用户备注名 参数
     **/
    public function remarkInit($accessToken, $openid, $remark)
    {
        parent::requestResponseInit("POST", "JSON", "User", "remark");

        parent::setAccessToken($accessToken);

        $this->setOpenid($openid);
        $this->setRemark($remark);
    }

    /**
     *  设置 用户openid
     **/
    public function setOpenid($openid)
    {
        $this->openid = $openid;

        $this->queryParameters['openid'] = $openid;
    }

    /**
     *  获取 用户openid
     **/
    public function getOpenid()
    {
        return $this->openid;
    }

    /**
     *  设置 备注名
     **/
    public function setRemark($remark)
    {
        $this->remark = $remark;

        $this->queryParameters['remark'] = $remark;
    }

    /**
     *  获取 备注名
     **/
    public function getRemark()
    {
        return $this->remark;
    }
}
