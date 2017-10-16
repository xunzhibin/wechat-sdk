<?php
/***********************************************
#
#      Filename: WechatApiExample.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-13 14:02:04
# Last Modified: 2017-10-13 14:02:50
***********************************************/
require_once  APPPATH . "libraries/wechat-openapi-php-sdk/wechat-php-sdk-core/config.php";
use Oauth\Request\V20170926 as Oauth;
use Token\Request\V20170930 as Token;
use News\Request\V20171010 as News;
use Jsapi\Request\V20171010 as Jsapi;
use User\Request\V20171010 as User;
use Account\Request\V20171011 as Account;

class WechatApiExample
{
	/**
     *  错误信息
     **/
	 private $errorMsg;

    /**
     *  网页授权 (微信客户端 获取微信用户信息)
     **/
	public function webGetUserinfo()
	{
		$this->request = new Oauth\UserinfoRequest();
		$this->client = new PageAuthClient();

		$result = $this->client->getUserinfo($this->request);

		return $this->response($result);
	}

    /**
     *  获取 全局唯一接口调用凭据(access token)
     **/
	public function getAccessToken()
	{
        $this->request = new Token\AccessTokenRequest();

        $this->client = new AcsClient();

        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

    /**
     *  获取 jsapi ticket (微信客户端 分享、图像、音频等js接口调用时的票据)
     **/
	public function getJsApiTicket($accessToken)
	{
        $this->request = new Jsapi\JsTicketRequest($accessToken);
        $this->client = new AcsClient();

        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}
	
	/**
     *  获取 jsapi 权限验证配置 (微信客户端 分享、图像、音频等js接口调用时配置)
     **/
	public function getJsApiConfig($ticket, $url = NULL)
	{
        $client = new JsapiClient($ticket, $url);

        $result = $client->getJsapiConfig();
        // $config = $client->getConfig();
        // var_dump($config);

		return $result;
	}
	
	/**
     *  获取 微信用户基本信息
     **/
	public function getWecahtUserInfo($accessToken, $openid)
	{
        $this->request = new User\UserRequest();
		$this->client = new AcsClient();

        $this->request->infoInit($accessToken, $openid);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  获取 微信用户基本信息(批量)
     **/
	public function getWecahtUserInfoBatch($accessToken, $openids)
	{
        $this->request = new User\UserRequest();
		$this->client = new AcsClient();

        $this->request->batchInfoInit($accessToken, $openids);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  获取 关注用户列表
     **/
	public function getSubscribeUserList($accessToken, $nextOpenid = NULL)
	{
        $this->request = new User\ListRequest($accessToken, $nextOpenid);
		$this->client = new AcsClient();

        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}
	
	/**
     *  创建标签
     **/
	public function postTags($accessToken, $name)
	{
        $this->request = new User\TagsRequest();
		$this->client = new AcsClient();

		$this->request->createInit($accessToken, $name);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}
	
	/**
     *  编辑标签
     **/
	public function putTags($accessToken, $id, $name)
	{
        $this->request = new User\TagsRequest();
		$this->client = new AcsClient();

		$this->request->updateInit($accessToken, $id, $name);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}
	
	/**
     *  删除标签
     **/
	public function deleteTags($accessToken, $id)
	{
        $this->request = new User\TagsRequest();
		$this->client = new AcsClient();

		$this->request->deleteInit($accessToken, $id);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}

	/**
     *  获取 公众号已创建的标签
     **/
	public function getTags($accessToken)
	{
        $this->request = new User\TagsRequest();
		$this->client = new AcsClient();

		$this->request->getInit($accessToken);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  发送文本消息
     **/
	public function sendText($accessToken, $openid, $content)
	{
        $this->request = new News\CustomerServiceRequest();
        $this->client = new AcsClient();

        $this->request->textInit($accessToken, $openid, $content);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}
	
	/**
     *  发送图片消息
     **/
	public function sendImage($accessToken, $openid, $mediaId)
	{
        $this->request = new News\CustomerServiceRequest();
        $this->client = new AcsClient();

        $this->request->imageInit($accessToken, $openid, $mediaId);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}
	
	/**
     *  发送语音消息
     **/
	public function sendVoice($accessToken, $openid, $mediaId)
	{
        $this->request = new News\CustomerServiceRequest();
        $this->client = new AcsClient();

        $this->request->voiceInit($accessToken, $openid, $mediaId);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}
	
	/**
     *  发送视频消息
     **/
	public function sendVideo($accessToken, $openid, $mediaId, $thumbMediaId, $title, $description)
	{
        $this->request = new News\CustomerServiceRequest();
        $this->client = new AcsClient();

        $this->request->videoInit($accessToken, $openid, $mediaId, $thumbMediaId, $title, $description);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}
	
	/**
     *  发送音乐消息
     **/
	public function sendMusic($accessToken, $openid, $title, $description, $musicurl, $hqmusicurl, $thumbMediaId)
	{
        $this->request = new News\CustomerServiceRequest();
        $this->client = new AcsClient();

		$this->request->musicInit($accessToken, $openid, $title, $description, $musicurl, $hqmusicurl, $thumbMediaId);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}
	
	/**
     *  发送图文消息
     **/
	public function sendNews($accessToken, $openid, $articles)
	{
        $this->request = new News\CustomerServiceRequest();
        $this->client = new AcsClient();

		$this->request->newsInit($accessToken, $openid, $articles);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}

	/**
     *  发送图文消息
     **/
	public function sendMpnews($accessToken, $openid, $mediaId)
	{
        $this->request = new News\CustomerServiceRequest();
        $this->client = new AcsClient();

		$this->request->mpnewsInit($accessToken, $openid, $mediaId);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}

	/**
     *  发送卡券消息
     **/
	public function sendWxcard($accessToken, $openid, $cardId)
	{
        $this->request = new News\CustomerServiceRequest();
        $this->client = new AcsClient();

		$this->request->wxcardInit($accessToken, $openid, $cardId);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}

	/**
     *  发送小程序卡片消息
     **/
	public function sendMiniprogrampage($accessToken, $openid, $miniprogrampage)
	{
        $this->request = new News\CustomerServiceRequest();
        $this->client = new AcsClient();

		$this->request->miniprogrampageInit($accessToken, $openid, $miniprogrampage);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}

	/**
     *  获取 模板列表
     **/
	public function getTemplateList($accessToken)
	{
        $this->request = new News\TemplateRequest();
        $this->client = new AcsClient();

        $this->request->listInit($accessToken);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  删除 模板
     **/
	public function deleteTemplate($accessToken, $templateId)
	{
        $this->request = new News\TemplateRequest();
        $this->client = new AcsClient();

        $this->request->delInit($accessToken, $templateId);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}

	/**
     *  获取 模板ID
     **/
	public function getTemplateId($accessToken, $templateIdShort)
	{
        $this->request = new News\TemplateRequest();
        $this->client = new AcsClient();

        $this->request->getInit($accessToken, $templateIdShort);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  发送模版消息
     **/
	public function sendTemplate($accessToken, $param)
	{
        $this->request = new News\TemplateRequest();
        $this->client = new AcsClient();

        $this->request->sendInit($accessToken, $param);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}

	/**
     *  获取短链接
     **/
	public function getShortUrl($accessToken, $url)
	{
        $this->request = new Account\ShortUrlRequest($accessToken, $url);
        $this->client = new AcsClient();

        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  获取 带参数的二维码
     **/
	public function getQrcode($accessToken, $scene, $expireSeconds)
	{
        $this->request = new Account\QrCodeRequest();
        $this->client = new AcsClient();

        $this->request->ticketInit($accessToken, $scene, $expireSeconds);
        $result = $this->client->getAcsResponse($this->request);

		if(isset($result["errcode"]) && $result["errcode"] !== 0)
		{
			$this->setErrorMsg($result["errcode"], $result["errmsg"]);

			return FALSE;
		}
        $ticket = $result['ticket'];

        $this->request->qrcodeInit($ticket);
        $requestUrl = $this->client->getRequestUrl($this->request);

		return $requestUrl;
	}

	/**
     *  一次性订阅消息授权
     **/
	public function oneTimeSubscribeAuthorization($templateId, $scene, $redirectUrl, $reserved)
	{
        $this->request = new News\SubscribeRequest();

        $this->request->authorizationInit($templateId, $scene, $redirectUrl, $reserved);

        $this->client = new SubscribeClient();
        $this->client->subscribeMsgAuthorization($this->request);
	}

	/**
     *  一次性订阅消息授权后 发送模版信息
     **/
	public function sendSubscribeTemplateForOneTime($accessToken, $param)
	{
        $this->request = new News\SubscribeRequest();
        $this->client = new AcsClient();

        $this->request->templateInit($accessToken, $param);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}
	
	/**
     *  设置 行业信息
     **/
	public function setIndustry($accessToken, $industrys)
	{
        $this->request = new News\IndustryRequest();
        $this->client = new AcsClient();

        $this->request->setInit($accessToken, $industrys);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}
	
	/**
     *  获取 设置的行业信息
     **/
	public function getIndustry($accessToken)
	{
        $this->request = new News\IndustryRequest();
        $this->client = new AcsClient();

        $this->request->getInit($accessToken);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  获取 公众号自动回复规则
     **/
	public function getAutoreplyRule($accessToken)
	{
        $this->request = new News\AutoreplyRuleRequest($accessToken);
        $this->client = new AcsClient();

        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}
	
    /**
     *  
     **/
	public function response($data, $bool = FALSE)
	{
		if(isset($data["errcode"]) && $data["errcode"] !== 0)
		{
			$this->setErrorMsg($data["errcode"], $data["errmsg"]);

			return FALSE;
		}

		return $bool ? TRUE : $data;
	}

    /**
     *  设置 错误信息
     **/
	 public function setErrorMsg($errcode, $errmsg)
	 {
		 $this->errorMsg = $errcode . " " . $errmsg;
	 }
	 
	/**
     *  设置 错误信息
     **/
	 public function getErrorMsg()
	 {
		 return $this->errorMsg;
	 }
}




$this->wechatapiexample = new WechatApiExample();
/** 网页授权 获取 微信用户信息 **/
// if( ($result = $this->wechatapiexample->webGetUserInfo()) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 全局唯一接口调用凭据(access token) **/
if( ($result = $this->wechatapiexample->getAccessToken()) === FALSE)
{
	echo $this->wechatapiexample->getErrorMsg();exit;
}
$access_token = $result["access_token"];


/** 获取 jsapi ticket **/
// if( ($result = $this->wechatapiexample->getJsApiTicket($access_token)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }
// $jsApiTicket = $result["ticket"];


/** 获取 jsapi 权限验证配置 **/
// $result = $this->wechatapiexample->getJsApiConfig($jsApiTicket);


/** 获取 用户基本信息 **/
// $openid = "oLcvtjgivHZLDPxei1N8h0pvH3u8";
// if( ($result = $this->wechatapiexample->getWecahtUserInfo($access_token, $openid)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 批量获取 用户基本信息 **/
// $openids = array(
	// "oLcvtjgivHZLDPxei1N8h0pvH3u8", "oLcvtjoEYqIGAapOMjX-pw1V_0cA"
// );
// if( ($result = $this->wechatapiexample->getWecahtUserInfoBatch($access_token, $openids)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 关注用户列表 **/
// $nextOpenid = NULL;
// $nextOpenid = "oLcvtjoEYqIGAapOMjX-pw1V_0cA";
// $nextOpenid = "oLcvtjgivHZLDPxei1N8h0pvH3u8";
// if( ($result = $this->wechatapiexample->getSubscribeUserList($access_token, $nextOpenid)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 公众号已创建的标签 **/
// if( ($result = $this->wechatapiexample->getTags($access_token)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 创建标签 **/
// $name = "锦囊专家网";
// if( ($result = $this->wechatapiexample->postTags($access_token, $name)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 编辑标签 **/
// $id = 101;
// $name = "锦囊专家网";
// if( ($result = $this->wechatapiexample->putTags($access_token, $id, $name)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }

/** 获取 编辑标签 **/
// $id = 101;
// if( ($result = $this->wechatapiexample->deleteTags($access_token, $id)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 发送文本消息 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// $content = "客服文本消息测试";
// if( ($result = $this->wechatapiexample->sendText($access_token, $openid, $content)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }

/**  发送图片消息 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// $mediaId = "";
// if( ($result = $this->wechatapiexample->sendImage($access_token, $openid, $mediaId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/**  发送语音消息 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// $mediaId = "";
// if( ($result = $this->wechatapiexample->sendVoice($access_token, $openid, $mediaId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 发送视频消息 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// $mediaId = "";
// $thumbMediaId = "";//图片的媒体ID
// $title = "title";//标题
// $description = "描述";//描述
// if( ($result = $this->wechatapiexample->sendVideo($access_token, $openid, $mediaId, $thumbMediaId, $title, $description)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }



/** 发送音乐消息 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// $title = "title";//标题
// $description = "描述";//描述
// $musicurl = "";//音乐链接
// $hqmusicurl = "";//高品质音乐链接，wifi环境优先使用该链接播放音乐
// $thumbMediaId = "";//图片的媒体ID
// if( ($result = $this->wechatapiexample->sendMusic($access_token, $openid, $title, $description, $musicurl, $hqmusicurl, $thumbMediaId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 发送图文消息 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// $articles = array(
	// array(
		// "title" => "第一个标题",//标题
		// "description" => "第一个描述",//描述
		// "url" => "http://www.jnexpert.com",//图文消息被点击后跳转的链接
		// "picurl" => "http://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=%E6%B7%98%E5%AE%9Dlogo%2080x80&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=-1&cs=3491591621,2894126709&os=1332121565,2295977210&simid=2010581,593344716&pn=1&rn=1&di=143503894160&ln=263&fr=&fmq=1507889026609_R&fm=rs4&ic=undefined&s=undefined&se=&sme=&tab=0&width=undefined&height=undefined&face=undefined&is=0,0&istype=0&ist=&jit=&bdtype=0&spn=0&pi=0&gsm=0&hs=2&oriquery=80x80%E7%B4%A0%E6%9D%90&objurl=http%3A%2F%2Fp5.zbjimg.com%2Ftask%2F2011-04%2F27%2F712337%2Flarge4db7b1355b86b.png&rpstart=0&rpnum=0&adpicid=0"//图文消息的图片链接
	// ),
	// array(
		// "title" => "第二个标题",//标题
		// "description" => "第二个描述",//描述
		// "url" => "http://www.baidu.com",//图文消息被点击后跳转的链接
		// "picurl" => "http://img2.imgtn.bdimg.com/it/u=1429582701,2461922663&fm=11&gp=0.jpg"//图文消息的图片链接
	// ),
// );
// if( ($result = $this->wechatapiexample->sendNews($access_token, $openid, $articles)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 发送图文消息 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// $mediaId = "";//媒体ID
// if( ($result = $this->wechatapiexample->sendMpnews($access_token, $openid, $mediaId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 发送卡券消息 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// $cardId = "";//卡卷Id
// if( ($result = $this->wechatapiexample->sendWxcard($access_token, $openid, $cardId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 发送小程序卡片消息 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// $miniprogrampage = array(
	// "title" => "标题",//标题
	// "appid" => "",//小程序appid
	// "pagepath" => "",//小程序的页面路径
	// "thumb_media_id" => ""//缩略图/小程序卡片图片的媒体ID
// );
// if( ($result = $this->wechatapiexample->sendMiniprogrampage($access_token, $openid, $miniprogrampage)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 模板列表 **/
// if( ($result = $this->wechatapiexample->getTemplateList($access_token)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 删除 模板 **/
// $templateId = "CpYWBY0Lmy2zWrtWzNYZi_KoQUvLYcA6bXTDC0F_cT0";
// if( ($result = $this->wechatapiexample->deleteTemplate($access_token, $templateId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 模板ID **/
// $templateIdShort = "TM00015";
// if( ($result = $this->wechatapiexample->getTemplateId($access_token, $templateIdShort)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 发送模版消息 **/
// $param = array(
	// "touser" => "oLcvtjrKX5V6oZxSlcGCn1JOJXyE",
	// "templateId" => "CpYWBY0Lmy2zWrtWzNYZi_KoQUvLYcA6bXTDC0F_cT0",
	// "url" => "http://www.jnexpert.com",
	// "miniprogram" => array(
		// "appid" => "xiaochengxuappid12345",
		// "pagepath" => "index?foo=bar",
	// ),
	// "data" => array(
		// "first" => array(
			// "value" => "恭喜你！",
			// "color" => "#173177",
		// ),
		// "keynote1" => array(
			// "value" =>"巧克力",
			// "color" => "#173177"
		// ),
	// ),
// );
// if( ($result = $this->wechatapiexample->sendTemplate($access_token, $param)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 长链接 转换为 短链接 **/
// $url = "http://www.jnexpert.com/activity/activityDetail?a=16";
// if( ($result = $this->wechatapiexample->getShortUrl($access_token, $url)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 带参数的二维码 **/
// $scene = 1;
// $scene = "xunzhibin";
// $expireSeconds = 2592000;
// $expireSeconds = NULL;
// if( ($result = $this->wechatapiexample->getQrcode($access_token, $scene, $expireSeconds)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }

// Header("Location: $result");
// exit();


/** 一次性订阅消息授权 **/
// $templateId = "1uDxHNXwYQfBmXOfPJcjAS3FynHArD8aWMEFNRGSbCc";
// $scene = 1;
// $redirectUrl = "http://www.jnexpert.com?a=12";
// $reserved = time();
// $this->wechatapiexample->oneTimeSubscribeAuthorization($templateId, $scene, $redirectUrl, $reserved);


/** 一次性订阅消息授权后 发送模版信息 **/
// $param = array(
	// "touser" => "oLcvtjrKX5V6oZxSlcGCn1JOJXyE",
	// "templateId" => "1uDxHNXwYQfBmXOfPJcjAS3FynHArD8aWMEFN",
	// "url" => "http://www.jnexpert.com",
	// "scene" => 1,
	// "title" => "测试标题",
	// "data" => array(
		// "content" => array(
			// "value" => "恭喜你！",
			// "color" => "#173177",
		// ),
	// ),
// );
// if( ($result = $this->wechatapiexample->sendSubscribeTemplateForOneTime($access_token, $param)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 设置 行业信息 **/
// $industrys = array(
	// 1, 4
// );
// if( ($result = $this->wechatapiexample->setIndustry($access_token, $industrys)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 设置的行业信息 **/
// if( ($result = $this->wechatapiexample->getIndustry($access_token)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 公众号自动回复规则 **/
// if( ($result = $this->wechatapiexample->getAutoreplyRule($access_token)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }

var_dump($result);