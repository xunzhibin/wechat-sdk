<?php
/***********************************************
#
#      Filename: config.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-26 13:55:12
# Last Modified: 2017-10-10 17:48:46
***********************************************/

//包含 自动加载文件
include_once "Autoloader/Autoloader.php";
//包含 断点配置文件
include_once 'Regions/EndpointConfig.php';


//添加 自动加载路径
Autoloader::add_autoload_path("wechat-php-sdk-Oauth");//网页授权
Autoloader::add_autoload_path("wechat-php-sdk-token");//access_token
Autoloader::add_autoload_path("wechat-php-sdk-news");//消息
Autoloader::add_autoload_path("wechat-php-sdk-jsapi");//微信客户端 js
Autoloader::add_autoload_path("wechat-php-sdk-user");//微信用户
Autoloader::add_autoload_path("wechat-php-sdk-account");//账号管理
Autoloader::add_autoload_path("wechat-php-sdk-menu");//自定义菜单
Autoloader::add_autoload_path("wechat-php-sdk-customservice");//客服
Autoloader::add_autoload_path("wechat-php-sdk-material");//素材
Autoloader::add_autoload_path("wechat-php-sdk-comment");//评论

/**
 *  常量 start
 **/
//公众号唯一标识(应用ID)
if ( ! defined('APPID')) define("APPID", "wx8b50519bdc847806");

//公众号secret;
if ( ! defined('APPSECRET')) define("APPSECRET", "271502f771908c2522feaad433c82ea1");

//微信网页授权,获取code时,回调地址
if ( ! defined('CODEREDIRECTURI')) define("CODEREDIRECTURI", 'http://www.jnexpert.com' . $_SERVER['REQUEST_URI']);

//错误显示权限 TRUE:直接显示错误信息到页面 FALSE:不显示错误信息
if ( ! defined('ERRORTHRESHOLD')) define("ERRORTHRESHOLD", TRUE);
//if ( ! defined('ERRORTHRESHOLD')) define("ERRORTHRESHOLD", FALSE);

//配置 代理
define("ENABLE_HTTP_PROXY", FALSE);
define("HTTP_PROXY_IP", "127.0.0.1");
define("HTTP_PROXY_PORT", "8888");
/**
 *  常量 end
 **/
