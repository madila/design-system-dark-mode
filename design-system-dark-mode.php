<?php
/**
 * Plugin Name:       Design System - Dark Mode
 * Description:       An interactive block to allow for custom theme dark mode using the Interactivity API
 * Version:           200.1.3
 * Requires at least: 6.5
 * Requires PHP:      7.0
 * Author:            Ruben Madila
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Github Plugin URI:  madila/design-system-dark-mode
 * Primary Branch:    main
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
