<?php

final class Presscore_Mod_Archives_Templates {

	private static $instance;

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function setup() {
		add_action( 'presscore_config_base_init', array( $this, 'filter_config_for_archives' ) );
		add_filter( 'presscore_options_list', array( $this, 'add_theme_options' ) );
	}

	public function filter_config_for_archives() {
		if ( ! ( is_archive() || is_search() ) ) {
			return;
		}

		$config = presscore_get_config();

		$config->set( 'show_titles', true );
		$config->set( 'show_excerpts', true );

		$config->set( 'show_links', true );
		$config->set( 'show_details', true );
		$config->set( 'show_zoom', true );

		$config->set( 'post.meta.fields.date', true );
		$config->set( 'post.meta.fields.categories', true );
		$config->set( 'post.meta.fields.comments', true );
		$config->set( 'post.meta.fields.author', true );
		$config->set( 'post.meta.fields.media_number', true );

		$config->set( 'post.preview.width.min', 320 );
		$config->set( 'post.preview.mini_images.enabled', true );
		$config->set( 'post.preview.load.effect', 'fade_in' );
		$config->set( 'post.preview.background.enabled', true );
		$config->set( 'post.preview.background.style', 'fullwidth' );
		$config->set( 'post.preview.description.alignment', 'left' );
		$config->set( 'post.preview.description.style', 'under_image' );

		$config->set( 'post.preview.hover.animation', 'fade' );
		$config->set( 'post.preview.hover.color', 'accent' );
		$config->set( 'post.preview.hover.content.visibility', 'on_hoover' );

		$config->set( 'post.fancy_date.enabled', false );

		$config->set( 'template.columns.number', 3 );
		$config->set( 'load_style', 'default' );
		$config->set( 'image_layout', 'original' );
		$config->set( 'all_the_same_width', true );
		$config->set( 'item_padding', 10 );

		$config->set( 'layout', 'masonry' );
		$config->set( 'template.layout.type', 'masonry' );
	}

	public function add_theme_options( $theme_options_files ) {
		$theme_options_files['utility_pages'] = 'inc/mods/mod-archives-templates/options/options-archives-templates.php';
		return $theme_options_files;
	}

	private function __construct() {}

	private function __clone() {}
}
