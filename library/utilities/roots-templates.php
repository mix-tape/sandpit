<?php
// --------------------------------------------------------------------------
//
//   Roots Template System
//
// --------------------------------------------------------------------------


function roots_template_path() {
  return Roots_Wrapping::$main_template;
}

class Roots_Wrapping {

  // Stores the full path to the main template file
  static $main_template;

  // Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
  static $base;

  static function wrap($template) {
    self::$main_template = $template;

    self::$base = substr(basename(self::$main_template), 0, -4);

    if (self::$base === 'index') {
      self::$base = false;
    }

    $templates = array('base.php');

    if (self::$base) {
      array_unshift($templates, sprintf('base-%s.php', self::$base ));
    }

    return locate_template($templates);
  }
}

add_filter('template_include', array('Roots_Wrapping', 'wrap'), 99);
