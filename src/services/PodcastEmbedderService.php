<?php
/**
 * Podcast Embedder plugin for Craft CMS 3.x
 *
 * Podcast fieldtype
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\podcastembedder\services;

use kuriousagency\podcastembedder\PodcastEmbedder;

use Craft;
use craft\base\Component;

use DOMDocument;
use Embed\Embed;

/**
 * @author    Kurious Agency
 * @package   PodcastEmbedder
 * @since     0.0.1
 */
class PodcastEmbedderService extends Component
{
    // Public Methods
    // =========================================================================

    public function getInfo($url, $params=[])
    {
        $info = Embed::create($url, [
            'choose_bigger_image' => true,
            'parameters' => [],
		]);

		$this->{$info->providerName.'Format'}($info, $params);
		
		return $info;
	}

	public function podbeanFormat(&$info, $params=[])
	{
		$url = $info->url;
		preg_match('%(?:podbean.com\/media\/share\/pb-)(.+)%i', $url, $match);
		$info->id = $match[1];

		$url = "https://www.podbean.com/media/player/$info->id-pb";
		
		$query = [
			'skin' => 1
		];
		if (isset($params['query']) && is_array($params['query'])) {
			$query = array_merge($query, $params['query']);
		}
		$url .= '?'.http_build_query($query);
		unset($params['query']);

		$params = array_merge([
			'frameborder' => 0,
			'allowTransparency' => 1,
			'width' => '100%',
		], $params);
		$paramString = '';
		foreach ($params as $key => $param)
		{
			$paramString .= $key."='$param' ";
		}
		$iframe = "<iframe src='$url' $paramString></iframe>";

		$info->embedUrl = $url;
		$info->code = $iframe;
	}

	

	public function embed($url, $params=[]) : string
	{
		$info = $this->getInfo($url);
		return $info->code;
	}

	public function getEmbedUrl($url, $params=[])
	{
		$info = $this->getInfo($url);
		return $info->embedUrl;
	}

	public function getPodcastId($url)
	{
		$info = $this->getInfo($url);
		return $info->id;
	}

	public function getThumbnail($url)
	{
		$info = $this->getInfo($url);
		return $info->image;
	}

}
