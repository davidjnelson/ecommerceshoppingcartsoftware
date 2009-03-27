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



  if (!escs_session_is_registered('affiliate_id')) {

    $navigation->set_snapshot();

    escs_redirect(escs_href_link(FILENAME_AFFILIATE, '', 'SSL'));

  }



  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_CONTACT);



  $error = false;

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send')) {

    if (escs_validate_email(trim($HTTP_POST_VARS['email']))) {

      escs_mail(STORE_OWNER, AFFILIATE_EMAIL_ADDRESS, EMAIL_SUBJECT, $HTTP_POST_VARS['enquiry'], $HTTP_POST_VARS['name'], $HTTP_POST_VARS['email']);

      escs_redirect(escs_href_link(FILENAME_AFFILIATE_CONTACT, 'action=success'));

    } else {

      $error = true;

    }

  }



  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_AFFILIATE_CONTACT));



  $affiliate_values = escs_db_query("select * from " . TABLE_AFFILIATE . " where affiliate_id = '" . $affiliate_id . "'");

  $affiliate = escs_db_fetch_array($affiliate_values);



  $content = affiliate_contact;



  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);



  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>

