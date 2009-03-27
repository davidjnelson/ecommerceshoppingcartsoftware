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



  require('includes/application_top.php');



  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {

    $affiliate_username = escs_db_prepare_input($HTTP_POST_VARS['affiliate_username']);

    $affiliate_password = escs_db_prepare_input($HTTP_POST_VARS['affiliate_password']);



// Check if username exists

    $check_affiliate_query = escs_db_query("select affiliate_id, affiliate_firstname, affiliate_password, affiliate_email_address from " . TABLE_AFFILIATE . " where affiliate_email_address = '" . escs_db_input($affiliate_username) . "'");

    if (!escs_db_num_rows($check_affiliate_query)) {

      $HTTP_GET_VARS['login'] = 'fail';

    } else {

      $check_affiliate = escs_db_fetch_array($check_affiliate_query);

// Check that password is good

      if (!escs_validate_password($affiliate_password, $check_affiliate['affiliate_password'])) {

        $HTTP_GET_VARS['login'] = 'fail';

      } else {

        $affiliate_id = $check_affiliate['affiliate_id'];

        escs_session_register('affiliate_id');



        $date_now = date('Ymd');



        escs_db_query("update " . TABLE_AFFILIATE . " set affiliate_date_of_last_logon = now(), affiliate_number_of_logons = affiliate_number_of_logons + 1 where affiliate_id = '" . $affiliate_id . "'");



        escs_redirect(escs_href_link(FILENAME_AFFILIATE_SUMMARY,'','SSL'));

      }

    }

  }



  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE);



  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_AFFILIATE, '', 'SSL'));





  $content = CONTENT_AFFILIATE;



  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);



  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>