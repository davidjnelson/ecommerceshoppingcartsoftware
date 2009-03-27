<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    escs_redirect(escs_href_link(FILENAME_COOKIE_USAGE));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
    $email_address = escs_db_prepare_input($HTTP_POST_VARS['email_address']);
    $password = escs_db_prepare_input($HTTP_POST_VARS['password']);

// Check if email exists
    $check_customer_query = escs_db_query("select customers_id, customers_firstname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . escs_db_input($email_address) . "'");
    if (!escs_db_num_rows($check_customer_query)) {
      $error = true;
    } else {
      $check_customer = escs_db_fetch_array($check_customer_query);
// Check that password is good
      if (!escs_validate_password($password, $check_customer['customers_password'])) {
        $error = true;
      } else {
        if (SESSION_RECREATE == 'True') {
          escs_session_recreate();
        }

        $check_country_query = escs_db_query("select entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$check_customer['customers_id'] . "' and address_book_id = '" . (int)$check_customer['customers_default_address_id'] . "'");
        $check_country = escs_db_fetch_array($check_country_query);

        $customer_id = $check_customer['customers_id'];
        $customer_default_address_id = $check_customer['customers_default_address_id'];
        $customer_first_name = $check_customer['customers_firstname'];
        $customer_country_id = $check_country['entry_country_id'];
        $customer_zone_id = $check_country['entry_zone_id'];
        escs_session_register('customer_id');
        escs_session_register('customer_default_address_id');
        escs_session_register('customer_first_name');
        escs_session_register('customer_country_id');
        escs_session_register('customer_zone_id');

        escs_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . (int)$customer_id . "'");

// restore cart contents
        $cart->restore_contents();

        if (sizeof($navigation->snapshot) > 0) {
          $origin_href = escs_href_link($navigation->snapshot['page'], escs_array_to_string($navigation->snapshot['get'], array(escs_session_name())), $navigation->snapshot['mode']);
          $navigation->clear_snapshot();
          escs_redirect($origin_href);
        } else {
          escs_redirect(escs_href_link(FILENAME_DEFAULT));
        }
      }
    }
  }

  if ($error == true) {
    $messageStack->add('login', TEXT_LOGIN_ERROR);
  }

  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_LOGIN, '', 'SSL'));

  $content = CONTENT_LOGIN;
  $javascript = $content . '.js';

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
