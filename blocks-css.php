<?php
/**
 * Loader for the ThemeIsle\GutenbergCSS
 *
 * @package     ThemeIsle\GutenbergCSS
 * @copyright   Copyright (c) 2019, Hardeep Asrani
 * @license     http://opensource.org/licenses/gpl-3.0.php GNU Public License
 * @since       1.0.0
 *
 * Plugin Name:       Blocks CSS: CSS Editor for Gutenberg Blocks
 * Plugin URI:        https://github.com/Codeinwp/blocks-css
 * Description:       Blocks CSS allows you add custom CSS to your Blocks straight from the Block Editor (Gutenberg).
 * Version:           1.0.4
 * Author:            ThemeIsle
 * Author URI:        https://themeisle.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       blocks-css
 * Domain Path:       /languages
 * WordPress Available:  yes
 * Requires License:    no
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'BLOCKS_CSS_URL', plugins_url( '/', __FILE__ ) );
define( 'BLOCKS_CSS_PATH', dirname( __FILE__ ) );

$vendor_file = BLOCKS_CSS_PATH . '/vendor/autoload.php';

if ( is_readable( $vendor_file ) ) {
	require_once $vendor_file;
}

add_action(
	'plugins_loaded',
	function () {
		// call this only if Gutenberg is active.
		if ( function_exists( 'register_block_type' ) ) {
			if ( class_exists( '\ThemeIsle\GutenbergCSS' ) ) {
				\ThemeIsle\GutenbergCSS::instance();
			}
		}
	}
);

add_filter(
	'themeisle_sdk_products',
	function ( $products ) {
		$products[] = __FILE__;

		return $products;
	}
);
