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

  if ( ($HTTP_GET_VARS['action'] == 'send_email_to_user') && ($HTTP_POST_VARS['affiliate_email_address']) && (!$HTTP_POST_VARS['back_x']) ) {
    switch ($HTTP_POST_VARS['affiliate_email_address']) {
      case '***':
        $mail_query = escs_db_query("select affiliate_firstname, affiliate_lastname, affiliate_email_address from " . TABLE_AFFILIATE . " ");
        $mail_sent_to = TEXT_ALL_AFFILIATES;
        break;
//      case '**D':
//        $mail_query = escs_db_query("select affiliate_firstname, affiliate_lastname, affiliate_email_address from " . TABLE_AFFILIATE . " where affiliate_newsletter = '1'");
//        $mail_sent_to = TEXT_NEWSLETTER_AFFILIATE;
//        break;
      default:
        $affiliate_email_address = escs_db_prepare_input($HTTP_POST_VARS['affiliate_email_address']);

        $mail_query = escs_db_query("select affiliate_firstname, affiliate_lastname, affiliate_email_address from " . TABLE_AFFILIATE . " where affiliate_email_address = '" . escs_db_input($affiliate_email_address) . "'");
        $mail_sent_to = $HTTP_POST_VARS['affiliate_email_address'];
        break;
    }

    $from = escs_db_prepare_input($HTTP_POST_VARS['from']);
    $subject = escs_db_prepare_input($HTTP_POST_VARS['subject']);
    $message = escs_db_prepare_input($HTTP_POST_VARS['message']);

    // Instantiate a new mail object
    $mimemessage = new email(array('X-Mailer: osC mailer'));

    // Build the text version
    $text = strip_tags($text);
    if (EMAIL_USE_HTML == 'true') {
      $mimemessage->add_html($message);
    } else {
      $mimemessage->add_text($message);
    }

    // Send message
    $mimemessage->build_message();
    while ($mail = escs_db_fetch_array($mail_query)) {
      $mimemessage->send($mail['affiliate_firstname'] . ' ' . $mail['affiliate_lastname'], $mail['affiliate_email_address'], '', $from, $subject);
    }

    escs_redirect(escs_href_link(FILENAME_AFFILIATE_CONTACT, 'mail_sent_to=' . urlencode($mail_sent_to)));
  }

  if ( ($HTTP_GET_VARS['action'] == 'preview') && (!$HTTP_POST_VARS['affiliate_email_address']) ) {
    $messageStack->add(ERROR_NO_AFFILIATE_SELECTED, 'error');
  }

  if (escs_not_null($HTTP_GET_VARS['mail_sent_to'])) {
    $messageStack->add(sprintf(NOTICE_EMAIL_SENT_TO, $HTTP_GET_VARS['mail_sent_to']), 'notice');
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript" src="includes/browser.js">/************************************************ Jim's DHTML Menu v5.0- � Jim Salyer (jsalyer@REMOVETHISmchsi.com)* Visit Dynamic Drive: http://www.dynamicdrive.com for script and instructions* This notice must stay intact for use***********************************************/</script><script type="text/javascript" src="config.js"></script></head>
<body onload="init();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ( ($HTTP_GET_VARS['action'] == 'preview') && ($HTTP_POST_VARS['affiliate_email_address']) ) {
    switch ($HTTP_POST_VARS['affiliate_email_address']) {
      case '***':
        $mail_sent_to = TEXT_ALL_AFFILIATES;
        break;
//      case '**D':
//        $mail_sent_to = TEXT_NEWSLETTER_AFFILIATES;
//        break;
      default:
        $mail_sent_to = $HTTP_POST_VARS['affiliate_email_address'];
        break;
    }
?>
          <tr><?php echo escs_draw_form('mail', FILENAME_AFFILIATE_CONTACT, 'action=send_email_to_user'); ?>
            <td><table border="0" width="100%" cellpadding="0" cellspacing="2">
              <tr>
                <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_AFFILIATE; ?></b><br><?php echo $mail_sent_to; ?></td>
              </tr>
              <tr>
                <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_FROM; ?></b><br><?php echo htmlspecialchars(stripslashes($HTTP_POST_VARS['from'])); ?></td>
              </tr>
              <tr>
                <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_SUBJECT; ?></b><br><?php echo htmlspecialchars(stripslashes($HTTP_POST_VARS['subject'])); ?></td>
              </tr>
              <tr>
                <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_MESSAGE; ?></b><br><?php echo nl2br(htmlspecialchars(stripslashes($HTTP_POST_VARS['message']))); ?></td>
              </tr>
              <tr>
                <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td>
<?php
/* Re-Post all POST'ed variables */
    reset($HTTP_POST_VARS);
    while (list($key, $value) = each($HTTP_POST_VARS)) {
      if (!is_array($HTTP_POST_VARS[$key])) {
        echo escs_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
      }
    }
?>
                <table border="0" width="100%" cellpadding="0" cellspacing="2">
                  <tr>
                    <td><?php echo escs_image_submit('button_back.gif', IMAGE_BACK, 'name="back"'); ?></td>
                    <td align="right"><?php echo '<a href="' . escs_href_link(FILENAME_AFFILIATE_CONTACT) . '">' . escs_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a> ' . escs_image_submit('button_send_mail.gif', IMAGE_SEND_EMAIL); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </form></tr>
<?php
  } else {
?>
          <tr><?php echo escs_draw_form('mail', FILENAME_AFFILIATE_CONTACT, 'action=preview'); ?>
            <td><table border="0" cellpadding="0" cellspacing="2">
              <tr>
                <td colspan="2"><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
<?php
    $affiliate = array();
    $affiliate[] = array('id' => '', 'text' => TEXT_SELECT_AFFILIATE);
    $affiliate[] = array('id' => '***', 'text' => TEXT_ALL_AFFILIATES);
//    $affiliate[] = array('id' => '**D', 'text' => TEXT_NEWSLETTER_AFFILIATES);
    $mail_query = escs_db_query("select affiliate_email_address, affiliate_firstname, affiliate_lastname from " . TABLE_AFFILIATE . " order by affiliate_lastname");
    while($affiliate_values = escs_db_fetch_array($mail_query)) {
      $affiliate[] = array('id' => $affiliate_values['affiliate_email_address'],
                           'text' => $affiliate_values['affiliate_lastname'] . ', ' . $affiliate_values['affiliate_firstname'] . ' (' . $affiliate_values['affiliate_email_address'] . ')');
    }
?>
              <tr>
                <td class="main"><?php echo TEXT_AFFILIATE; ?></td>
                <td><?php echo escs_draw_pull_down_menu('affiliate_email_address', $affiliate, $HTTP_GET_VARS['affiliate']);?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_FROM; ?></td>
                <td><?php echo escs_draw_input_field('from', AFFILIATE_EMAIL_ADDRESS, 'size="60"'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_SUBJECT; ?></td>
                <td><?php echo escs_draw_input_field('subject', '', 'size="60"'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td valign="top" class="main"><?php echo TEXT_MESSAGE; ?></td>
                <td><?php echo escs_draw_textarea_field('message', 'soft', '60', '15'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td colspan="2" align="right"><?php echo escs_image_submit('button_send_mail.gif', IMAGE_SEND_EMAIL); ?></td>
              </tr>
            </table></td>
          </form></tr>
<?php
  }
?>
<!-- body_text_eof //-->
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>