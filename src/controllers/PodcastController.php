<?php
/**
 * Podcast Embedder plugin for Craft CMS 3.x
 *
 * Podcast fieldtype
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\podcastembedder\controllers;

use kuriousagency\podcastembedder\PodcastEmbedder;

use Craft;
use craft\web\Controller;

/**
 * @author    Kurious Agency
 * @package   PodcastEmbedder
 * @since     0.0.1
 */
class PodcastController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = [];

    // Public Methods
    // =========================================================================

    public function actionParse(): string
    {
        $url = Craft::$app->request->get('url');

        return Craft::$app->getView()->renderTemplate(
            'podcast-embedder/_components/fields/inputEmbed.twig',
            [
                'name' => Craft::$app->request->get('name'),
                'value' => $url,
            ]
        );
    }
}
