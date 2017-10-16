<?php
/***********************************************
#
#      Filename: EndpointConfig.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-27 13:09:27
# Last Modified: 2017-09-27 13:10:12
***********************************************/

$endpoint_filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . "endpoints.xml";

$xml = simplexml_load_string(file_get_contents($endpoint_filename));

$json = json_encode($xml);

$json_array = json_decode($json, true);

$endpoints = $json_array['Endpoint'];

EndpointProvider::setEndpoints($endpoints);