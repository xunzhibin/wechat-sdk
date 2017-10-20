<?php
/***********************************************
#
#      Filename: EndpointProvider.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-27 13:09:27
# Last Modified: 2017-10-10 11:59:43
***********************************************/

class EndpointProvider
{
	/**
     *  微信 服务产品 对应api集合
     **/
    private static $endpoints;

	/**
     *  设置 服务产品api集合
     **/
    public static function setEndpoints($endpoints)
    {
        self::$endpoints = $endpoints;
    }

	/**
     *  获取 服务产品api集合
     **/
	public static function getEndpoints()
    {
        return self::$endpoints;
    }

	/**
     *  查找 服务产品api
     **/
    public static function findProductDomain($serviceId, $product)
    {
        if(null == $serviceId || null == $product || null == self::$endpoints)
		{
            return null;
        }

        foreach(self::$endpoints as $key => $endpoint)
		{
            if($endpoint["ServiceId"] == $serviceId)
			{
				return self::findProductDomainByProduct($endpoint["Products"], $product);
            }
        }

        return null;
    }

    private static function findProductDomainByProduct($products, $productName)
    {
        if(null == $products)
		{
            return null;
        }

		$domain = isset($products["DomainName"]) ? $products["DomainName"] : "";

        foreach($products["Product"] as $key => $product)
		{
			if($product['ProductName'] == $productName)
			{
				$domain = isset($product["DomainName"]) ? $product["DomainName"] : $domain;

				isset($product["UriString"]) && $domain .= "/" . $product["UriString"];

				$domain = str_replace(" ", "&", $domain);

				return $domain;
			}
        }

        return null;
    }
}
