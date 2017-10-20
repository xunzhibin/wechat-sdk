<?php
/***********************************************
#
#      Filename: MenuRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-17 12:46:04
# Last Modified: 2017-10-17 16:59:46
***********************************************/

namespace Menu\request\V20171017;

class MenuRequest extends \DefaultRequest
{
    /**
     *  一级菜单
     **/
    private $button;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  初始化 获取自定义菜单配置信息 参数
     **/
    public function infoInit($accessToken)
    {
        parent::requestResponseInit("GET", "JSON", "Menu", "info");

		parent::setAccessToken($accessToken);
    }

    /**
     *  初始化 查询自定义菜单 参数
     **/
    public function getInit($accessToken)
    {
        parent::requestResponseInit("GET", "JSON", "Menu", "get");

		parent::setAccessToken($accessToken);
    }

    /**
     *  初始化 创建自定义菜单 参数
     **/
    public function createInit($accessToken, $button)
    {
        parent::requestResponseInit("POST", "JSON", "Menu", "create");

		parent::setAccessToken($accessToken);

        $this->setButton($button);
    }

    /**
     *  初始化 删除自定义菜单 参数
     **/
    public function deleteInit($accessToken)
    {
        parent::requestResponseInit("GET", "JSON", "Menu", "delete");

		parent::setAccessToken($accessToken);
    }

    /**
     *  设置 一级菜单
     **/
    public  function setButton($button)
    {
        $this->button = $button;

        $this->queryParameters['button'] = $button;
    }

    /**
     *  获取 一级菜单
     **/
    public function getButton()
    {
        return $this->button;
    }
}
