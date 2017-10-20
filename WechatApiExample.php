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
use Menu\Request\V20171017 as Menu;
use Oauth\Request\V20170926 as Oauth;
use Token\Request\V20170930 as Token;
use News\Request\V20171010 as News;
use Jsapi\Request\V20171010 as Jsapi;
use User\Request\V20171010 as User;
use Account\Request\V20171011 as Account;
use Customservice\Request\V20171017 as Customservice;
use Material\Request\V20171017 as Material;
use Comment\Request\V20171019 as Comment;

class WechatApiExample
{
	/**
     *  链接 句柄
     **/
	 private $client;
	 
	/**
     *  错误信息
     **/
	 private $errorMsg;

	 public function __construct()
	 {
		 $this->client = new AcsClient();
	 }

    /**
     *  获取 自定义菜单配置信息
     **/
	public function getMenuInfo($accessToken)
	{
		$request = new Menu\MenuRequest();

		$request->InfoInit($accessToken);
        $result = $this->client->getAcsResponse($request);

		return $this->response($result);
	}

    /**
     *  获取 自定义菜单
     **/
	public function getMenu($accessToken)
	{
		$request = new Menu\MenuRequest();

		$request->getInit($accessToken);
        $result = $this->client->getAcsResponse($request);

		return $this->response($result);
	}

    /**
     *  创建 自定义菜单
     **/
	public function postMenu($accessToken, $button)
	{
		$request = new Menu\MenuRequest();

		$request->createInit($accessToken, $button);
        $result = $this->client->getAcsResponse($request);

		return $this->response($result, TRUE);
	}
	
	/**
     *  删除 自定义菜单
     **/
	public function deleteMenu($accessToken)
	{
		$request = new Menu\MenuRequest();

		$request->deleteInit($accessToken);
        $result = $this->client->getAcsResponse($request);

		return $this->response($result, TRUE);
	}

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

        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

    /**
     *  获取 jsapi ticket (微信客户端 分享、图像、音频等js接口调用时的票据)
     **/
	public function getJsApiTicket($accessToken)
	{
        $this->request = new Jsapi\JsTicketRequest($accessToken);

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

        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}
	
	/**
     *  创建标签
     **/
	public function postTags($accessToken, $name)
	{
        $this->request = new User\TagsRequest();

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

		$this->request->deleteInit($accessToken, $id);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}
	
	/**
     *  获取 标签下粉丝列表
     **/
	public function getUserListToTags($accessToken, $tagid, $nextOpenid)
	{
        $this->request = new User\TagsRequest();

		$this->request->userListInit($accessToken, $tagid, $nextOpenid);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}
	
	/**
     *	批量为用户打标签
     **/
	public function addTagsBatchForUser($accessToken, $tagid, $openidList)
	{
        $this->request = new User\TagsRequest();

		$this->request->addTagsBatchInit($accessToken, $tagid, $openidList);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}
	
	/**
     *	批量为用户取消标签
     **/
	public function clearTagsBatchForUser($accessToken, $tagid, $openidList)
	{
        $this->request = new User\TagsRequest();

		$this->request->clearTagsBatchInit($accessToken, $tagid, $openidList);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}
	
	/**
     *	获取用户身上的标签列表
     **/
	public function getTagsListForUser($accessToken, $openid)
	{
        $this->request = new User\TagsRequest();

		$this->request->tagsListInit($accessToken, $openid);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}
	
	/**
     *	设置用户备注名
     **/
	public function putRemark($accessToken, $openid, $remark)
	{
        $this->request = new User\RemarkRequest();

		$this->request->remarkInit($accessToken, $openid, $remark);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}

