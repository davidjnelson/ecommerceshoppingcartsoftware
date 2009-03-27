<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the shopping cart page
  if (!escs_session_is_registered('customer_id')) {
    escs_redirect(escs_href_link(FILENAME_SHOPPING_CART));
  }

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'update')) {
    $notify_string = 'action=notify&';
    $notify = $HTTP_POST_VARS['notify'];
    if (!is_array($notify)) $notify = array($notify);
    for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
      $notify_string .= 'notify[]=' . $notify[$i] . '&';
    }
    if (strlen($notify_string) > 0) $notify_string = substr($notify_string, 0, -1);

    escs_redirect(escs_href_link(FILENAME_DEFAULT, $notify_string));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SUCCESS);

  $breadcrumb->add('<span class="breadcrumbs">' . NAVBAR_TITLE_1 . '</span>');
  $paypalipn_query = escs_db_query("select o.orders_status,p.* from " . TABLE_ORDERS . " o LEFT JOIN " . TABLE_PAYPALIPN_TXN . " p on p.item_number = o.orders_id AND o.customers_id = '" . (int)$customer_id . "' order by o.date_purchased desc limit 1");
  $paypalipn = escs_db_fetch_array($paypalipn_query);

  if ($paypalipn['ipn_result']=='VERIFIED') {
    if ($paypalipn['payment_status']=='Completed') {
      $NAVBAR_TITLE_2 = PAYPAL_NAVBAR_TITLE_2_OK;
      $HEADING_TITLE = PAYPAL_HEADING_TITLE_OK;
      $TEXT_SUCCESS = PAYPAL_TEXT_SUCCESS_OK;
    } else if ($paypalipn['payment_status']=='Pending') {
      $NAVBAR_TITLE_2 = PAYPAL_NAVBAR_TITLE_2_PENDING;
      $HEADING_TITLE = PAYPAL_HEADING_TITLE_PENDING;
      $TEXT_SUCCESS = PAYPAL_TEXT_SUCCESS_PENDING;
    };
    $cart->reset(TRUE);
  } else if ($paypalipn['ipn_result']=='INVALID') {
    $NAVBAR_TITLE_2 = PAYPAL_NAVBAR_TITLE_2_FAILED;
    $HEADING_TITLE = PAYPAL_HEADING_TITLE_FAILED;
    $TEXT_SUCCESS = PAYPAL_TEXT_SUCCESS_FAILED;
  } else if ($paypalipn['orders_status']==99999) {
      $NAVBAR_TITLE_2 = PAYPAL_NAVBAR_TITLE_2_PENDING;
      $HEADING_TITLE = PAYPAL_HEADING_TITLE_PENDING;
      $TEXT_SUCCESS = PAYPAL_TEXT_SUCCESS_PENDING;
  } else {
    $NAVBAR_TITLE_2 = NAVBAR_TITLE_2;
    $HEADING_TITLE = HEADING_TITLE;
    $TEXT_SUCCESS = TEXT_SUCCESS;
  };
  $breadcrumb->add('<span class="breadcrumbs">' . $NAVBAR_TITLE_2 . '</span>');

  $global_query = escs_db_query("select global_product_notifications from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "'");
  $global = escs_db_fetch_array($global_query);

  if ($global['global_product_notifications'] != '1') {
    $orders_query = escs_db_query("select orders_id from " . TABLE_ORDERS . " where customers_id = '" . (int)$customer_id . "' order by date_purchased desc limit 1");
    $orders = escs_db_fetch_array($orders_query);

    $products_array = array();
    $products_query = escs_db_query("select products_id, products_name from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$orders['orders_id'] . "' order by products_name");
    while ($products = escs_db_fetch_array($products_query)) {
      $products_array[] = array('id' => $products['products_id'],
                                'text' => $products['products_name']);
    }
  }

  $content = CONTENT_CHECKOUT_SUCCESS;

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
