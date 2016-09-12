<?php

// returns WordPress subdirectory if applicable


function is_element_empty($element) {
  $element = trim($element);
  return empty($element) ? false : true;
}
