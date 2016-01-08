<?php

/**
 * Child Theme Functions
 *
 * Functions or examples that may be used in a child them. Don't for get to edit them, to get them working.
 *
 * @link https://make.wordpress.org/core/handbook/inline-documentation-standards/php-documentation-standards/#6-file-headers
 * @since 20160104.1
 *
 * @category            WordPress_Theme
 * @package             Twenty_Twelve_All
 * @subpackage          theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ROTW12ALL_VERSION', '20160108.2' );
define( 'ROTW12ALL_CDIR', get_stylesheet_directory() ); // if child, will be the file path, with out backslash
define( 'ROTW12ALL_CURI', get_stylesheet_uri() ); // URL to the theme directory, no back slash

remove_action( 'wp_head', 'wp_generator' );

// Clean up the <head>
function rotw12all_removeHeadLinks() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
}

add_action( 'init', 'rotw12all_removeHeadLinks' );


?>