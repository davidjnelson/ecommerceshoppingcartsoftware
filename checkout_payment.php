<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
  if (!escs_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    escs_redirect(escs_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    escs_redirect(escs_href_link(FILENAME_SHOPPING_CART));
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!escs_session_is_registered('shipping')) {
    escs_redirect(escs_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && escs_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      escs_redirect(escs_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (escs_check_stock($products[$i]['id'], $products[$i]['quantity'])) {
        escs_redirect(escs_href_link(FILENAME_SHOPPING_CART));
        break;
      }
    }
  }

// if no billing destination address was selected, use the customers own address as default
  if (!escs_session_is_registered('billto')) {
    escs_session_register('billto');
    $billto = $customer_default_address_id;
  } else {
// verify the selected billing address
    $check_address_query = escs_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "'");
    $check_address = escs_db_fetch_array($check_address_query);

    if ($check_address['total'] != '1') {
      $billto = $customer_default_address_id;
      if (escs_session_is_registered('payment')) escs_session_unregister('payment');
    }
  }

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;
  require(DIR_WS_CLASSES . 'order_total.php');//ICW ADDED FOR CREDIT CLASS SYSTEM
  $order_total_modules = new order_total;//ICW ADDED FOR CREDIT CLASS SYSTEM

  if (!escs_session_is_registered('comments')) escs_session_register('comments');

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();
  $total_count = $cart->count_contents_virtual(); //ICW ADDED FOR CREDIT CLASS SYSTEM

// load all enabled payment modules
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment;

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT);

  $breadcrumb->add(NAVBAR_TITLE_1, escs_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, escs_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));

  $content = CONTENT_CHECKOUT_PAYMENT;
  $javascript = $content . '.js.php';

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>