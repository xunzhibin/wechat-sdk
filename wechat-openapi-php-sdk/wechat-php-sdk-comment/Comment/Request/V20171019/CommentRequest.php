<?php
/***********************************************
#
#      Filename: CommentRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-19 11:20:04
# Last Modified: 2017-10-19 14:59:55
***********************************************/

namespace Comment\Request\V20171019;

class CommentRequest extends \DefaultRequest
{
    /**
     *  群发文章ID
     **/
    private $msgDataId;

    /**
     *  多图文，指定图文位置
     **/
    private $index;

    /**
     *  起始位置
     **/
    private $begin;

    /**
     *  获取数目
     **/
    private $count;

    /**
     *  评论类型
     **/
    private $type;

    /**
     *  用户评论Id
     **/
    private $userCommentId;

    /**
     *  回复内容
     **/
    private $replyContent;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  初始化 打开已群发文章评论 参数
     **/
    public function openInit($accessToken, $msgDataId, $index)
    {
        parent::requestResponseInit("POST", "JSON", "Comment", "open");

        parent::setAccessToken($accessToken);

        $this->setMsgDataId($msgDataId);
        $this->setIndex($index);
    }

    /**
     *  初始化 关闭已群发文章评论 参数
     **/
    public function closeInit($accessToken, $msgDataId, $index)
    {
        parent::requestResponseInit("POST", "JSON", "Comment", "close");

        parent::setAccessToken($accessToken);

        $this->setMsgDataId($msgDataId);
        $this->setIndex($index);
    }

    /**
     *  初始化 文章的评论列表 参数
     **/
    public function listInit($accessToken, $msgDataId, $index, $begin, $count, $type)
    {
        parent::requestResponseInit("POST", "JSON", "Comment", "list");

        parent::setAccessToken($accessToken);

        $this->setMsgDataId($msgDataId);
        $this->setIndex($index);
        $this->setBegin($begin);
        $this->setCount($count);
        $this->setType($type);
    }

    /**
     *  初始化 评论标记精选 参数
     **/
    public function markelectInit($accessToken, $msgDataId, $index, $userCommentId)
    {
        parent::requestResponseInit("POST", "JSON", "Comment", "unmarkelect");

        parent::setAccessToken($accessToken);

        $this->setMsgDataId($msgDataId);
        $this->setIndex($index);
        $this->setUserCommentId($userCommentId);
    }

    /**
     *  初始化 评论取消精选 参数
     **/
    public function unmarkelectInit($accessToken, $msgDataId, $index, $userCommentId)
    {
        parent::requestResponseInit("POST", "JSON", "Comment", "markelect");

        parent::setAccessToken($accessToken);

        $this->setMsgDataId($msgDataId);
        $this->setIndex($index);
        $this->setUserCommentId($userCommentId);
    }

    /**
     *  初始化 删除评论 参数
     **/
    public function deleteInit($accessToken, $msgDataId, $index, $userCommentId)
    {
        parent::requestResponseInit("POST", "JSON", "Comment", "delete");

        parent::setAccessToken($accessToken);

        $this->setMsgDataId($msgDataId);
        $this->setIndex($index);
        $this->setUserCommentId($userCommentId);
    }

    /**
     *  初始化 回复评论 参数
     **/
    public function replyInit($accessToken, $msgDataId, $index, $userCommentId, $content)
    {
        parent::requestResponseInit("POST", "JSON", "Comment", "reply");

        parent::setAccessToken($accessToken);

        $this->setMsgDataId($msgDataId);
        $this->setIndex($index);
        $this->setUserCommentId($userCommentId);
        $this->setReplyContent($content);
    }

    /**
     *  初始化 删除回复 参数
     **/
    public function deleteReplyInit($accessToken, $msgDataId, $index, $userCommentId)
    {
        parent::requestResponseInit("POST", "JSON", "Comment", "delete_reply");

        parent::setAccessToken($accessToken);

        $this->setMsgDataId($msgDataId);
        $this->setIndex($index);
        $this->setUserCommentId($userCommentId);
    }

    /**
     *  设置 群发文章ID
     **/
    public function setMsgDataId($msgDataId)
    {
        $this->msgDataId = $msgDataId;

        $this->queryParameters['msg_data_id'] = $msgDataId;
    }

    /**
     *  获取 群发文章ID
     **/
    public function getMsgDataId()
    {
        return $this->msgDataId;
    }

    /**
     *  设置 图文位置
     **/
    public function setIndex($index)
    {
        $this->index = $index;

        $this->queryParameters['index'] = $index;
    }

    /**
     *  获取 图文位置
     **/
    public function getIndex()
    {
        return $this->index;
    }

    /**
     *  设置 起始位置
     **/
    public function setBegin($begin)
    {
        $this->begin = $begin;

        $this->queryParameters['begin'] = $begin;
    }

    /**
     *  获取 起始位置
     **/
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     *  设置 获取数目
     **/
    public function setCount($count)
    {
        $this->count = $count;

        $this->queryParameters['count'] = $count;
    }

    /**
     *  获取 获取数目
     **/
    public  function getCount()
    {
        return $this->count;
    }

    /**
     *  设置 评论类型
     **/
    public function setType($type)
    {
        $this->type = $type;

        $this->queryParamters['type'] = $type;
    }

    /**
     *  获取 评论类型
     **/
    public function getType()
    {
        return $this->type;
    }


    /**
     *  设置 用户评论ID
     **/
    public function setUserCommentId($userCommentId)
    {
        $this->userCommentId = $userCommentId;

        $this->queryParameters['user_comment_id'] = $userCommentId;
    }

    /**
     *  获取  用户评论Id
     **/
    public function getUserCommentId()
    {
        return $this->userCommentId;
    }

    /**
     *  设置 回复内容
     **/
    public function setReplyContent($content)
    {
        $this->replyContent = $content;

        $this->qeuryParameters['content'] = $content;
    }

    /**
     *  获取 回复内容
     **/
    public  function getReplyContent()
    {
        return $this->replyCentent;
    }
}
