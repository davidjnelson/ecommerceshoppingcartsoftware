<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PASSWORD_FORGOTTEN);

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
    $email_address = escs_db_prepare_input($HTTP_POST_VARS['email_address']);

    $check_customer_query = escs_db_query("select customers_firstname, customers_lastname, customers_password, customers_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . escs_db_input($email_address) . "'");
    if (escs_db_num_rows($check_customer_query)) {
      $check_customer = escs_db_fetch_array($check_customer_query);

      $new_password = escs_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
      $crypted_password = escs_encrypt_password($new_password);

      escs_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . escs_db_input($crypted_password) . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'");

      escs_mail($check_customer['customers_firstname'] . ' ' . $check_customer['customers_lastname'], $email_address, EMAIL_PASSWORD_REMINDER_SUBJECT, sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

      $messageStack->add_session('login', SUCCESS_PASSWORD_SENT, 'success');

      escs_redirect(escs_href_link(FILENAME_LOGIN, '', 'SSL'));
    } else {
      $messageStack->add('password_forgotten', TEXT_NO_EMAIL_ADDRESS_FOUND);
    }
  }

  $breadcrumb->add(NAVBAR_TITLE_1, escs_href_link(FILENAME_LOGIN, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, escs_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'));

  $content = CONTENT_PASSWORD_FORGOTTEN;

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
