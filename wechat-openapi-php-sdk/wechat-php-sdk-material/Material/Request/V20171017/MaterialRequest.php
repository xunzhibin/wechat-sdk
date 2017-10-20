<?php
/***********************************************
#
#      Filename: MaterialRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-17 19:04:21
# Last Modified: 2017-10-19 10:00:01
***********************************************/

namespace Material\Request\V20171017;

class MaterialRequest extends \DefaultRequest
{
    /**
     *  素材类型
     **/
    private $type;

    /**
     *  偏移量
     **/
    private $offset;

    /**
     *  获取总数
     **/
    private $count;

    /**
     *  素材Id
     **/
    private $mediaId;

    /**
     *  文章位置
     **/
    private $index;

    /**
     *  文章 信息
     **/
    private $articles;

    /**
     *  form-data中媒体文件标识信息
     **/
    private $media;

    /**
     *  描述
     **/
    private $description;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  初始化 获取永久素材列表 参数
     **/
    public function listInit($accessToken, $type, $offset, $count)
    {
        parent::requestResponseInit("POST", "JSON", "Material", "list");

        parent::setAccessToken($accessToken);

        $this->setType($type);
        $this->setOffset($offset);
        $this->setCount($count);
    }

    /**
     *  初始化 获取永久素材总数 参数
     **/
    public function countInit($accessToken)
    {
        parent::requestResponseInit("GET", "JSON", "Material", "count");

        parent::setAccessToken($accessToken);
    }

    /**
     *  初始化 修改永久图文素材 参数
     **/
    public function updateInit($accessToken, $mediaId, $index, $articles)
    {
        parent::requestResponseInit("POST", "JSON", "Material", "update_news");

        parent::setAccessToken($accessToken);

        $this->setMediaId($mediaId);
        $this->setIndex($index);
        $this->setArticles($articles);
    }

    /**
     *  初始化 删除永久素材 参数
     **/
    public function deleteInit($accessToken, $mediaId)
    {
        parent::requestResponseInit("POST", "JSON", "Material", "delete");

        parent::setAccessToken($accessToken);

        $this->setMediaId($mediaId);
    }

    /**
     *  初始化 获取永久素材 参数
     **/
    public function getInit($accessToken, $mediaId)
    {
        parent::requestResponseInit("POST", "JSON", "Material", "get");

        parent::setAccessToken($accessToken);

        $this->setMediaId($mediaId);
    }

    /**
     *  初始化 新增永久图文素材 参数
     **/
    public function addNewsInit($accessToken, $articles)
    {
        parent::requestResponseInit("POST", "JSON", "Material", "add_news");

        parent::setAccessToken($accessToken);

        $this->setArticles($articles);
    }

    /**
     *  初始化 上传图文消息内的图片 参数
     **/
    public function uploadImgInit($accessToken, $media)
    {
        parent::requestResponseInit("POST", "JSON", "Material", "upload_img");

        parent::setAccessToken($accessToken);
        parent::setUpload(TRUE);

        $this->setMedia($media);
    }

    /**
     *  初始化 添加其他类型永久素材 参数
     **/
    public function addInit($accessToken, $type, $media, $description)
    {
        parent::requestResponseInit("POST", "JSON", "Material", "add");

        parent::setAccessToken($accessToken);
        parent::setUpload(TRUE);

        $this->setMedia($media);
        $this->setType($type);
        $description && $this->setVideoDescription($description);
    }

    /**
     *  设置 素材类型
     **/
    public function setType($type)
    {
        $this->type = $type;

        $this->queryParameters['type'] = $type;
    }

    /**
     *  获取 素材类型
     **/
    public function getType()
    {
        return $this->type;
    }

    /**
     *  设置 偏移量
     **/
    public function setOffset($offset)
    {
        $this->offset = $offset;

        $this->queryParameters['offset'] = $offset;
    }

    /**
     *  获取 偏移量
     **/
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     *  设置 获取总数
     **/
    public function setCount($count)
    {
        $this->count = $count;

        $this->queryParameters['count'] = $count;
    }

    /**
     *  获取  获取总数
     **/
    public function getCount()
    {
        return $this->count;
    }

    /**
     *  设置 素材Id
     **/
    public function setMediaId($mediaId)
    {
        $this->mediaId= $mediaId;

        $this->queryParameters['media_id'] = $mediaId;
    }

    /**
     *  获取 素材Id
     **/
    public function getMediaId()
    {
        return $this->mediaId;
    }

    /**
     *  设置 文章位置
     **/
    public function setIndex($index)
    {
        $this->index = $index;

        $this->queryParameters['index'] = $index;
    }

    /**
     *  获取 文章文章
     **/
    public function getIndex()
    {
        return $this->index;
    }

    /**
     *  设置 文章信息
     **/
    public function setArticles($articles)
    {
        $this->articles = $articles;

        $this->queryParameters['articles'] = $articles;
    }

    /**
     *  获取 文章信息
     **/
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     *  设置 form-data媒体文件标识
     **/
    public function setMedia($media)
    {
        $this->media = $media;

        $this->queryParameters['media'] = $media;
    }

    /**
     *  获取 form-data媒体文件标识
     **/
    public function getMedia()
    {
        return $this->media;
    }

    /**
     *  设置 视频描述
     **/
    public function setVideoDescription($description)
    {
        $this->description = $description;

        $this->queryParameters['description'] = json_encode($description, JSON_UNESCAPED_UNICODE);
    }

    /**
     *  获取 描述
     **/
    public function getVideoDescription()
    {
        return $this->description;
    }
}
