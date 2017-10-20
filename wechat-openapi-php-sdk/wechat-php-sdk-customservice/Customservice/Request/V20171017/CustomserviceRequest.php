<?php
/***********************************************
#
#      Filename: CustomserviceRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-17 17:14:38
# Last Modified: 2017-10-17 18:38:24
***********************************************/

namespace Customservice\Request\V20171017;

class CustomserviceRequest extends \DefaultRequest
{
    /**
     *  客服账号
     **/
    private $kfAccount;

    /**
     *  客服昵称
     **/
    private $nickname;

    /**
     *  客服账号登录密码
     **/
    private $password;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  初始化 获取所有客服账号 参数
     **/
    public function listInit($accessToken)
    {
        parent::requestResponseInit("GET", "JSON", "Customservice", "list");

        parent::setAccessToken($accessToken);
    }

    /**
     * 初始化 添加客服账号 参数
     **/
    public function addInit($accessToken, $kfAccount, $name, $password)
    {
        parent::requestResponseInit("POST", "JSON", "Customservice", "add");

        parent::setAccessToken($accessToken);

        $this->setKfAccount($kfAccount);
        $this->setNickname($name);
        $this->setPassword($password);
    }

    /**
     *  初始化 修改客服账号 参数
     **/
    public function updateInit($accessToken, $kfAccount, $name, $password)
    {
        parent::requestResponseInit("POST", "JSON", "Customservice", "update");

        parent::setAccessToken($accessToken);

        $this->setKfAccount($kfAccount);
        $this->setNickname($name);
        $this->setPassword($password);
    }

    /**
     *  初始化 删除客服账号 参数
     **/
    public function deleteInit($accessToken, $kfAccount, $name, $password)
    {
        parent::requestResponseInit("POST", "JSON", "Customservice", "update");

        parent::setAccessToken($accessToken);

        $this->setKfAccount($kfAccount);
        $this->setNickname($name);
        $this->setPassword($password);
    }

    /**
     *  设置 客服账号
     **/
    public function setKfAccount($kfAccount)
    {
        $this->kfAccount = $kfAccount;

        $this->queryPararmeters['kf_account'] = $kfAccount;
    }

    /**
     *  获取 客服账号
     **/
    public function getKfAccount()
    {
        return $this->kfAccount;
    }

    /**
     *  设置 客服昵称
     **/
    public function setNickname($name)
    {
        $this->nickname = $name;

        $this->queryParameters['nickname'] = $name;
    }

    /**
     *  获取 客服昵称
     **/
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     *  设置 客服账号密码
     **/
    public function setPassword($password)
    {
        $this->password = $password;

        $this->queryParameters['password'] = $password;
    }

    /**
     *  获取 客服账号密码
     **/
    public function getPassword()
    {
        return $this->password;
    }
}
