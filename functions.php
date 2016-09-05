<?php

// ==========================================================================
//
//  Functions.php
//    Required by Wordpress, keep clean and use only for requires
//
// ==========================================================================

include_once('lib/configuration/initialize.php');           // Utility functions
include_once('lib/configuration/activation.php');           // Theme setup
include_once('lib/configuration/assets-enqueue.php');       // Dependency management


// --------------------------------------------------------------------------
//   Include Utilities
// --------------------------------------------------------------------------

foreach (glob(dirname(__FILE__) . "/lib/utilities/*.php") as $filename)
{
	include $filename;
}


// --------------------------------------------------------------------------
//   Include Models
// --------------------------------------------------------------------------

foreach (glob(dirname(__FILE__) . "/lib/models/*.php") as $filename)
{
	include $filename;
}


// --------------------------------------------------------------------------
//   Include Tweaks
// --------------------------------------------------------------------------

foreach (glob(dirname(__FILE__) . "/lib/tweaks/*.php") as $filename)
{
	include $filename;
}
