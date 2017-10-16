<?php
/***********************************************
#
#      Filename: Http_response.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-26 12:56:12
# Last Modified: 2017-09-26 13:02:40
***********************************************/

class HttpResponse
{
    /**
     *  返回 状态
     **/
    private $status;

    /**
     *  返回 数据
     **/
    private $body;

    /**
     *  设置 返回状态
     **/
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     *  设置 返回数据
     **/
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     *  获取 返回状态
     **/
    public function getStatus()
    {
        return $this->status;
    }

    /**
     *  获取 返回数据
     **/
    public function getBody()
    {
        return $this->body;
    }


    /**'
     *  检查 请求是否成功
     **/
    public function isSuccess()
    {
        if(200 <= $this->status && $this->status < 300)
        {
            return TRUE;
        }

        return FALSE;
    }
}
