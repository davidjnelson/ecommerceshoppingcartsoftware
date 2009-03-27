<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>
<!-- languages //-->
<?php
  $boxHeading = BOX_HEADING_LANGUAGES;
  $corner_left = 'square';
  $corner_right = 'square';
  $boxContent_attributes = ' align="center"';

  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language;
  }

  $boxContent = '';
  reset($lng->catalog_languages);
  while (list($key, $value) = each($lng->catalog_languages)) {
    $boxContent .= ' <a href="' . escs_href_link(basename($PHP_SELF), escs_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . escs_image(DIR_WS_LANGUAGES .  $value['directory'] . '/images/' . $value['image'], $value['name']) . '</a> ';
  }

  require(DIR_WS_TEMPLATES . TEMPLATENAME_BOX);
?>
<!-- languages_eof //-->
<?
  $boxContent_attributes = '';
?>