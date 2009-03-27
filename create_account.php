<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);

  $process = false;
  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    $process = true;

    if (ACCOUNT_GENDER == 'true') {
      if (isset($HTTP_POST_VARS['gender'])) {
        $gender = escs_db_prepare_input($HTTP_POST_VARS['gender']);
      } else {
        $gender = false;
      }
    }
    $firstname = escs_db_prepare_input($HTTP_POST_VARS['firstname']);
    $lastname = escs_db_prepare_input($HTTP_POST_VARS['lastname']);
    if (ACCOUNT_DOB == 'true') $dob = escs_db_prepare_input($HTTP_POST_VARS['dob']);
    $email_address = escs_db_prepare_input($HTTP_POST_VARS['email_address']);
    if (ACCOUNT_COMPANY == 'true') $company = escs_db_prepare_input($HTTP_POST_VARS['company']);
    $street_address = escs_db_prepare_input($HTTP_POST_VARS['street_address']);
    if (ACCOUNT_SUBURB == 'true') $suburb = escs_db_prepare_input($HTTP_POST_VARS['suburb']);
    $postcode = escs_db_prepare_input($HTTP_POST_VARS['postcode']);
    $city = escs_db_prepare_input($HTTP_POST_VARS['city']);
    if (ACCOUNT_STATE == 'true') {
      $state = escs_db_prepare_input($HTTP_POST_VARS['state']);
      if (isset($HTTP_POST_VARS['zone_id'])) {
        $zone_id = escs_db_prepare_input($HTTP_POST_VARS['zone_id']);
      } else {
        $zone_id = false;
      }
    }
    $country = escs_db_prepare_input($HTTP_POST_VARS['country']);
    $telephone = escs_db_prepare_input($HTTP_POST_VARS['telephone']);
    $fax = escs_db_prepare_input($HTTP_POST_VARS['fax']);
    if (isset($HTTP_POST_VARS['newsletter'])) {
      $newsletter = escs_db_prepare_input($HTTP_POST_VARS['newsletter']);
    } else {
      $newsletter = false;
    }
    $password = escs_db_prepare_input($HTTP_POST_VARS['password']);
    $confirmation = escs_db_prepare_input($HTTP_POST_VARS['confirmation']);

    $error = false;

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('create_account', ENTRY_GENDER_ERROR);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_LAST_NAME_ERROR);
    }

    if (ACCOUNT_DOB == 'true') {
      if (checkdate(substr(escs_date_raw($dob), 4, 2), substr(escs_date_raw($dob), 6, 2), substr(escs_date_raw($dob), 0, 4)) == false) {
        $error = true;

        $messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (escs_validate_email($email_address) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    } else {
      $check_email_query = escs_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . escs_db_input($email_address) . "'");
      $check_email = escs_db_fetch_array($check_email_query);
      if ($check_email['total'] > 0) {
        $error = true;

        $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      }
    }

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_POST_CODE_ERROR);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_CITY_ERROR);
    }

    if (is_numeric($country) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_COUNTRY_ERROR);
    }

    if (ACCOUNT_STATE == 'true') {
  //    $zone_id = 0;
  //    $check_query = escs_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
  //    $check = escs_db_fetch_array($check_query);
  //    $entry_state_has_zones = ($check['total'] > 0);
  //    if ($entry_state_has_zones == true) {
      //  $zone_query = escs_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name like '" . escs_db_input($state) . "%' or zone_code like '%" . escs_db_input($state) . "%')");
      //  if (escs_db_num_rows($zone_query) == 1) {
      //    $zone = escs_db_fetch_array($zone_query);
      //    $zone_id = $zone['zone_id'];
      //  } else {
      //    $error = true;
//
      //    $messageStack->add('create_account', ENTRY_STATE_ERROR_SELECT);
      //  }
      //} else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('create_account', ENTRY_STATE_ERROR);
        }
      //}
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_TELEPHONE_NUMBER_ERROR);
    }


    if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR);
    } elseif ($password != $confirmation) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
    }

    if ($error == false) {
      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
                              'customers_password' => escs_encrypt_password($password),
							  'customers_advertiser' => $HTTP_COOKIE_VARS["adcookie"],
                              'customers_referer_url' => $HTTP_COOKIE_VARS["referrer_tracking"]);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = escs_date_raw($dob);

      escs_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $customer_id = escs_db_insert_id();

      $sql_data_array = array('customers_id' => $customer_id,
                              'entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = $zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

      escs_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = escs_db_insert_id();

      escs_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

      escs_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");

      if (SESSION_RECREATE == 'True') {
        escs_session_recreate();
      }

      $customer_first_name = $firstname;
      $customer_default_address_id = $address_id;
      $customer_country_id = $country;
      $customer_zone_id = $zone_id;
      escs_session_register('customer_id');
      escs_session_register('customer_first_name');
      escs_session_register('customer_default_address_id');
      escs_session_register('customer_country_id');
      escs_session_register('customer_zone_id');

// restore cart contents
      $cart->restore_contents();

// build the message content
      $name = $firstname . ' ' . $lastname;

      if (ACCOUNT_GENDER == 'true') {
         if ($gender == 'm') {
           $email_text = sprintf(EMAIL_GREET_MR, $lastname);
         } else {
           $email_text = sprintf(EMAIL_GREET_MS, $lastname);
         }
      } else {
        $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
      }

      $email_text .= "Welcome to " . STORE_NAME . ".  " . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
// ICW - CREDIT CLASS CODE BLOCK ADDED  ******************************************************* BEGIN
//  if (NEW_SIGNUP_GIFT_VOUCHER_AMOUNT > 0) {
//    $coupon_code = create_coupon_code();
//    $insert_query = escs_db_query("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $coupon_code . "', 'G', '" . NEW_SIGNUP_GIFT_VOUCHER_AMOUNT . "', now())");
//    $insert_id = escs_db_insert_id($insert_query);
//    $insert_query = escs_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $email_address . "', now() )");

//    $email_text .= sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) . "\n\n" .
//                   sprintf(EMAIL_GV_REDEEM, $coupon_code) . "\n\n" .
//                   EMAIL_GV_LINK . escs_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code) .
//                   "\n\n";
//  }
//  if (NEW_SIGNUP_DISCOUNT_COUPON != '') {
//    $coupon_id = NEW_SIGNUP_DISCOUNT_COUPON;
//    $coupon_query = escs_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . $coupon_id . "'");
//    $coupon_desc_query = escs_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $coupon_id . "' and language_id = '" . languages_id . "'");
//    $coupon = escs_db_fetch_array($coupon_query);
//    $coupon_desc = escs_db_fetch_array($coupon_desc_query);
//    $insert_query = escs_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $coupon_id ."', '0', 'Admin', '" . $email_address . "', now() )");
//    $email_text .= EMAIL_COUPON_INCENTIVE_HEADER .  "\n\n" .
//                   $coupon_desc['coupon_description'] .
//                   sprintf(EMAIL_COUPON_REDEEM, $coupon['coupon_code']) . "\n\n" .
//                   "\n\n";



//  }

// ICW - CREDIT CLASS CODE BLOCK ADDED  ******************************************************* END
      escs_mail($name, $email_address, "Welcome to " . STORE_NAME, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

      escs_redirect(escs_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));
    }
  }

  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));

  $content = CONTENT_CREATE_ACCOUNT;

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>