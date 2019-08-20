# Podcast Embedder plugin for Craft CMS 3.x

Creates a podcast fieldtype for the embed of Podbean or Libsyn podcast media players. A podcast can be embeded using a podcast's share url.
![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require kuriousagency/podcast-embedder

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Podcast Embedder.

## Podcast Embedder Overview

Podcasts hosted on either the podbean or libsyn services can be embedded in templates using the podcast embedder fieldtype.

## Configuring Podcast Embedder

Create a new field in Settings → Fields → New Field and select Podcast from the fieldtype dropdown.

## Using Podcast Embedder

To add a podcast to templates add the following twig code:

```
{{ craft.podcastEmbedder.embed(podcast) }}
```

### Available Twig Functions ###

+ craft.podcastEmbedder.embed()

+ craft.podcastEmbedder.getEmbedUrl()

+ craft.podcastEmbedder.getThumbnail()

+ craft.podcastEmbedder.getTitle()

+ craft.podcastEmbedder.getDescription()

+ craft.podcastEmbedder.getType()

+ craft.podcastEmbedder.getPodcastId()

## Podcast Embedder Roadmap

* Add more providers

Brought to you by [Kurious Agency](https://kurious.agency)
