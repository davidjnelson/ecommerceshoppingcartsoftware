<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  OSC-Affiliate

  Contribution based on:

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Affiliate Program');
define('HEADING_TITLE', 'Affiliate Program');

define('HEADING_AFFILIATE_PROGRAM_TITLE', 'The ' . STORE_NAME . ' Affiliate Program');
$path = DIR_FS_CATALOG . DIR_WS_INCLUDES . 'editable_affiliate_info.php';
$file = fopen($path, "r");
$file_contents = fread($file, filesize($path));
fclose($file);
define('TEXT_INFORMATION', $file_contents);
?>