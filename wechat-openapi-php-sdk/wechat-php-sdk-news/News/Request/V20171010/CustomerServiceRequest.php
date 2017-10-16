<?php
/***********************************************
#
#      Filename: CustomerServiceRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-12 15:37:23
# Last Modified: 2017-10-13 12:39:40
***********************************************/

namespace News\Request\V20171010;

class CustomerServiceRequest extends \DefaultRequest
{

    /**
     *  用户openid
     **/
    private $touser;

    /**
     *  消息类型
     **/
    private $msgtype;

    /**
     *  文本消息内容
     **/
    private $text;

    /**
     *  图片消息内容
     **/
    private $image;

    /**
     *  语音消息内容
     **/
    private $voice;

    /**
     *  视频消息内容
     **/
    private $video;

    /**
     *  音乐消息内容
     **/
    private $music;

    /**
     *  图文消息内容
     **/
    private $news;

    /**
     *  图文消息内容
     **/
    private $mpnews;

    /**
     *  卡券消息内容
     **/
    private $wxcard;

    /**
     *  小程序卡片消息内容
     **/
    private $miniprogrampage;

    /**
     *  初始化 发送文本消息 参数
     **/
    public function textInit($token, $openid, $content)
    {
        $this->defaultInit($token, $openid, "text");

        $this->setText($content);
    }

    /**
     *  初始化 发送图片消息 参数
     **/
    public function imageInit($token, $openid, $mediaId)
    {
        $this->defaultInit($token, $openid, "image");

        $this->setImage($mediaId);
    }

    /**
     *  初始化 发送语音消息 参数
     **/
    public function voiceInit($token, $openid, $mediaId)
    {
        $this->defaultInit($token, $openid, "voice");

        $this->setVoice($mediaId);
    }

    /**
     *  初始化 发送视频消息 参数
     **/
    public function videoInit($token, $openid, $mediaId, $thumbMediaId, $title, $description)
    {
        $this->defaultInit($token, $openid, "video");

        $this->setVideo($mediaId, $thumbMediaId, $title, $description);
    }

    /**
     *  初始化 发送音乐消息 参数
     **/
    public function musicInit($token, $openid, $title, $description, $musicurl, $hqmusicurl, $thumbMediaId)
    {
        $this->defaultInit($token, $openid, "music");

        $this->setMusic($title, $description, $musicurl, $hqmusicurl, $thumbMediaId);
    }

    /**
     *  初始化 发送图文消息 参数
     **/
    public function newsInit($token, $openid, $articles)
    {
        $this->defaultInit($token, $openid, "news");

        $this->setNews($articles);
    }

    /**
     *  初始化 发送图文消息 参数
     **/
    public function mpnewsInit($token, $openid, $mediaId)
    {
        $this->defaultInit($token, $openid, "mpnews");

        $this->setMpnews($mediaId);
    }

    /**
     *  初始化 发送卡卷 参数
     **/
    public function wxcardInit($token, $openid, $cardId)
    {
        $this->defaultInit($token, $openid, "wxcard");

        $this->setWxcard($cardId);
    }

    /**
     *  初始化 发送小程序卡片 参数
     **/
    public function miniprogrampageInit($token, $openid, $miniprogrampage)
    {
        $this->defaultInit($token, $openid, "miniprogrampage");

        $this->setMiniprogrampage($miniprogrampage);
    }

    /**
     *  默认 初始化
     **/
    private function defaultInit($token, $openid, $type)
    {
		parent::reqeustResponseInit("POST", "JSON", "News", "custom_send");

		parent::setAccessToken($token);

        $this->setTouser($openid);
        $this->setMsgType($type);
    }

    /**
     *  设置 用户
     **/
    public function setTouser($openid)
    {
        $this->touser = $openid;

        $this->queryParameters['touser'] = $openid;
    }

    /**
     *  获取 用户
     **/
    public function getTourser()
    {
        return $this->touser;
    }

    /**
     *  设置 消息类型
     **/
    public function setMsgtype($type)
    {
        $this->msgtype = $type;

        $this->queryParameters['msgtype'] = $type;
    }

    /**
     *  获取 消息类型
     **/
    public function getMsgtype()
    {
        return $this->msgtype;
    }

    /**
     *  设置 文本消息内容
     **/
    public function setText($content)
    {
        $this->text = array("content" => $content);

        $this->queryParameters['text'] = array("content" => $content);
    }

    /**
     *  获取 文本消息内容
     **/
    public function getContent($content)
    {
        return $this->content;
    }

    /**
     *  设置 图片消息内容
     **/
    public function setImage($mediaId)
    {
        $this->image = array("media_id" => $mediaId);

        $this->queryParameters['image'] = array("media_id" => $mediaId);
    }

    /**
     *  获取 图片消息内容
     **/
    public function getImage()
    {
        return $this->image;
    }

    /**
     *  设置 语音消息内容
     **/
    public function setVoice($mediaId)
    {
        $this->voice = array("media_id" => $mediaId);

        $this->queryParameters['voice'] = array("media_id" => $mediaId);
    }

    /**
     *  获取 语音消息内容
     **/
    public  function getVoice()
    {
        return $this->voice;
    }

    /**
     *  设置 视频消息内容
     **/
    public function setVideo($mediaId, $thumbMediaId, $title, $description)
    {
        $this->video = array(
            "media_id" => $mediaId,
            "thumb_media_id" => $thumbMediaId,
            "title" => $title,
            "description" => $description
        );

        $this->queryParameters['video'] = $this->video;
    }

    /***
     *  获取 视频消息内容
     **/
    public function getVideo()
    {
        return $this->video;
    }

    /**
     *  设置 音乐消息内容
     **/
    public function setMusic($title, $description, $musicurl, $hqmusicurl, $thumbMediaId)
    {
        $this->music = array(
            "title" => $title,
            "description" => $description,
            "musicurl" => $musicurl,
            "hqmusicurl" => $hqmusicurl,
            "thumb_media_id" => $thumbMediaId
        );

        $this->queryParameters['music'] = $this->music;
    }

    /**
     *  获取 音乐消息内容
     **/
    public function getMusic()
    {
        return $this->music;
    }

    /**
     *  设置 图文消息内容
     **/
    public function setNews($articles)
    {
        $this->news = array(
            "articles" => $articles
        );

        $this->queryParameters['news'] = $this->news;
    }

    /**
     *  获取 图文消息内容
     **/
    public function getNews()
    {
        return $this->news;
    }

    /**
     *  设置 图文消息内容
     **/
    public function setMpnews($mediaId)
    {
        $this->mpnews = array("media_id" => $mediaId);

        $this->queryParameters['mpnews'] = $this->mpnews;
    }

    /**
     *  获取 图文消息内容
     **/
    public function getMpnews()
    {
        return $this->mpnews;
    }

    /**
     *  设置 卡卷消息内容
     **/
    public function setWxcard($cardId)
    {
        $this->wxcard = array("card_id" => $cardId);

        $this->queryParameters['wxcard'] = $this->wxcard;
    }

    /**
     *  获取 卡卷消息内容
     **/
    public function getWxcard()
    {
        return $this->wxcard;
    }


    /**
     *  设置 小程序卡片内容
     **/
    public function setMiniprogrampage($miniprogrampage)
    {
        $this->miniprogrampage = $miniprogrampage;

        $this->queryParameters["miniprogrampage"] = $miniprogrampage;
    }

    /**
     *  获取 小程序卡片内容
     **/
    public function getMiniprogrampage()
    {
        return $this->miniprogrampage;
    }
}
