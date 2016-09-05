<?php
// Custom Functions

// Add home or internal class to body tag
function body_classes($classes) {

	$classes[] = is_front_page() ? 'home' : 'internal';
	return $classes;

}

add_filter('body_class', 'body_classes', 10, 1);

// Allow SVG files to be uploaded via Media Library
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Remove Emoji Support
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


/* ------------------------------------------------------------------------
	Birdbrain settings - Admin options page
------------------------------------------------------------------------ */
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Birdbrain Settings',
		'menu_title'	=> 'Birdbrain',
		'menu_slug' 	=> 'birdbrain',
		'icon_url'    =>  get_template_directory_uri() . '/lib/img/bb.png',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Contact Information',
		'menu_title' 	=> 'Contact Information',
		'parent_slug' 	=> 'birdbrain',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'SEO & Social',
		'menu_title' 	=> 'SEO & Social',
		'parent_slug' 	=> 'birdbrain',
	));
}

/* ------------------------------------------------------------------------
	Change Wordpress admin login logo
------------------------------------------------------------------------ */
add_action("login_head", "my_login_head");

function my_login_head() {
	echo "
	<style>
	body.login #login h1 a {
		background: url('".get_bloginfo('template_url')."/assets/img/birdbrain.svg') no-repeat scroll center top transparent;
		background-size: contain;
		height: 90px;
		width: 100%;
		margin-bottom: 20px;
	}
	</style>
	";
}

/* ------------------------------------------------------------------------
	Admin footer modification
------------------------------------------------------------------------ */

function remove_footer_admin ()
{
		echo '<span id="footer-thankyou">Developed by <a href="https://www.birdbrain.com.au" target="_blank">Birdbrain</a></span>';
}

add_filter('admin_footer_text', 'remove_footer_admin');

// --------------------------------------------------------------------------
//   Color scheme
// --------------------------------------------------------------------------

if ( !current_user_can('manage_options') )
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

/* ------------------------------------------------------------------------
	Gravity form - enable hide label
------------------------------------------------------------------------ */
add_filter("gform_enable_field_label_visibility_settings", "__return_true");

/* ------------------------------------------------------------------------
	Gravity form - go to anchor after form submit
------------------------------------------------------------------------ */
add_filter("gform_confirmation_anchor", create_function("","return true;"));
