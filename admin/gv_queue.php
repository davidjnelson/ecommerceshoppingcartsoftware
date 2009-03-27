<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  if ($HTTP_GET_VARS['action']=='confirmrelease' && isset($HTTP_GET_VARS['gid'])) {
    $gv_query=escs_db_query("select release_flag from " . TABLE_COUPON_GV_QUEUE . " where unique_id='".$HTTP_GET_VARS['gid']."'");
    $gv_result=escs_db_fetch_array($gv_query);
    if ($gv_result['release_flag']=='N') {
      $gv_query=escs_db_query("select customer_id, amount from " . TABLE_COUPON_GV_QUEUE ." where unique_id='".$HTTP_GET_VARS['gid']."'");
      if ($gv_resulta=escs_db_fetch_array($gv_query)) {
      $gv_amount = $gv_resulta['amount'];
      //Let's build a message object using the email class
      $mail_query = escs_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . $gv_resulta['customer_id'] . "'");
      $mail = escs_db_fetch_array($mail_query);
      $message = TEXT_REDEEM_COUPON_MESSAGE_HEADER;
      $message .= sprintf(TEXT_REDEEM_COUPON_MESSAGE_AMOUNT, $currencies->format($gv_amount));
      $message .= TEXT_REDEEM_COUPON_MESSAGE_BODY;
      $message .= TEXT_REDEEM_COUPON_MESSAGE_FOOTER;
      $mimemessage = new email(array('X-Mailer: Ecommerce Shopping Cart Software bulk mailer'));
      // add the message to the object
      $mimemessage->add_text($message);
      $mimemessage->build_message();

      $mimemessage->send($mail['customers_firstname'] . ' ' . $mail['customers_lastname'], $mail['customers_email_address'], '', EMAIL_FROM, TEXT_REDEEM_COUPON_SUBJECT );
      $gv_amount=$gv_resulta['amount'];
      $gv_query=escs_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id='".$gv_resulta['customer_id']."'");
      $customer_gv=false;
      $total_gv_amount=0;
      if ($gv_result=escs_db_fetch_array($gv_query)) {
        $total_gv_amount=$gv_result['amount'];
        $customer_gv=true;
      }
      $total_gv_amount=$total_gv_amount+$gv_amount;
      if ($customer_gv) {
        $gv_update=escs_db_query("update " . TABLE_COUPON_GV_CUSTOMER . " set amount='".$total_gv_amount."' where customer_id='".$gv_resulta['customer_id']."'");
      } else {
        $gv_insert=escs_db_query("insert into " .TABLE_COUPON_GV_CUSTOMER . " (customer_id, amount) values ('".$gv_resulta['customer_id']."','".$total_gv_amount."')");
      }
        $gv_update=escs_db_query("update " . TABLE_COUPON_GV_QUEUE . " set release_flag='Y' where unique_id='".$HTTP_GET_VARS['gid']."'");
      }
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript" src="includes/browser.js">/************************************************ Jim's DHTML Menu v5.0- © Jim Salyer (jsalyer@REMOVETHISmchsi.com)* Visit Dynamic Drive: http://www.dynamicdrive.com for script and instructions* This notice must stay intact for use***********************************************/</script><script type="text/javascript" src="config.js"></script></head>
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMERS; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_ORDERS_ID; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_VOUCHER_VALUE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_DATE_PURCHASED; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $gv_query_raw = "select c.customers_firstname, c.customers_lastname, gv.unique_id, gv.date_created, gv.amount, gv.order_id from " . TABLE_CUSTOMERS . " c, " . TABLE_COUPON_GV_QUEUE . " gv where (gv.customer_id = c.customers_id and gv.release_flag = 'N')";
  $gv_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $gv_query_raw, $gv_query_numrows);
  $gv_query = escs_db_query($gv_query_raw);
  while ($gv_list = escs_db_fetch_array($gv_query)) {
    if (((!$HTTP_GET_VARS['gid']) || (@$HTTP_GET_VARS['gid'] == $gv_list['unique_id'])) && (!$gInfo)) {
      $gInfo = new objectInfo($gv_list);
    }
    if ( (is_object($gInfo)) && ($gv_list['unique_id'] == $gInfo->unique_id) ) {
      echo '              <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . escs_href_link('gv_queue.php', escs_get_all_get_params(array('gid', 'action')) . 'gid=' . $gInfo->unique_id . '&action=edit') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . escs_href_link('gv_queue.php', escs_get_all_get_params(array('gid', 'action')) . 'gid=' . $gv_list['unique_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $gv_list['customers_firstname'] . ' ' . $gv_list['customers_lastname']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $gv_list['order_id']; ?></td>
                <td class="dataTableContent" align="right"><?php echo $currencies->format($gv_list['amount']); ?></td>
                <td class="dataTableContent" align="right"><?php echo escs_datetime_short($gv_list['date_created']); ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($gInfo)) && ($gv_list['unique_id'] == $gInfo->unique_id) ) { echo escs_image(DIR_WS_IMAGES . 'icon_arrow_right.gif'); } else { echo '<a href="' . escs_href_link(FILENAME_GV_QUEUE, 'page=' . $HTTP_GET_VARS['page'] . '&gid=' . $gv_list['unique_id']) . '">' . escs_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $gv_split->display_count($gv_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS); ?></td>
                    <td class="smallText" align="right"><?php echo $gv_split->display_links($gv_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($HTTP_GET_VARS['action']) {
    case 'release':
      $heading[] = array('text' => '[' . $gInfo->unique_id . '] ' . escs_datetime_short($gInfo->date_created) . ' ' . $currencies->format($gInfo->amount));

      $contents[] = array('align' => 'center', 'text' => '<a href="' . escs_href_link('gv_queue.php','action=confirmrelease&gid='.$gInfo->unique_id,'NONSSL').'">'.escs_image_button('button_confirm_red.gif', IMAGE_CONFIRM) . '</a> <a href="' . escs_href_link('gv_queue.php','action=cancel&gid=' . $gInfo->unique_id,'NONSSL') . '">' . escs_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      $heading[] = array('text' => '[' . $gInfo->unique_id . '] ' . escs_datetime_short($gInfo->date_created) . ' ' . $currencies->format($gInfo->amount));

      $contents[] = array('align' => 'center','text' => '<a href="' . escs_href_link('gv_queue.php','action=release&gid=' . $gInfo->unique_id,'NONSSL'). '">' . escs_image_button('button_release.gif', IMAGE_RELEASE) . '</a>');
      break;
   }

  if ( (escs_not_null($heading)) && (escs_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
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