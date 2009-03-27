<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONTACT_US);

  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send')) {
    $name = escs_db_prepare_input($HTTP_POST_VARS['name']);
    $email_address = escs_db_prepare_input($HTTP_POST_VARS['email']);
    $enquiry = escs_db_prepare_input($HTTP_POST_VARS['enquiry']);

    if (escs_validate_email($email_address)) {
      escs_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);

      escs_redirect(escs_href_link(FILENAME_CONTACT_US, 'action=success'));
    } else {
      $error = true;

      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
  }

  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_CONTACT_US));

  $content = CONTENT_CONTACT_US;

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
