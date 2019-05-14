<?php
/**
 * Podcast Embedder plugin for Craft CMS 3.x
 *
 * Podcast fieldtype
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\podcastembedder\fields;

use kuriousagency\podcastembedder\PodcastEmbedder;
use kuriousagency\podcastembedder\assetbundles\podcastfield\PodcastFieldAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;
use craft\base\PreviewableFieldInterface;
use craft\helpers\UrlHelper;

/**
 * @author    Kurious Agency
 * @package   PodcastEmbedder
 * @since     0.0.1
 */
class Podcast extends Field implements PreviewableFieldInterface
{
    // Public Properties
    // =========================================================================

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('podcast-embedder', 'Podcast');
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules = array_merge($rules, []);
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getContentColumnType(): string
    {
        return Schema::TYPE_TEXT;
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function serializeValue($value, ElementInterface $element = null)
    {
        return parent::serializeValue($value, $element);
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        // Render the settings template
        return Craft::$app->getView()->renderTemplate(
            'podcast-embedder/_components/fields/settings',
            [
                'field' => $this,
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        // Register our asset bundle
        Craft::$app->getView()->registerAssetBundle(PodcastFieldAsset::class);

        // Get our id and namespace
        $id = Craft::$app->getView()->formatInputId($this->handle);
		$namespacedId = Craft::$app->getView()->namespaceInputId($id);
		
		$pluginSettings = PodcastEmbedder::getInstance()->getSettings();
        $fieldSettings = $this->getSettings();

        // Variables to pass down to our field JavaScript to let it namespace properly
        $jsonVars = [
            'id' => $id,
            'name' => $this->handle,
            'namespace' => $namespacedId,
			'prefix' => Craft::$app->getView()->namespaceInputId(''),
			'fieldSettings' => $fieldSettings,
            'pluginSettings' => $pluginSettings,
            'endpointUrl' => UrlHelper::actionUrl('podcast-embedder/podcast/parse'),
            ];
        $jsonVars = Json::encode($jsonVars);
        Craft::$app->getView()->registerJs("$('#{$namespacedId}-field').PodcastEmbedder(" . $jsonVars . ");");

        // Render the input template
        return Craft::$app->getView()->renderTemplate(
            'podcast-embedder/_components/fields/input',
            [
                'name' => $this->handle,
                'value' => $value,
                'field' => $this,
                'id' => $id,
				'namespacedId' => $namespacedId,
				'fieldSettings' => $fieldSettings,
                'pluginSettings' => $pluginSettings,
            ]
        );
    }
}
