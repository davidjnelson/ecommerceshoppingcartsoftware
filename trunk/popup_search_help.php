<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $navigation->remove_current_page();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);

  $content = CONTENT_POPUP_SEARCH_HELP;
  $body_attributes = ' marginwidth="10" marginheight="10" topmargin="10" bottommargin="10" leftmargin="10" rightmargin="10"';

  require(DIR_WS_TEMPLATES . TEMPLATENAME_POPUP);

  require('includes/application_bottom.php');
?>
