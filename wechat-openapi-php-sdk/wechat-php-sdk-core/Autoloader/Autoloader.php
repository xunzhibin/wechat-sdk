<?php
/***********************************************
#
#      Filename: Autoloader.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-26 13:07:57
# Last Modified: 2017-09-26 13:58:01
***********************************************/

spl_autoload_register("Autoloader::autoload");
class Autoloader
{
    /**
     *  自动加载 文件路径
     **/
    private static $autoload_path_array = array(
        "wechat-php-sdk-core",//核心
        "wechat-php-sdk-core/Http",//http 请求、响应
        "wechat-php-sdk-core/Regions",//请求网址
        "wechat-php-sdk-core/Exception",//异常
    );

    public static function autoload($class_name)
    {
        foreach(self::$autoload_path_array as $path)
        {
            $file = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $class_name . ".php";
            $file = str_replace("\\", DIRECTORY_SEPARATOR, $file);

            if(is_file($file))
            {
                include_once $file;

                break;
            }
        }
    }

    /**
     *  添加 自动加载路径
     **/
    public static function add_autoload_path($path)
    {
        array_push(self::$autoload_path_array, $path);
    }
}
