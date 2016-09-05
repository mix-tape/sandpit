<?php
/**
 * Required by WordPress.
 *
 * Keep this file clean and only use it for requires.
 */

require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/config.php');          // Configuration
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/htaccess.php');        // Rewrites for assets, H5BP .htaccess
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions

/* ------------------------------------------------------------------------
  Gravity form - enable hide label
------------------------------------------------------------------------ */
add_filter("gform_enable_field_label_visibility_settings", "__return_true");

/* ------------------------------------------------------------------------
	Gravity form - go to anchor after form submit
------------------------------------------------------------------------ */
add_filter("gform_confirmation_anchor", create_function("","return true;"));
