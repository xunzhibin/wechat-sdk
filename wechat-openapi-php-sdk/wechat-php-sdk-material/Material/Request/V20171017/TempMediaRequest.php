<?php
/***********************************************
#
#      Filename: TempMediaRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-19 10:02:58
# Last Modified: 2017-10-19 10:45:31
***********************************************/

namespace Material\Request\V20171017;

class TempMediaRequest extends \DefaultRequest
{
    /**
     *  媒体文件Id
     **/
    private $mediaId;

    /**
     *  媒体文件类型
     **/
    private $type;

    /**
     *  form-data中媒体文件标识
     **/
    private $media;

    public function __construct()
    {
        parent::__construct();
    }

    /**
        *  初始化 获取临时素材 参数
        **/
    public function getInit($accessToken, $mediaId)
    {
        parent::requestResponseInit("GET", "JSON", "Material", "temp_get");

        parent::setAccessToken($accessToken);

        $this->setMediaId($mediaId);
    }

    /**
     *  初始化 上传临时素材 参数
     **/
    public function uploadInit($accessToken, $type, $media)
    {
        parent::requestResponseInit("POST", "JSON", "Material", "temp_upload");

        parent::setAccessToken($accessToken);
        parent::setUpload(TRUE);

        $this->setType($type);
        $this->setMedia($media);
    }

    /**
     *  设置 媒体Id
     **/
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;

        $this->queryParameters['media_id'] = $mediaId;
    }

    /**
     *  获取 媒体Id
     **/
    public function getMediaId()
    {
        return $this->mediaId;
    }

    /**
     *  设置 媒体文件类型
     **/
    public function setType($type)
    {
        $this->type = $type;

        $this->queryParameters['type'] = $type;
    }

    /**
     *  获取 媒体文件类型
     **/
    public function getType($type)
    {
        return $this->type;
    }

    /**
     *  设置 form-data中媒体文件标识
     **/
    public function setMedia($media)
    {
        $this->media = $media;

        $this->queryParameters['media'] = $media;
    }

    /**
     *  获取 form-data中媒体文件标识
     **/
    public function getMedia()
    {
        return $this->media;
    }
}
