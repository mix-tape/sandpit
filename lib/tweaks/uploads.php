<?php

// --------------------------------------------------------------------------
//   Root Relative Upload Directory
// --------------------------------------------------------------------------

add_filter('upload_dir', 'hibiki_upload_directory');

function hibiki_upload_directory( $param )
{
  return str_replace('wordpress/../', '', $param);
}
