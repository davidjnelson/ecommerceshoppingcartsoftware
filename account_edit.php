<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!escs_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    escs_redirect(escs_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_EDIT);

  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    if (ACCOUNT_GENDER == 'true') $gender = escs_db_prepare_input($HTTP_POST_VARS['gender']);
    $firstname = escs_db_prepare_input($HTTP_POST_VARS['firstname']);
    $lastname = escs_db_prepare_input($HTTP_POST_VARS['lastname']);
    if (ACCOUNT_DOB == 'true') $dob = escs_db_prepare_input($HTTP_POST_VARS['dob']);
    $email_address = escs_db_prepare_input($HTTP_POST_VARS['email_address']);
    $telephone = escs_db_prepare_input($HTTP_POST_VARS['telephone']);
    $fax = escs_db_prepare_input($HTTP_POST_VARS['fax']);

    $error = false;

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('account_edit', ENTRY_GENDER_ERROR);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_LAST_NAME_ERROR);
    }

    if (ACCOUNT_DOB == 'true') {
      if (!checkdate(substr(escs_date_raw($dob), 4, 2), substr(escs_date_raw($dob), 6, 2), substr(escs_date_raw($dob), 0, 4))) {
        $error = true;

        $messageStack->add('account_edit', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR);
    }

    if (!escs_validate_email($email_address)) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }

    $check_email_query = escs_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . escs_db_input($email_address) . "' and customers_id != '" . (int)$customer_id . "'");
    $check_email = escs_db_fetch_array($check_email_query);
    if ($check_email['total'] > 0) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_TELEPHONE_NUMBER_ERROR);
    }

    if ($error == false) {
      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = escs_date_raw($dob);

      escs_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "'");

      escs_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . (int)$customer_id . "'");

      $sql_data_array = array('entry_firstname' => $firstname,
                              'entry_lastname' => $lastname);

      escs_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$customer_default_address_id . "'");

// reset the session variables
      $customer_first_name = $firstname;

      $messageStack->add_session('account', SUCCESS_ACCOUNT_UPDATED, 'success');

      escs_redirect(escs_href_link(FILENAME_ACCOUNT, '', 'SSL'));
    }
  }

  $account_query = escs_db_query("select customers_gender, customers_firstname, customers_lastname, customers_dob, customers_email_address, customers_telephone, customers_fax from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $account = escs_db_fetch_array($account_query);

  $breadcrumb->add(NAVBAR_TITLE_1, escs_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, escs_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'));

  $content = CONTENT_ACCOUNT_EDIT;
  $javascript = 'form_check.js.php';

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
