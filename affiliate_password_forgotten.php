<?php

/*

  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


  OSC-Affiliate



  Contribution based on:



  Ecommerce Shopping Cart Software

  http://www.ecommerceshoppingcartsoftware.org



  Copyright (c) 2002 -2003 osCommerce



  Released under the GNU General Public License

*/



  require('includes/application_top.php');



  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_PASSWORD_FORGOTTEN);



  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {

    $check_affiliate_query = escs_db_query("select affiliate_firstname, affiliate_lastname, affiliate_password, affiliate_id from " . TABLE_AFFILIATE . " where affiliate_email_address = '" . $HTTP_POST_VARS['email_address'] . "'");

    if (escs_db_num_rows($check_affiliate_query)) {

      $check_affiliate = escs_db_fetch_array($check_affiliate_query);

      // Crypted password mods - create a new password, update the database and mail it to them

      $newpass = escs_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);

      $crypted_password = escs_encrypt_password($newpass);

      escs_db_query("update " . TABLE_AFFILIATE . " set affiliate_password = '" . $crypted_password . "' where affiliate_id = '" . $check_affiliate['affiliate_id'] . "'");



      escs_mail($check_affiliate['affiliate_firstname'] . " " . $check_affiliate['affiliate_lastname'], $HTTP_POST_VARS['email_address'], EMAIL_PASSWORD_REMINDER_SUBJECT, nl2br(sprintf(EMAIL_PASSWORD_REMINDER_BODY, $newpass)), STORE_OWNER, AFFILIATE_EMAIL_ADDRESS);

      escs_redirect(escs_href_link(FILENAME_AFFILIATE, 'info_message=' . urlencode(TEXT_PASSWORD_SENT), 'SSL', true, false));

    } else {

      escs_redirect(escs_href_link(FILENAME_AFFILIATE_PASSWORD_FORGOTTEN, 'email=nonexistent', 'SSL'));

    }

  } else {



  $breadcrumb->add(NAVBAR_TITLE_1, escs_href_link(FILENAME_AFFILIATE, '', 'SSL'));

  $breadcrumb->add(NAVBAR_TITLE_2, escs_href_link(FILENAME_AFFILIATE_PASSWORD_FORGOTTEN, '', 'SSL'));

?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">

<html <?php echo HTML_PARAMS; ?>>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">

<title><?php echo TITLE; ?></title>

<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">

<link rel="stylesheet" type="text/css" href="stylesheet.css">

</head>

<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">

<!-- header //-->



<!-- header_eof //-->



<!-- body //-->

<table border="0" width="100%" cellspacing="3" cellpadding="3">

  <tr>

    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">

<!-- left_navigation //-->

<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>

<!-- left_navigation_eof //-->

    </table></td>

<!-- body_text //-->

    <td width="100%" valign="top" align="center">

      <table border="0" width="60%" cellspacing="0" cellpadding="0">

        <tr>

          <td>

          <table border="0" width="100%" cellspacing="0" cellpadding="0">

            <tr>

              <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>

              <td class="pageHeading" align="right"></td>

            </tr>

         </table>

         </td>

       </tr>

       <tr>

         <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>

       </tr>

       <tr>

         <td><?php echo escs_draw_form('password_forgotten', escs_href_link(FILENAME_AFFILIATE_PASSWORD_FORGOTTEN, 'action=process', 'SSL')); ?><br>

           <table border="0" width="100%" cellspacing="0" cellpadding="3">

             <tr>

               <td align="right" class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>

               <td class="main"><?php echo escs_draw_input_field('email_address', '', 'maxlength="96"'); ?></td>

             </tr>

             <tr>

               <td colspan="2"><br>

                 <table border="0" cellpadding="0" cellspacing="0" width="100%">

                   <tr>

                     <td valign="top"><?php echo '<a href="' . escs_href_link(FILENAME_AFFILIATE, '', 'SSL') . '">' . escs_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>

                     <td align="right" valign="top"><?php echo escs_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>

                   </tr>

                 </table>

               </td>

             </tr>

<?php

  if (isset($HTTP_GET_VARS['email']) && ($HTTP_GET_VARS['email'] == 'nonexistent')) {

    echo '          <tr>' . "\n";

    echo '            <td colspan="2" class="smallText">' .  TEXT_NO_EMAIL_ADDRESS_FOUND . '</td>' . "\n";

    echo '          </tr>' . "\n";

  }

?>

           </table></form>

         </td>

       </tr>

     </table>

     </td>

<!-- body_text_eof //-->

     <td width="<?php echo BOX_WIDTH; ?>" valign="top">

       <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">

         <tr>

           <td>

<!-- right_navigation //-->

<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>

<!-- right_navigation_eof //-->

          </td>

        </tr>

      </table>

    </td>

  </tr>

</table>

<!-- body_eof //-->



<!-- footer //-->

<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>

<!-- footer_eof //-->

<br>

</body>

</html>

<?php

  }



  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>