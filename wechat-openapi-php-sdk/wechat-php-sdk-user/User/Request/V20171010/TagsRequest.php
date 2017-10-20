<?php
/***********************************************
#
#      Filename: TagsRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-13 16:23:45
# Last Modified: 2017-10-19 16:20:52
***********************************************/

namespace User\Request\V20171010;

class TagsRequest extends \DefaultRequest
{
	/**
     *  标签
     **/
	private $tag;

    /**
     *  标签ID
     **/
    private $tagId;

    /**
     *  用户openid
     **/
    private $nextOpenid;

    /**
     *  用户openid
     **/
    private $openid;

    /**
     *  用户列表
     **/
    private $openidList;

    public function __construct()
    {
        parent::__construct();
    }

	/**
     *  初始化 创建标签 参数
     **/
    public function createInit($accessToken, $name)
    {
		parent::requestResponseInit("POST", "JSON", "User", "tags_create");

		parent::setAccessToken($accessToken);

		$this->setTag(NULL, $name);
    }

	/**
     *  初始化 创建标签 参数
     **/
    public function updateInit($accessToken, $id, $name)
    {
		parent::requestResponseInit("POST", "JSON", "User", "tags_update");

		parent::setAccessToken($accessToken);

		$this->setTag($id, $name);
    }

	/**
     *  初始化 删除标签 参数
     **/
    public function deleteInit($accessToken, $id)
    {
		parent::requestResponseInit("POST", "JSON", "User", "tags_delete");

		parent::setAccessToken($accessToken);

		$this->setTag($id);
    }

    /**
     *  初始化 获取公众号已创建的标签 参数
     **/
    public function getInit($accessToken)
    {
		parent::requestResponseInit("GET", "JSON", "User", "tags_get");

		parent::setAccessToken($accessToken);
    }

    /**
     *  初始化 获取标签下粉丝列表 参数
     **/
    public function userListInit($accessToken, $tagid, $nextOpenid)
    {
		parent::requestResponseInit("POST", "JSON", "User", "tags_user_list");

		parent::setAccessToken($accessToken);

        $this->setTagId($tagid);
        $this->setNextOpenid($nextOpenid);
    }

    /**
     *  初始化 批量为用户添加标签 参数
     **/
    public function addTagsBatchInit($accessToken, $tagid, $openidList)
    {
		parent::requestResponseInit("POST", "JSON", "User", "batchtagging");

		parent::setAccessToken($accessToken);

        $this->setTagId($tagid);
        $this->setOpenidList($openidList);
    }

    /**
     *  初始化 批量取消用户标签 参数
     **/
    public function clearTagsBatchInit($accessToken, $tagid, $openidList)
    {
		parent::requestResponseInit("POST", "JSON", "User", "batchuntagging");

		parent::setAccessToken($accessToken);

        $this->setTagId($tagid);
        $this->setOpenidList($openidList);
    }

    /**
     *  初始化 获取用户身上的标签列表 参数
     **/
    public function tagsListInit($accessToken, $openid)
    {
		parent::requestResponseInit("POST", "JSON", "User", "getidlist");

		parent::setAccessToken($accessToken);

        $this->setOpenid($openid);
    }

    /**
     *  设置 标签
     **/
    public function setTag($id = NULL , $name = NULL)
    {
		NULL != $id && $this->tag["id"] = $id;
		NULL != $name && $this->tag["name"] = $name;

		$this->queryParameters['tag'] = $this->tag;
    }

	/**
     *  获取 标签
     **/
    public function getTag($name)
    {
		return $this->tag;
    }

    /**
     *  设置 标签id
     **/
    public function setTagId($tagid)
    {
        $this->tagId = $tagid;

        $this->queryParameters['tagid'] = $tagid;
    }

    /**
     *  获取 标签ID
     **/
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     *  设置 用户openid
     **/
    public function setNextOpenid($openid)
    {
        $this->nextOpenid = $openid;

        $this->queryParameters['next_openid'] = $openid;
    }

    /**
     *  获取 用户openid
     **/
    public function getNextOpenid()
    {
        return $this->nextOpenid;
    }

    /**
     *  设置 用户列表
     **/
    public function setOpenidList($openidList)
    {
        $this->openidList = $openidList;

        $this->qeuryParameters['openid_lsit'] = $openidList;
    }

    /**
     *  获取 用户列表
     **/
    public function getOpenidList()
    {
        return $this->openidList;
    }

    /**
     *  设置 用户id
     **/
    public function setOpenid($openid)
    {
        $this->openid = $openid;

        $this->queryParameters['openid'] = $openid;
    }

    /**
     *  获取 用户id
     **/
    public function getOpenid()
    {
        return $this->openid;
    }
}
