<?php
// ==========================================================================
//
//  Theme Enqueue
//    Scripts and Styles enqueue
//
// ==========================================================================

// --------------------------------------------------------------------------
// Enqueue Scripts
// --------------------------------------------------------------------------

function hibiki_enqueue_scripts() {

  // Deregister local scripts

  wp_deregister_script( 'jquery' );
  wp_deregister_script( 'comment-reply' );

  // Queue Scripts

  wp_enqueue_script( 'jquery', get_bloginfo('template_url') . '/assets/scripts/vendor.js', '', '', false ); // Name the vendor scripts jquery as this is often required by plugins
  wp_enqueue_script( 'hibiki-scripts', get_bloginfo('template_url') . '/assets/scripts/app.js', 'jquery', '', true );

}

if ( !is_admin()) add_action('wp_enqueue_scripts', 'hibiki_enqueue_scripts', 0 );
