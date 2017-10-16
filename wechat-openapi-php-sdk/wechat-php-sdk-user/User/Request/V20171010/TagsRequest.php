<?php
/***********************************************
#
#      Filename: TagsRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-13 16:23:45
# Last Modified: 2017-10-13 16:28:47
***********************************************/

namespace User\Request\V20171010;

class TagsRequest extends \DefaultRequest
{
	/**
     *  标签
     **/
	private $tag;
	 
    public function __construct()
    {
        parent::__construct();
    }

	/**
     *  初始化 创建标签 参数
     **/
    public function createInit($accessToken, $name)
    {
		parent::reqeustResponseInit("POST", "JSON", "User", "tags_create");
		
		parent::setAccessToken($accessToken);
		
		$this->setTag(NULL, $name);
    }

	/**
     *  初始化 创建标签 参数
     **/
    public function updateInit($accessToken, $id, $name)
    {
		parent::reqeustResponseInit("POST", "JSON", "User", "tags_update");
		
		parent::setAccessToken($accessToken);
		
		$this->setTag($id, $name);
    }

	/**
     *  初始化 删除标签 参数
     **/
    public function deleteInit($accessToken, $id)
    {
		parent::reqeustResponseInit("POST", "JSON", "User", "tags_delete");
		
		parent::setAccessToken($accessToken);
		
		$this->setTag($id);
    }

    /**
     *  初始化 获取公众号已创建的标签 参数
     **/
    public function getInit($accessToken)
    {
		parent::reqeustResponseInit("GET", "JSON", "User", "tags_get");
		
		parent::setAccessToken($accessToken);
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
}
