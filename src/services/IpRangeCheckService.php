<?php
/**
 * Ip Range Check plugin for Craft CMS 3.x
 *
 * -
 *
 * @link      https://www.vangenplotz.no
 * @copyright Copyright (c) 2018 Vangenplotz
 */

namespace vangenplotz\iprangecheck\services;

use vangenplotz\iprangecheck\models\Settings;
use vangenplotz\iprangecheck\IpRangeCheck;


use Craft;
use craft\base\Component;


/**
 * IpRangeCheckService Service
 * 
 * @author    Vangenplotz
 * @package   IpRangeCheck
 * @since     1.0.0
 */
class IpRangeCheckService extends Component
{
    /**
     * 
     * Check if users ip is in valid range
     *
     * @return array
     */
    public function checkIpRange()
    {
        // has access defaults to false
        $arrReturn['access'] = false;
       
        $settings = IpRangeCheck::$plugin->getSettings();

        // is the check enabled
        if ( $settings->enableCheck ) {
            $arrReturn['message']= $settings->errorMessage;
            $ip  = Craft::$app->request->getUserIP();
            // parse an address in any format (IPv4 or IPv6):
            $address = \IPLib\Factory::addressFromString($ip);
           
            if(is_array($settings->ipRange)){
                 
                foreach( $settings->ipRange as $ipAddress ) {
                    // parse  a range in any format
                    $range = \IPLib\Factory::rangeFromString($ipAddress);
                    // check for match
                    if($range->contains($address)){
                        $arrReturn['access'] = true;
                    }
                }
            }
        }
        // check not enabled view page.
        return $arrReturn;
    }
}
