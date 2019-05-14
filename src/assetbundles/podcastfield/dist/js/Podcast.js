/**
 * Podcast Embedder plugin for Craft CMS
 *
 * Podcast Field JS
 *
 * @author    Kurious Agency
 * @copyright Copyright (c) 2019 Kurious Agency
 * @link      https://kurious.agency
 * @package   PodcastEmbedder
 * @since     0.0.1PodcastEmbedderPodcast
 */

(function($, window, document, undefined) {
	var pluginName = 'PodcastEmbedder',
		defaults = {};

	// Plugin constructor
	function Plugin(element, options) {
		this.element = element;
		this.$element = $(element);

		this.options = $.extend({}, defaults, options);

		this._defaults = defaults;
		this._name = pluginName;

		this.init();
	}

	Plugin.prototype = {
		init: function(id) {
			var _this = this;

			this.id = id;
			this.$url = this.$element.find('.podcast-embedder-url');
			this.$preview = this.$element.find('.podcast-embedder-previewContainer');
			this.$url.on('change', $.proxy(this.fetchPreview, this));
			this.$url.on('keydown', $.proxy(this.handleKeydown, this));
			this.$spinner = $('<div class="spinner hidden"/>').insertAfter(this.$url.parent());

			$(function() {
				/* -- _this.options gives us access to the $jsonVars that our FieldType passed down to us */
			});
		},

		fetchPreview: function(event) {
			var self = this;
			var jxhr;

			event.preventDefault();

			this.$preview.addClass('is-loading');
			//this.$embedDataInput.val(null);
			this.$spinner.removeClass('hidden');

			jxhr = $.get(this.options.endpointUrl, {
				url: this.$url.val(),
				name: this.options.name
			});

			jxhr.done(function(data, textStatus, jqXHR) {
				//console.log(data);
				self.$preview.html(data);
			});

			jxhr.fail(function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			});

			jxhr.always(function() {
				Craft.initUiElements(self.$preview);
				self.$preview.removeClass('is-loading');
				self.$spinner.addClass('hidden');
			});
		},

		handleKeydown: function(event) {
			if (event.keyCode === 13) {
				event.preventDefault();
				this.fetchPreview(event);
			}
		}
	};

	// A really lightweight plugin wrapper around the constructor,
	// preventing against multiple instantiations
	$.fn[pluginName] = function(options) {
		return this.each(function() {
			if (!$.data(this, 'plugin_' + pluginName)) {
				$.data(this, 'plugin_' + pluginName, new Plugin(this, options));
			}
		});
	};
})(jQuery, window, document);
