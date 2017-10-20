<?php
/***********************************************
#
#      Filename: IndustryRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-11 09:39:44
# Last Modified: 2017-10-11 11:05:06
***********************************************/

namespace News\Request\V20171010;

class IndustryRequest extends \DefaultRequest
{
    /**
     *  行业代号
     **/
    private $industryIds;

    public function __construct()
    {
		parent::__construct();
    }

    /**
     *  初始化 设置 行业信息 参数
     **/
    public function setInit($token = NULL, $industrys = NULL)
    {
		parent::requestResponseInit("POST", "JSON", "News", "set_industry");

		parent::setAccessToken($token);

        $this->setIndustryId($industrys);
    }

    /**
     *  初始化 获取 行业信息 参数
     **/
    public function getInit($token = NULL)
    {
		parent::requestResponseInit("GET", "JSON", "News", "get_industry");

		parent::setAccessToken($token);
    }

    /**
     *  设置 行业代号
     **/
    public function setIndustryId($industrys)
    {
        $indestrys = is_array($industrys) ? $industrys : array($industrys);

        $industryIds = array();
        $i = 1;
        foreach($indestrys as $industryId)
        {
            $key = "industry_id" . $i;
            $i++;

            $this->industryIds[$key] = $industryId;
            $this->queryParameters[$key] = $industryId;
        }
    }

    /**
     *  获取 行业代号
     **/
    public function getIndustryId()
    {
        return $this->industryIds;
    }
}
