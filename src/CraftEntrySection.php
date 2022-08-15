<?php
/**
 * Craft Entry Section plugin for Craft CMS 3.x
 *
 * Include the name of the section an entry belongs to
 *
 * @link      https://perfectwebteam.nl/
 * @copyright Copyright (c) 2022 Perfectwebteam
 */

namespace perfectwebteam\craftentrysection;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class CraftEntrySection
 *
 * @author    Perfectwebteam
 * @package   CraftEntrySection
 * @since     0.0.1
 *
 */
class CraftEntrySection extends Plugin
{
    /**
     * @var CraftEntrySection
     */
    public static $plugin;

    /**
     * @var string
     */
    public $schemaVersion = '0.0.1';

    /**
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * @var bool
     */
    public $hasCpSection = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'craft-entry-section',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
