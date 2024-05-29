<?php 
/* 

Plugin Name:  Blueprint
Description:  Little changes that make a big difference.
Version:      1.0.0
Author:       Digital Rockpool
Author URI:   https://www.digitalrockpool.com
License:      GPL-2.0+
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  blueprint

/* # Table of Contents
- WordPress Admin Customisations
    - Disable Theme and Plugin Editor
    - Theme Support
    - Remove User Profile Fields
	- Custom Login
    - Style Login Page
    - Change Login Logo URL
    - Change Login Logo Title
    - Remove Langage Dropdown
*/

$site_url = get_option( 'siteurl' );
include $site_url.'/wp-content/plugins/blueprint/inc/gravity-forms.php';

/* # Enqueue Custom Scripts and Styles
---------------------------------------------------------------------- */
function utm_user_scripts() {
  $site_url = get_option( 'siteurl' );

wp_enqueue_style( 'style',  $site_url.'/wp-content/plugins/blueprint/lib/css/gravity-forms.css');
}

add_action( 'wp_enqueue_scripts', 'utm_user_scripts' );

/* # WordPress Admin Customisations
---------------------------------------------------------------------- */
/* ## Disable Theme and Plugin Editor ## */
define( 'DISALLOW_FILE_EDIT', true );

/* ## Theme Support ## */
add_theme_support( 'custom-logo' );


/* # Custom Login
---------------------------------------------------------------------- */
/* ## Style Login Page ## */
add_action( 'login_head', function() {
  $site_url = get_option( 'siteurl' );
	echo '<link rel="stylesheet" type="text/css" href="'.$site_url.'/wp-content/plugins/blueprint/lib/css/login.css" />';
} );

/* ## Change Login Logo URL ## */
add_filter( 'login_headerurl', function() {
	return get_bloginfo( 'url' );
} );

/* ## Change Login Logo Title ## */
add_filter( 'login_headertitle', function() {
	return get_bloginfo( 'name' );
} );

/* ## Remove Langage Dropdown ## */
add_filter( 'login_display_language_dropdown', '__return_false' );


/* # Gutenberg Blocks
---------------------------------------------------------------------- */
function disable_gutenberg_tips() {
	$script = "jQuery(document).ready(function(){
    var is_tip_visible = wp.data.select( 'core/nux' ).areTipsEnabled()
    if (is_tip_visible) {
        wp.data.dispatch( 'core/nux' ).disableTips();
    }
  });";
	wp_add_inline_script( 'wp-blocks', $script );
}
add_action( 'enqueue_block_editor_assets', 'disable_gutenberg_tips' );