	/**
     *  获取 公众号已创建的标签
     **/
	public function getTags($accessToken)
	{
        $this->request = new User\TagsRequest();

		$this->request->getInit($accessToken);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  获取 所有客服账号
     **/
	public function getKfList($accessToken)
	{
        $this->request = new Customservice\CustomserviceRequest();

		$this->request->listInit($accessToken);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  添加 客服账号
     **/
	public function postKfAccount($accessToken, $kfAccount, $name, $password)
	{
        $this->request = new Customservice\CustomserviceRequest();

		$this->request->addInit($accessToken, $kfAccount, $name, $password);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  更新 客服账号
     **/
	public function putKfAccount($accessToken, $kfAccount, $name, $password)
	{
        $this->request = new Customservice\CustomserviceRequest();

		$this->request->updateInit($accessToken, $kfAccount, $name, $password);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}

	/**
     *  删除 客服账号
     **/
	public function deleteKfAccount($accessToken, $kfAccount, $name, $password)
	{
        $this->request = new Customservice\CustomserviceRequest();

		$this->request->deleteInit($accessToken, $kfAccount, $name, $password);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result, TRUE);
	}

	/**
     *  发送文本消息
     **/
	public function sendText($accessToken, $openid, $content)
	{
        $this->request = new News\CustomerServiceRequest();

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

        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  获取 带参数的二维码
     **/
	public function getQrcode($accessToken, $scene, $expireSeconds)
	{
        $this->request = new Account\QrCodeRequest();

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

        $this->request->getInit($accessToken);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  获取 永久素材列表
     **/
	public function getMaterialList($accessToken, $type, $offset, $count)
	{
        $this->request = new Material\MaterialRequest();

        $this->request->listInit($accessToken, $type, $offset, $count);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  获取 永久素材总数
     **/
	public function getMaterialCount($accessToken)
	{
        $this->request = new Material\MaterialRequest();

        $this->request->countInit($accessToken);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  更新 永久图文素材
     **/
	public function putMaterialNews($accessToken, $mediaId, $index, $articles)
	{
        $this->request = new Material\MaterialRequest();

        $this->request->updateInit($accessToken, $mediaId, $index, $articles);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  删除 永久素材
     **/
	public function deleteMaterial($accessToken, $mediaId)
	{
        $this->request = new Material\MaterialRequest();

        $this->request->deleteInit($accessToken, $mediaId);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  获取 永久素材
     **/
	public function getMaterialInfo($accessToken, $mediaId)
	{
        $this->request = new Material\MaterialRequest();

        $this->request->getInit($accessToken, $mediaId);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  添加 永久图文素材
     **/
	public function postNewsMaterial($accessToken, $articles)
	{
        $this->request = new Material\MaterialRequest();

        $this->request->addNewsInit($accessToken, $articles);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  上传 图文消息内的图片
     **/
	public function uploadImgNewsMaterial($accessToken, $media)
	{
        $this->request = new Material\MaterialRequest();

        $this->request->uploadImgInit($accessToken, $media);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  添加 其他类型永久素材 图片(image) 语音(voice) 视频(video) 缩略图(thumb)
     **/
	public function addMaterial($accessToken, $type, $media, $description = NULL)
	{
        $this->request = new Material\MaterialRequest();

        $this->request->addInit($accessToken, $type, $media, $description);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  上传 临时素材
     **/
	public function uploadTempMedia($accessToken, $type, $mediaId)
	{
        $this->request = new Material\TempMediaRequest();

        $this->request->uploadInit($accessToken, $type, $mediaId);
        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}

	/**
     *  获取 临时素材
     **/
	public function getTempMedia($accessToken, $mediaId, $type)
	{
        $this->request = new Material\TempMediaRequest();

        $this->request->getInit($accessToken, $mediaId);
		
		if($type == "video")//视频
		{
			$result = $this->client->getAcsResponse($this->request);
			
			return $this->response($result);
		}
		else
		{
			$requestUrl = $this->client->getRequestUrl($this->request);

			return $requestUrl;
		}
	}

	/**
     *  打开 已群发文章评论
     **/
	public function openComment($accessToken, $msgDataId, $index)
	{
        $this->request = new Comment\CommentRequest();

        $this->request->openInit($accessToken, $msgDataId, $index);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result);
	}

	/**
     *  关闭 已群发文章评论
     **/
	public function closeComment($accessToken, $msgDataId, $index)
	{
        $this->request = new Comment\CommentRequest();

        $this->request->closeInit($accessToken, $msgDataId, $index);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result);
	}

	/**
     *  获取 指定文章评论列表
     **/
	public function getCommentList($accessToken, $msgDataId, $index, $begin, $count, $type)
	{
        $this->request = new Comment\CommentRequest();

        $this->request->listInit($accessToken, $msgDataId, $index, $begin, $count, $type);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result);
	}

	/**
     *  将评论标记精选
     **/
	public function markelectComment($accessToken, $msgDataId, $index, $userCommentId)
	{
        $this->request = new Comment\CommentRequest();

        $this->request->markelectInit($accessToken, $msgDataId, $index, $userCommentId);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result);
	}

	/**
     *  将评论取消精选
     **/
	public function unmarkelectComment($accessToken, $msgDataId, $index, $userCommentId)
	{
        $this->request = new Comment\CommentRequest();

        $this->request->unmarkelectInit($accessToken, $msgDataId, $index, $userCommentId);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result);
	}

	/**
     *  删除 评论
     **/
	public function deleteComment($accessToken, $msgDataId, $index, $userCommentId)
	{
        $this->request = new Comment\CommentRequest();

        $this->request->deleteInit($accessToken, $msgDataId, $index, $userCommentId);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result);
	}

	/**
     *  回复 评论
     **/
	public function replyComment($accessToken, $msgDataId, $index, $userCommentId, $content)
	{
        $this->request = new Comment\CommentRequest();

        $this->request->replyInit($accessToken, $msgDataId, $index, $userCommentId, $content);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result);
	}

	/**
     *  删除 评论回复
     **/
	public function deleteReplyToComment($accessToken, $msgDataId, $index, $userCommentId)
	{
        $this->request = new Comment\CommentRequest();

        $this->request->deleteReplyInit($accessToken, $msgDataId, $index, $userCommentId);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result);
	}

	/**
     *	批量 拉黑用户
     **/
	public function batchPullBlacklist($accessToken, $openidList)
	{
        $this->request = new User\BlacklistRequest();

        $this->request->batchPullBlackInit($accessToken, $openidList);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result, TRUE);
	}

	/**
     *	批量 取消拉黑用户
     **/
	public function batchClearBlacklist($accessToken, $openidList)
	{
        $this->request = new User\BlacklistRequest();

        $this->request->batchClearBlackInit($accessToken, $openidList);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result, TRUE);
	}

	/**
     *	获取 公众号的黑名单列表
     **/
	public function getBlacklist($accessToken, $beginOpenid)
	{
        $this->request = new User\BlacklistRequest();

        $this->request->listInit($accessToken, $beginOpenid);

		$result = $this->client->getAcsResponse($this->request);
		
		return $this->response($result);
	}

	/**
     *  获取 公众号自动回复规则
     **/
	public function getAutoreplyRule($accessToken)
	{
        $this->request = new News\AutoreplyRuleRequest($accessToken);

        $result = $this->client->getAcsResponse($this->request);

		return $this->response($result);
	}
	
    /**
     *  
     **/
	public function response($data, $response_bool = FALSE)
	{
		if(isset($data["errcode"]) && $data["errcode"] !== 0)
		{
			$this->setErrorMsg($data["errcode"], $data["errmsg"]);

			return FALSE;
		}

		return $response_bool ? TRUE : $data;
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
if( ($result = $this->wechatapiexample->webGetUserInfo()) === FALSE)
{
	echo $this->wechatapiexample->getErrorMsg();exit;
}


/** 获取 全局唯一接口调用凭据(access token) **/
// if( ($result = $this->wechatapiexample->getAccessToken()) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }
// var_dump($result["access_token"]);exit;
// $access_token = $result["access_token"];
// $access_token = "yOV0wGqzK-sk2vzZBFwto9tQnGHLHVTaU8BnDaCAlaG4X-_GwVN75ibHPR_qFKT4IIShzcdZW8tfFm6e6Ym1jX-VCvNyOabsRx2M_Rgrw3zzxgSXEZaUonLL8luTNUddYZSjAHARSL";


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


/** 更新 标签 **/
// $id = 101;
// $name = "锦囊专家网";
// if( ($result = $this->wechatapiexample->putTags($access_token, $id, $name)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 删除 标签 **/
// $id = 101;
// if( ($result = $this->wechatapiexample->deleteTags($access_token, $id)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 标签下粉丝用户列表 **/
// $tagid = 2;
// $nextOpenid = "";
// if( ($result = $this->wechatapiexample->getUserListToTags($access_token, $tagid, $nextOpenid)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 批量为用户打标签 **/
// $tagid = 2;
// $openidList = array(
	// "oLcvtjrKX5V6oZxSlcGCn1JOJXyE",
	// "oLcvtjn3N2v2YlJm-sWE2ABCO7xg",
// );
// if( ($result = $this->wechatapiexample->addTagsBatchForUser($access_token, $tagid, $openidList)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 批量为用户取消标签 **/
// $tagid = 2;
// $openidList = array(
	// "oLcvtjrKX5V6oZxSlcGCn1JOJXyE",
	// "oLcvtjn3N2v2YlJm-sWE2ABCO7xg",
// );
// if( ($result = $this->wechatapiexample->clearTagsBatchForUser($access_token, $tagid, $openidList)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 用户身上的标签列表 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// if( ($result = $this->wechatapiexample->getTagsListForUser($access_token, $openid)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 设置用户备注名 **/
// $openid = "oLcvtjrKX5V6oZxSlcGCn1JOJXyE";
// $remark = "寻芝彬";
// if( ($result = $this->wechatapiexample->putRemark($access_token, $openid, $remark)) === FALSE)
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


/** 获取 自定义菜单 **/
// if( ($result = $this->wechatapiexample->getMenu($access_token)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 删除 自定义菜单 **/
// if( ($result = $this->wechatapiexample->deleteMenu($access_token)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 创建 自定义菜单 **/
// $button = array(//一级菜单
	// array(
		// "type" => "click",//响应动作类型 网页(view) 点击(click) 小程序(miniprogram)
		// "name" => "领取金锦囊领取金锦囊领取金锦囊领取金锦囊领取金锦囊领取金锦囊领取金锦囊领取金锦囊领取金锦囊",//菜单标题
		// "key" => "receive_vip",//菜单KEY值(点击类型必须)
		// "sub_button" => array(),//二级菜单
	// ),
	// array(
		// "type" => "view",
		// "name" => "听微课听微课听微课听微课听微课听微课",
		// "url" => "http://m.jnexpert.com/?from=jinnangzhuanjia",//网页链接
		// "sub_button" => array(),
	// ),
	// array(
		// "name" => "我的服务我的服务我的服务我的服务我的服务我的服务我的服务",
		// "url" => "http://m.jnexpert.com/?from=jinnangzhuanjia",
		// "sub_button" => array(
			// array(
				// "type" => "view",
				// "name" => "个人中心",
				// "url" => "http://m.jnexpert.com/mobile/PersonCenter/index?from=jinnangzhuanjia",
				// "sub_button" => array(),
			// ),
			// array(
				// "type" => "view",
				// "name" => "下载APP",
				// "url" => "http://m.jnexpert.com/mobile/downloads/index?from=jinnangzhuanjia",
				// "sub_button" => array(),
			// ),
		// ),
	// )
// );
// if( ($result = $this->wechatapiexample->postMenu($access_token, $button)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 自定义菜单配置信息 **/
// if( ($result = $this->wechatapiexample->getMenuInfo($access_token)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 添加 客服账号 **/
// $kfAccount = "xunzhibin";
// $name = "寻";
// $password = "xunzhibin";
// if( ($result = $this->wechatapiexample->postKfAccount($access_token, $kfAccount, $name, $password)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 所有客服账号 **/
// if( ($result = $this->wechatapiexample->getKfList($access_token)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 更新 客服账号 **/
// $kfAccount = "xunzhibin";
// $name = "寻";
// $password = "xunzhibin";
// if( ($result = $this->wechatapiexample->putKfAccount($access_token, $kfAccount, $name, $password)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 删除 客服账号 **/
// $kfAccount = "xunzhibin";
// $name = "寻";
// $password = "xunzhibin";
// if( ($result = $this->wechatapiexample->deleteKfAccount($access_token, $kfAccount, $name, $password)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 永久素材列表 **/
// $type = "image";//素材类型 图片(image) 视频(video) 语音(voice) 图文(news)
// $offset = 0;
// $count = 20;
// if( ($result = $this->wechatapiexample->getMaterialList($access_token, $type, $offset, $count)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 永久素材总数 **/
// if( ($result = $this->wechatapiexample->getMaterialCount($access_token)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 更新 永久图文素材 **/
// $mediaId = "";//图文消息的id
// $index = 0;//更新的文章在图文消息中的位置(多图文消息时,第一篇为0)
// $articles = array(
	// "title" => "标题",//标题
	// "thumb_media_id" => "",//图文消息的封面图片素材id(必须是永久mediaID)
	// "author" => "作者",//作者
	// "digest" => "图文消息的摘要",//图文消息的摘要
	// "show_cover_pic" => 0,//是否显示封面 0(不显示) 1(显示)
	// "content" => "图文消息的具体内容",//图文消息的具体内容
	// "content_source_url" => "http://www.jnexpert.com",//图文消息的原文地址
	// "need_open_comment" => 0,//是否打开评论 0(不打开) 1(打开)
	// "only_fans_can_comment" => 0,//是否粉丝才可评论 0(所有人可评论) 1(粉丝才可评论)
// );
// if( ($result = $this->wechatapiexample->putMaterialNews($access_token, $mediaId, $index, $articles)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 删除 永久素材 **/
// $mediaId = "";//素材id
// if( ($result = $this->wechatapiexample->deleteMaterial($access_token, $mediaId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 永久素材 **/
// $mediaId = "jza0Mvdllrfw4PKYkgO0gg95jAsfWRMdRwF-lTGrN7I";//素材id
// if( ($result = $this->wechatapiexample->getMaterialInfo($access_token, $mediaId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 添加 永久图文素材 **/
// $articles = array(
	// array(
		// "title" => "测试图文素材",//标题
		// "thumb_media_id" => "jza0Mvdllrfw4PKYkgO0gnlgYrDuv2qi5R1Xhk0LoxY",//图文消息的封面图片素材id(必须是永久mediaID)
		// "author" => "寻芝彬",//作者
		// "digest" => "图文消息的摘要",//图文消息的摘要
		// "show_cover_pic" => 0,//是否显示封面 0(不显示) 1(显示)
		// "content" => "图文消息的具体内容",//图文消息的具体内容
		// "content_source_url" => "http://www.jnexpert.com",//图文消息的原文地址
		// "need_open_comment" => 0,//是否打开评论 0(不打开) 1(打开)
		// "only_fans_can_comment" => 0,//是否粉丝才可评论 0(所有人可评论) 1(粉丝才可评论)
	// ),
	// array(
		// "title" => "测试图文素材",//标题
		// "thumb_media_id" => "jza0Mvdllrfw4PKYkgO0gnlgYrDuv2qi5R1Xhk0LoxY",//图文消息的封面图片素材id(必须是永久mediaID)
		// "author" => "寻芝彬",//作者
		// "digest" => "图文消息的摘要",//图文消息的摘要
		// "show_cover_pic" => 1,//是否显示封面 0(不显示) 1(显示)
		// "content" => "图文消息的具体内容",//图文消息的具体内容
		// "content_source_url" => "http://www.jnexpert.com",//图文消息的原文地址
		// "need_open_comment" => 0,//是否打开评论 0(不打开) 1(打开)
		// "only_fans_can_comment" => 0,//是否粉丝才可评论 0(所有人可评论) 1(粉丝才可评论)
	// ),
// );
// if( ($result = $this->wechatapiexample->postNewsMaterial($access_token, $articles)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 上传 永久图文消息后的图片 **/
// $filename = 'test.jpg';
// 兼容5.0-5.6版本的curl
// $media = class_exists('\CURLFile') ? new \CURLFile(realpath($filename)) : "@".$filename;
// if( ($result = $this->wechatapiexample->uploadImgNewsMaterial($access_token, $media)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 添加 其他类型永久素材 **/
//图片
// $type = "image";//媒体文件类型 图片(image) 语音(voice) 视频(video) 缩略图(thumb)
// $filename = 'test.jpg';
// 兼容5.0-5.6版本的curl
// $media = class_exists('\CURLFile') ? new \CURLFile(realpath($filename)) : "@".$filename;//form-data中媒体文件标识
// $description = NULL;//视频素材描述信息
//视频
// $type = "voice";//媒体文件类型 图片(image) 语音(voice) 视频(video) 缩略图(thumb)
// $filename = 'test.mp4';
// 兼容5.0-5.6版本的curl
// $media = class_exists('\CURLFile') ? new \CURLFile(realpath($filename)) : "@".$filename;//form-data中媒体文件标识
// $description = array(
	// "title" => "视频标题",//视频素材的标题
	// "introduction" => "视频素材描述"//视频素材的描述
// );
// if( ($result = $this->wechatapiexample->addMaterial($access_token, $type, $media, $description)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 临时素材 **/
//图片
// $type = "video";//媒体文件类型 图片(image) 语音(voice) 视频(video) 缩略图(thumb)
// $filename = 'test.mp4';
// 兼容5.0-5.6版本的curl
// $media = class_exists('\CURLFile') ? new \CURLFile(realpath($filename)) : "@".$filename;//form-data中媒体文件标识
// if( ($result = $this->wechatapiexample->uploadTempMedia($access_token, $type, $media)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 临时素材 **/
// $mediaId = "GfkMT1VWgA1yrhivJH0wF5Qt7dBBmTYzAHMoNy_x2i54mknz8axECG9INr-LmPzV";
// $type = "video";
// if( ($result = $this->wechatapiexample->getTempMedia($access_token, $mediaId, $type)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }
// echo "<img src='" .$result. "'/>";//图片
// echo $result["video_url"];//图片


/** 打开 已群发文章评论 **/
// $msgDataId = "";
// $index = 0;
// if( ($result = $this->wechatapiexample->openComment($access_token, $msgDataId, $index)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 打开 已群发文章评论 **/
// $msgDataId = "";
// $index = 0;
// if( ($result = $this->wechatapiexample->closeComment($access_token, $msgDataId, $index)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 指定文章评论列表 **/
// $msgDataId = "";
// $index = 0;
// $begin = 0;
// $count = 20;
// $type = 0;
// if( ($result = $this->wechatapiexample->getCommentList($access_token, $msgDataId, $index, $begin, $count, $type)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 将评论标记精选 **/
// $msgDataId = "";
// $index = 0;
// $userCommentId = 0;
// if( ($result = $this->wechatapiexample->markelectComment($access_token, $msgDataId, $index, $userCommentId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 将评论取消精选 **/
// $msgDataId = "";
// $index = 0;
// $userCommentId = 0;
// if( ($result = $this->wechatapiexample->unmarkelectComment($access_token, $msgDataId, $index, $userCommentId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 删除 评论 **/
// $msgDataId = "";
// $index = 0;
// $userCommentId = 0;
// if( ($result = $this->wechatapiexample->deleteComment($access_token, $msgDataId, $index, $userCommentId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 回复 评论 **/
// $msgDataId = "";
// $index = 0;
// $userCommentId = 0;
// $content = "测试回复";
// if( ($result = $this->wechatapiexample->replyComment($access_token, $msgDataId, $index, $userCommentId, $content)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 回复 评论 **/
// $msgDataId = "";
// $index = 0;
// $userCommentId = 0;
// if( ($result = $this->wechatapiexample->deleteReplyToComment($access_token, $msgDataId, $index, $userCommentId)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 获取 公众号的黑名单列表 **/
// $beginOpenid = '';
// if( ($result = $this->wechatapiexample->getBlacklist($access_token, $beginOpenid)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 批量 拉黑用户 **/
// $openidList = array(
	// "oLcvtjrKX5V6oZxSlcGCn1JOJXyE",
	// "oLcvtjn3N2v2YlJm-sWE2ABCO7xg",
// );
// if( ($result = $this->wechatapiexample->batchPullBlacklist($access_token, $openidList)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


/** 批量 取消拉黑用户 **/
// $openidList = array(
	// "oLcvtjrKX5V6oZxSlcGCn1JOJXyE",
	// "oLcvtjn3N2v2YlJm-sWE2ABCO7xg",
// );
// if( ($result = $this->wechatapiexample->batchClearBlacklist($access_token, $openidList)) === FALSE)
// {
	// echo $this->wechatapiexample->getErrorMsg();exit;
// }


var_dump($result);