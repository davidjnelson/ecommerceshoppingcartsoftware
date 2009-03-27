<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  if (isset($HTTP_GET_VARS['products_id'])) {
?>
<!-- notifications //-->
<?php

    $boxLink = '<a href="' . escs_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';

    if (escs_session_is_registered('customer_id')) {
      $check_query = escs_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and customers_id = '" . (int)$customer_id . "'");
      $check = escs_db_fetch_array($check_query);

      $notification_exists = (($check['count'] > 0) ? true : false);
    } else {
      $notification_exists = false;
    }

    if ($notification_exists == true) {
      $boxContent = '<a href="' . escs_href_link(basename($PHP_SELF), escs_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '" class="boxText">' . sprintf(BOX_NOTIFICATIONS_NOTIFY_REMOVE, escs_get_products_name($HTTP_GET_VARS['products_id'])) .'</a>';
    } else {
      $boxContent = '<a href="' . escs_href_link(basename($PHP_SELF), escs_get_all_get_params(array('action')) . 'action=notify', $request_type) . '" class="boxText">' . sprintf(BOX_NOTIFICATIONS_NOTIFY, escs_get_products_name($HTTP_GET_VARS['products_id'])) .'</a>';
    }
	print $boxContent;
?>
<!-- notifications_eof //-->
<?php
    $boxLink = '';
  }
?>
