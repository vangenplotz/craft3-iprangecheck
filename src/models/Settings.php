<?php

namespace vangenplotz\iprangecheck\models;

use vangenplotz\iprangecheck\IpRangeCheck;

use Craft;
use craft\base\Model;


class Settings extends Model
{
    /**
     * Should we enable ip check
     *
     * @var bool
     */
    
    public $enableCheck = true;   

    /**
    * List of IPs in range
    * @var array
    */
    public $ipRange = [];
    /**
     * Message if user is out of ip range 
     * @var string
     */
    public $message = "No access";

   
    /**
     * 
     */
    public function rules ()
    {
        return [
            [ 'enableCheck', 'boolean' ],
            
            [ 'enableCheck', 'default', 'value' => false ],
            [ 'ipRange', 'default', 'value' => [] ],
            [ 'message', 'default', 'value' => 'No access' ],
        ];
    }
}
