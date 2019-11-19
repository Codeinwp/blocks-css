<?php
/**
 * Plugin Name:       Blocks CSS: CSS Editor for Gutenberg Blocks
 * Plugin URI:        https://github.com/Codeinwp/blocks-css
 * Description:       Create beautiful and attracting posts, pages, and landing pages with Gutenberg Blocks and Template Library by Otter. Otter comes with dozens of Gutenberg blocks that are all you need to build beautiful pages.
 * Version:           1.0.2
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
		// call this only if Gutenberg is active
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

/**
 * Adds the `hasCustomCSS` and `customCSS` attributes to all blocks.
 *
 * @hooked wp_loaded,100    This might not be late enough for all blocks, I don't know when blocks are supposed to be registered.
 */
add_action( 'wp_loaded', function() {

	$registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

	foreach( $registered_blocks as $name => $block ) {

		$block->attributes['hasCustomCSS'] = array(
			'type'    => 'boolean',
			'default' => false,
		);
		$block->attributes['customCSS']    = array(
			'type'    => 'string',
			'default' => '',
		);
	}

}, 100);
