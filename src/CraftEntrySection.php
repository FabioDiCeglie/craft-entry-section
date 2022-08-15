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


use craft\base\Plugin;
use craft\events\DefineGqlTypeFieldsEvent;
use craft\gql\TypeManager;
use GraphQL\Type\Definition\Type;
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
            TypeManager::class,
            TypeManager::EVENT_DEFINE_GQL_TYPE_FIELDS,
            static function(DefineGqlTypeFieldsEvent $event) {
                if ($event->typeName == 'EntryInterface') {
                    $event->fields['sectionName'] = [
                        'name' => 'sectionName',
                        'type' => Type::string(),
                        'resolve' => function($source, $arguments, $context, $resolveInfo) {
                            return $source->sectionHandle;
                        }
                    ];
                }
            }
        );
    }
}
