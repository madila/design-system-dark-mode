<?php
/**
 * Plugin Name:       Design System - Dark Mode
 * Description:       An interactive block to allow for custom theme dark mode using the Interactivity API
 * Version:           200.1.0
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Author:            Ruben Madila
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       design-system-dark-mode
 *
 * @package           design-system
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function dark_mode_block_init() {
	register_block_type_from_metadata( __DIR__ . '/build' );
}
add_action( 'init', 'dark_mode_block_init' );


function __generate_dark_mode_styles($output = false, $update = false, $merge = ''): void {
	$dark_mode_css = get_transient( '_dark-mode-css-output' );
	if( false === $dark_mode_css || $update ) {
		$theme_palette = wp_get_global_settings(array( 'custom', 'dark-mode'));
		$css = '';
		if(!empty($theme_palette)) {
			foreach ( $theme_palette as $slug => $color ) {
				$css .= sprintf("--wp--preset--color--%s : %s;",$slug,$color);
			}
		}

		if(!empty($merge)) {
			$css .= $merge;
		}

		$dark_mode_css = sprintf('<style id="dark-mode-css"> html[data-scheme=dark] body { %s }</style>', $css);
		set_transient( '_dark-mode-css-output', $dark_mode_css, 2 * WEEK_IN_SECONDS );
	}
	if($output) echo $dark_mode_css;
}

function dark_mode_force_update_palette_styles(): void {
	delete_transient( '_dark-mode-css-output' );
}

function dark_mode_add_palette_styles(): void {
	__generate_dark_mode_styles(true);
}

function save_dark_mode_palette_styles($post_id, $post): void {
	// bail out if this is an autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// bail out if this is not an event item
	if ( 'wp_global_styles' !== $post->post_type ) {
		return;
	}

	$json_update = json_decode($post->post_content, true);
	//var_dump($json_update['settings']['color']['palette']['custom']); die();
	//file_put_contents(plugin_dir_path( __FILE__ ).'/colors.json', isset($json_update['settings']['color']['palette']['custom']));

	if(isset($json_update['settings']['color']['palette']['custom'])) {

		$custom_palette = $json_update['settings']['color']['palette']['custom'];

		if(count($custom_palette) > 0) {
			$css = '';
			foreach ( $custom_palette as $index => $color_data ) {
				if(!str_contains( $color_data['slug'], '-dark-mode')) return;

				$trimmed_slug = str_replace('custom-', '', $color_data['slug']);
				$slug = str_replace('-dark-mode', '', $trimmed_slug);
				$color = $color_data['color'];
				$css .= sprintf("--wp--preset--color--%s : %s;",$slug,$color);

			}
		}

		if(!empty($css)) {
			__generate_dark_mode_styles(false, true, $css );
		}

	}

}


add_action( 'save_post', 'save_dark_mode_palette_styles',20, 2 );

add_action('wp_head', 'dark_mode_add_palette_styles');
