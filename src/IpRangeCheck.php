<?php
/**
 * Ip Range Check plugin for Craft CMS 3.x
 *
 * -
 *
 * @link      https://www.vangenplotz.no
 * @copyright Copyright (c) 2018 Vangenplotz
 */

namespace vangenplotz\iprangecheck;

use vangenplotz\iprangecheck\services\IpRangeCheckService as IpRangeCheckServiceService;
use vangenplotz\iprangecheck\variables\IpRangeCheckVariable;
use vangenplotz\iprangecheck\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * 
 * Class IpRangeCheck
 *
 * @author    Vangenplotz
 * @package   IpRangeCheck
 * @since     1.0.0
 *
 * @property IpRangeCheckServiceService $ipRangeCheckService
 * @property Settings               $settings
 * @method   Settings getSettings()
 */
class IpRangeCheck extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var IpRangeCheck
    */
    public static $plugin;

    /**
     * @inheritdoc
    */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

      
        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('ipRangeCheck', IpRangeCheckVariable::class);
                
                
            }
        );

        Craft::info(
            Craft::t(
                'ip-range-check',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

     /**
     * @inheritdoc
     */
    protected function createSettingsModel ()
    {
        return new Settings();
    }

    /**
     * 
     */ 
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'ip-range-check/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
