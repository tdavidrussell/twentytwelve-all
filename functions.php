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

define( 'ROTW12ALL_VERSION', '20160517.2' );
define( 'ROTW12ALL_CDIR', get_stylesheet_directory() ); // if child, will be the file path, with out backslash
define( 'ROTW12ALL_CURI', get_stylesheet_uri() ); // URL to the theme directory, no back slash

/**
 * By default WordPress adds all sorts of code between the opening and closing head tags of a WordPress theme
 * So lets clean out some of them
 *
 */
function ro_removeHeadLinks() {
	/** remove some header information  **/
	remove_action( 'wp_head', 'feed_links_extra', 3 );  //category feeds
	remove_action( 'wp_head', 'feed_links', 2 );        //post and comments feed, see ro_enqueue_default_feed_link()
	remove_action( 'wp_head', 'rsd_link' );              //only required if you are looking to blog using an external tool
	remove_action( 'wp_head', 'wlwmanifest_link' );      //something to do with windows live writer
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 ); //next previous post links
	remove_action( 'wp_head', 'wp_generator' );          //generator tag ie WordPress version info
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );  //short links like ?p=124
}

add_action( 'init', 'ro_removeHeadLinks' );

/**
 * above we remove all feed (RSS) links lets put them back, for post content.
 * in ro_remove_head_links() we had to remove the post and comments rss link
 * now we want to add rss back just for post content
 * because feed_links() adds both the comments and posts feeds
 *
 * @see ro_remove_head_links()
 */
function ro_enqueue_default_feed_link() {
	echo "<link rel='alternate' type='application/rss+xml' title='" . get_bloginfo( 'name' ) . " &raquo; Feed' href='" . get_feed_link() . "' />";
}

add_action( 'wp_head', 'ro_enqueue_default_feed_link' );

/**
 * Add custom style sheet to the HTML Editor
 **/
function ro_theme_add_editor_styles() {
	if ( file_exists( get_stylesheet_directory() . "/editor-style.css" ) ) {
		add_editor_style( 'editor-style.css' );
	}
}

add_action( 'init', 'ro_theme_add_editor_styles' );

/**
 * Loads CSS faster (50% they say) than CCS  @import in child theme style.css
 * @link https://kovshenin.com/2014/child-themes-import/
 * @link http://codex.wordpress.org/Child_Themes#About_.40import_url_in_CSS
 *
 *
 * @return void
 */
function ro_enqueue_style_child_theme_scripts() {

	wp_enqueue_style( 'ro-parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'ro_enqueue_style_child_theme_scripts' );

/**
 * Load a custom.css style sheet, if it exists in a child theme.
 *
 * @return void
 */
function ro_enqueue_custom_stylesheets() {
	if ( ! is_admin() ) {
		if ( is_child_theme() ) {
			if ( file_exists( get_stylesheet_directory() . "/custom.css" ) ) {
				wp_enqueue_style( 'ro-custom-css', get_template_directory_uri() . '/custom.css' );
			}
		}
	}
}

//add_action( 'wp_enqueue_scripts', 'ro_enqueue_custom_stylesheets', 11 );


?>