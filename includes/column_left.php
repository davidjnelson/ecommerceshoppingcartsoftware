<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require(DIR_WS_BOXES . 'shopping_cart.php');


  if ((USE_CACHE == 'true') && empty($SID)) {
    echo escs_cache_manufacturers_box();
  } else {
    include(DIR_WS_BOXES . 'manufacturers.php');
  }




  if ((USE_CACHE == 'true') && empty($SID)) {
    echo escs_cache_categories_box();
  } else {
    include(DIR_WS_BOXES . 'categories.php');
  }

  if (escs_session_is_registered('customer_id'))
  {
    include(DIR_WS_BOXES . 'order_history.php');
  }
  require(DIR_WS_BOXES . 'affiliate.php');

  ?>

  <?php
    if (substr(basename($PHP_SELF), 0, 8) != 'checkout')
    {
  ?>
 	<?php //include(DIR_WS_BOXES . 'languages.php'); ?>
 	<?php require(DIR_WS_BOXES . 'live_support.php'); ?>
    <?php include(DIR_WS_BOXES . 'currencies.php'); ?>

  <?php
    }
  ?>
