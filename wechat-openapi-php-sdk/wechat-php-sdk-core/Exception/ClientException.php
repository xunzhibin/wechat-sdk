<?php
/***********************************************
#
#      Filename: ClientException.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-29 11:12:45
# Last Modified: 2017-09-29 12:09:00
***********************************************/

class ClientException extends Exception
{
    /**
     *  错误信息
     **/
    private $errorMessage;

    /**
     *  错误代码
     **/
    private $errorCode;

    /**
     *  错误 类型
     **/
    private $errorType;

    public function __construct($errorMessage, $errorCode)
    {
        parent::__construct($errorMessage);

        $this->errorMessage = $errorMessage;
        $this->errorCode = $errorCode;
    }

    /**
     *  设置 错误信息
     **/
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     *  获取 错误信息
     **/
    public function getErrorMessage($errorMessage)
    {
        return $this->errorMessage;
    }

    /**
     *  设置 错误代码
     **/
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    /**
     *  获取 错误代码
     **/
    public function getErrorCode($errorCode)
    {
        return $this->errorCode;
    }

    /**
     *  设置 错误类型
     **/
    public function setErrorType($errorType)
    {
        $this->errorType = $errorType;
    }

    /**
     *  获取 错误类型
     **/
    private function getErrorType()
    {
        return $this->errorType;
    }
}
