<?php
/***********************************************
#
#      Filename: BlacklistRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-19 16:40:53
# Last Modified: 2017-10-20 10:48:52
***********************************************/

namespace User\Request\V20171010;

class BlacklistRequest extends \DefaultRequest
{
    /**
     *  用户openid
     **/
    private $beginOpenid;

    /**
     *  用户openid列表
     **/
    private $openidList;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  初始化 获取黑名单列表 参数
     **/
    public function listInit($accessToken, $beginOpenid = "")
    {
        parent::requestResponseInit("POST", "JSON", "Blacklist", "getblacklist");

        parent::setAccessToken($accessToken);

        $this->setBeginOpenid($beginOpenid);
    }

    /**
     *  初始化 批量拉黑用户参数
     **/
    public function batchPullBlackInit($accessToken, $openidList)
    {
        parent::requestResponseInit("POST", "JSON", "Blacklist", "batchblacklist");

        parent::setAccessToken($accessToken);

        $this->setOpenidList($openidList);
    }

    /**
     *  初始化 批量取消拉黑用户 参数
     **/
    public function batchClearBlackInit($accessToken, $openidList)
    {
        parent::requestResponseInit("POST", "JSON", "Blacklist", "batchunblacklist");

        parent::setAccessToken($accessToken);

        $this->setOpenidList($openidList);
    }

    /**
     *  设置 用户openid
     **/
    public function setBeginOpenid($openid)
    {
        $this->beginOpenid = $openid;

        $this->queryParameters['begin_openid'] = $openid;
    }

    /**
     *  获取 用户openid
     **/
    public function getBeginOpenid()
    {
        return $this->beginOpenid;
    }

    /**
     *  设置 用户列表
     **/
    public function setOpenidList($openidList)
    {
        $this->openidList = $openidList;

        $this->queryParameters['openid_list'] = $openidList;
    }

    /**
     *  获取 用户列表
     **/
    public function getOpenidList()
    {
        return $this->openidList;
    }
}
