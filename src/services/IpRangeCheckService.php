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
        
        $settings = IpRangeCheck::$plugin->getSettings();

        if(is_object($settings)){
            // is the check enabled
            if ( property_exists($settings, 'enableCheck') and  $settings->enableCheck ) {
               
                $ip  = Craft::$app->request->getUserIP();
                // parse an address in any format (IPv4 or IPv6):
                $address = \IPLib\Factory::addressFromString($ip);
               
                if(property_exists($settings,'ipRange') and is_array($settings->ipRange)){
                     
                    foreach( $settings->ipRange as $ipAddress ) {
                        // parse  a range in any format
                        $range = \IPLib\Factory::rangeFromString($ipAddress);
                        // check for match
                        if($range->contains($address)){
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }


    /**
     * 
     *  Return message set in settings if no access to page
     */ 
    public function getNoAccessMessage() {
        $settings = IpRangeCheck::$plugin->getSettings();
        if(is_object($settings) and property_exists($settings, 'message')){
            return $settings->message;
        }
        return null;
    }
}
