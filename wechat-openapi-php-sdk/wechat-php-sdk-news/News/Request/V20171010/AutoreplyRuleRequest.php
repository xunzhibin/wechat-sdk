<?php
/***********************************************
#
#      Filename: AutoreplyRuleRequest.php
#
#        Author: Alex Xun - xunzhibin@hotmail.com
#   Description: ---
#        Create: 2017-10-10 12:44:35
# Last Modified: 2017-10-10 13:03:23
***********************************************/

namespace News\Request\V20171010;

class AutoreplyRuleRequest extends \DefaultRequest
{
    public function __construct($token)
    {
		parent::requestResponseInit("GET", "JSON", "News", "autoreply_rule");

		parent::setAccessToken($token);
    }
}
