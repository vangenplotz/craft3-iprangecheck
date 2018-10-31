<?php
/**
 * Ip Range Check plugin for Craft CMS 3.x
 *
 * -
 *
 * @link      https://www.vangenplotz.no
 * @copyright Copyright (c) 2018 Vangenplotz
 */

namespace vangenplotz\iprangecheck\variables;

use vangenplotz\iprangecheck\IpRangeCheck;


use Craft;

/**
 * @author    Vangenplotz
 * @package   IpRangeCheck
 * @since     1.0.0
 */
class IpRangeCheckVariable
{

    /**
     * 
    */ 
    public function checkValidIp(){
        return IpRangeCheck::$plugin->ipRangeCheckService->checkIpRange();
    }

    public function getNoAccessMessage(){
        return IpRangeCheck::$plugin->ipRangeCheckService->getNoAccessMessage();
    }
    
}
