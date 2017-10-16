<?php
/***********************************************
#
#      Filename: BaseRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-09-27 13:07:54
# Last Modified: 2017-10-10 10:26:27
***********************************************/

namespace Oauth\Request\V20170926;

class BaseRequest extends SnsRequest
{
    public function __construct()
    {
		parent::__construct("snsapi_base");
    }

}
