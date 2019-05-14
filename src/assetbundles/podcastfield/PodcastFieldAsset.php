<?php
/**
 * Podcast Embedder plugin for Craft CMS 3.x
 *
 * Podcast fieldtype
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\podcastembedder\assetbundles\podcastfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Kurious Agency
 * @package   PodcastEmbedder
 * @since     0.0.1
 */
class PodcastFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@kuriousagency/podcastembedder/assetbundles/podcastfield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/Podcast.js',
        ];

        $this->css = [
            'css/Podcast.css',
        ];

        parent::init();
    }
}
