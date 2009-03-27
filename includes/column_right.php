<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
    include(DIR_WS_BOXES . 'languages.php');
    include(DIR_WS_BOXES . 'currencies.php');
  }
?>
