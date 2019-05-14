<?php
/**
 * Podcast Embedder plugin for Craft CMS 3.x
 *
 * Podcast fieldtype
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\podcastembedder\variables;

use kuriousagency\podcastembedder\PodcastEmbedder;

use Craft;
use craft\helpers\Template;

/**
 * @author    Kurious Agency
 * @package   PodcastEmbedder
 * @since     0.0.1
 */
class PodcastEmbedderVariable
{
    // Public Methods
    // =========================================================================

    public function embed($url, $params = [])
    {
		return Template::raw(PodcastEmbedder::$plugin->service->embed($url, $params));
	}
	
	public function getEmbedUrl($url, $params = [])
    {
        return Template::raw(PodcastEmbedder::$plugin->service->getEmbedUrl($url, $params));
	}
	
	public function getThumbnail($url) {
        return Template::raw(PodcastEmbedder::$plugin->service->getThumbnail($url));
	}
	
	public function getTitle($url) {
        return Template::raw(PodcastEmbedder::$plugin->service->getInfo($url)->title);
	}
	
	public function getDescription($url) {
        return Template::raw(PodcastEmbedder::$plugin->service->getInfo($url)->description);
	}
	
	public function getType($url) {
        return Template::raw(PodcastEmbedder::$plugin->service->getInfo($url)->type);
	}
	
	public function getAspectRatio($url) {
        return Template::raw(PodcastEmbedder::$plugin->service->getInfo($url)->aspectRatio);
	}
	
	public function getProviderName($url) {
        return Template::raw(PodcastEmbedder::$plugin->service->getInfo($url)->providerName);
	}
	
	public function getPodcastId($url) {
        return Template::raw(PodcastEmbedder::$plugin->service->getPodcastId($url));
    }
}
