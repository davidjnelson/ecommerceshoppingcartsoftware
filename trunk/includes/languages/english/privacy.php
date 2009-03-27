<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Privacy Notice');
define('HEADING_TITLE', 'Privacy Notice');
$privacy_path = DIR_FS_CATALOG . DIR_WS_INCLUDES . 'editable_privacy.php';
$file = fopen($privacy_path, "r");
$file_contents = fread($file, filesize($privacy_path));
fclose($file);
define('TEXT_INFORMATION', $file_contents);
?>