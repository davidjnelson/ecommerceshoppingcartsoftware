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

  $orders_statuses = array();
  $orders_status_array = array();
  $orders_status_query = escs_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "'");
  while ($orders_status = escs_db_fetch_array($orders_status_query)) {
    $orders_statuses[] = array('id' => $orders_status['orders_status_id'],
                               'text' => $orders_status['orders_status_name']);
    $orders_status_array[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
  }

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (escs_not_null($action)) {
    switch ($action) {
      case 'update_order':
        $oID = escs_db_prepare_input($HTTP_GET_VARS['oID']);
        $status = escs_db_prepare_input($HTTP_POST_VARS['status']);
        $comments = escs_db_prepare_input($HTTP_POST_VARS['comments']);

        $order_updated = false;
        $check_status_query = escs_db_query("select customers_name, customers_email_address, orders_status, date_purchased from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
        $check_status = escs_db_fetch_array($check_status_query);

// BOF: WebMakers.com Added: Downloads Controller
// always update date and time on order_status
// original        if ( ($check_status['orders_status'] != $status) || escs_not_null($comments)) {
                   if ( ($check_status['orders_status'] != $status) || $comments != '' || ($status ==DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE) ) {
          escs_db_query("update " . TABLE_ORDERS . " set orders_status = '" . escs_db_input($status) . "', last_modified = now() where orders_id = '" . (int)$oID . "'");
        $check_status_query2 = escs_db_query("select customers_name, customers_email_address, orders_status, date_purchased from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
        $check_status2 = escs_db_fetch_array($check_status_query2);
      if ( $check_status2['orders_status']==DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE ) {
        escs_db_query("update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_maxdays = '" . escs_get_configuration_key_value('DOWNLOAD_MAX_DAYS') . "', download_count = '" . escs_get_configuration_key_value('DOWNLOAD_MAX_COUNT') . "' where orders_id = '" . (int)$oID . "'");
      }
// EOF: WebMakers.com Added: Downloads Controller

          $customer_notified = '0';
          if (isset($HTTP_POST_VARS['notify']) && ($HTTP_POST_VARS['notify'] == 'on')) {
            $notify_comments = '';

// BOF: WebMakers.com Added: Downloads Controller - Only tell of comments if there are comments
            if (isset($HTTP_POST_VARS['notify_comments']) && ($HTTP_POST_VARS['notify_comments'] == 'on')) {
              $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, $comments) . "\n\n";
            }
// EOF: WebMakers.com Added: Downloads Controller

            $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . escs_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . escs_date_long($check_status['date_purchased']) . "\n\n" . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE, $orders_status_array[$status]);

            escs_mail($check_status['customers_name'], $check_status['customers_email_address'], EMAIL_TEXT_SUBJECT, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

            $customer_notified = '1';
          }

          escs_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments) values ('" . (int)$oID . "', '" . escs_db_input($status) . "', now(), '" . escs_db_input($customer_notified) . "', '" . escs_db_input($comments)  . "')");

          $order_updated = true;
        }

        if ($order_updated == true) {
         $messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
        } else {
          $messageStack->add_session(WARNING_ORDER_NOT_UPDATED, 'warning');
        }

        escs_redirect(escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('action')) . 'action=edit'));
        break;
      case 'deleteconfirm':
        $oID = escs_db_prepare_input($HTTP_GET_VARS['oID']);

        escs_remove_order($oID, $HTTP_POST_VARS['restock']);

        escs_redirect(escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('oID', 'action'))));
        break;
    }
  }

  if (($action == 'edit') && isset($HTTP_GET_VARS['oID'])) {
    $oID = escs_db_prepare_input($HTTP_GET_VARS['oID']);

    $orders_query = escs_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
    $order_exists = true;
    if (!escs_db_num_rows($orders_query)) {
      $order_exists = false;
      $messageStack->add(sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
    }
  }
// BOF: WebMakers.com Added: Additional info for Orders
// Look up things in orders
$the_extra_query= escs_db_query("select * from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
$the_extra= escs_db_fetch_array($the_extra_query);
$the_customers_id= $the_extra['customers_id'];
// Look up things in customers
$the_extra_query= escs_db_query("select * from " . TABLE_CUSTOMERS . " where customers_id = '" . $the_customers_id . "'");
$the_extra= escs_db_fetch_array($the_extra_query);
$the_customers_fax= $the_extra['customers_fax'];
// EOF: WebMakers.com Added: Additional info for Orders

  include(DIR_WS_CLASSES . 'order.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript" src="includes/browser.js">/************************************************ Jim's DHTML Menu v5.0- � Jim Salyer (jsalyer@REMOVETHISmchsi.com)* Visit Dynamic Drive: http://www.dynamicdrive.com for script and instructions* This notice must stay intact for use***********************************************/</script><script type="text/javascript" src="config.js"></script></head>
<body onload="init();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php
  require(DIR_WS_INCLUDES . 'header.php');
?>
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
<?php
  if (($action == 'edit') && ($order_exists == true)) {
    $order = new order($oID);
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="pageHeading" align="right"><?php echo '<a href="' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('action'))) . '">' . escs_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
<td class="pageHeading" align="right">
<?php echo '<a href="' . escs_href_link("edit_orders.php", escs_get_all_get_params(array('action'))) . '">' . escs_image_button('button_edit.gif', IMAGE_EDIT) . '</a> &nbsp; '; ?>
<?php echo '<a href="' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('action'))) . '">' . escs_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?>
</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="3"><?php echo escs_draw_separator(); ?></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><b><?php echo ENTRY_CUSTOMER; ?></b></td>
                <td class="main"><?php echo escs_address_format($order->customer['format_id'], $order->customer, 1, '', '<br>'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo escs_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo ENTRY_TELEPHONE_NUMBER; ?></b></td>
                <td class="main"><?php echo $order->customer['telephone']; ?></td>
              </tr>
<?php
// BOF: WebMakers.com Added: Downloads Controller - Extra order info
?>
              <tr>
                <td class="main"><b><?php echo 'FAX #:'; ?></b></td>
                <td class="main"><?php echo $the_customers_fax; ?></td>
              </tr>
<?php
// EOF: WebMakers.com Added: Downloads Controller
?>
              <tr>
                <td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
                <td class="main"><?php echo '<a href="mailto:' . $order->customer['email_address'] . '"><u>' . $order->customer['email_address'] . '</u></a>'; ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><b><?php echo ENTRY_SHIPPING_ADDRESS; ?></b></td>
                <td class="main"><?php echo escs_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br>'); ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><b><?php echo ENTRY_BILLING_ADDRESS; ?></b></td>
                <td class="main"><?php echo escs_address_format($order->billing['format_id'], $order->billing, 1, '', '<br>'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
<?php
// BOF: WebMakers.com Added: Show Order Info
?>
<!-- add Order # // -->
<tr>
<td class="main"><b>Order # </b></td>
<td class="main"><?php echo escs_db_input($oID); ?></td>
</tr>
<!-- add date/time // -->
<tr>
<td class="main"><b>Order Date & Time</b></td>
<td class="main"><?php echo escs_datetime_short($order->info['date_purchased']); ?></td>
</tr>
<?php
// EOF: WebMakers.com Added: Show Order Info
?>
          <tr>
            <td class="main"><b><?php echo ENTRY_PAYMENT_METHOD; ?></b></td>
            <td class="main"><?php echo $order->info['payment_method']; ?></td>
          </tr>
<?php
    if (escs_not_null($order->info['cc_type']) || escs_not_null($order->info['cc_owner']) || escs_not_null($order->info['cc_number'])) {
?>
          <tr>
            <td colspan="2"><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_TYPE; ?></td>
            <td class="main"><?php echo $order->info['cc_type']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_OWNER; ?></td>
            <td class="main"><?php echo $order->info['cc_owner']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_NUMBER; ?></td>
            <td class="main"><?php echo $order->info['cc_number']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_EXPIRES; ?></td>
            <td class="main"><?php echo $order->info['cc_expires']; ?></td>
          </tr>
<?php
    }
?>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" colspan="2"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_EXCLUDING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_INCLUDING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_EXCLUDING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_INCLUDING_TAX; ?></td>
          </tr>
<?php
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      echo '          <tr class="dataTableRow">' . "\n" .
           '            <td class="dataTableContent" valign="top" align="right">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
           '            <td class="dataTableContent" valign="top">' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {
          echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          echo '</i></small></nobr>';
        }
      }

      echo '            </td>' . "\n" .
           '            <td class="dataTableContent" valign="top">' . $order->products[$i]['model'] . '</td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="top">' . escs_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format(escs_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format(escs_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n";
      echo '          </tr>' . "\n";
    }
?>
          <tr>
            <td align="right" colspan="8"><table border="0" cellspacing="0" cellpadding="2">
<?php
    for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
      echo '              <tr>' . "\n" .
           '                <td align="right" class="smallText">' . $order->totals[$i]['title'] . '</td>' . "\n" .
           '                <td align="right" class="smallText">' . $order->totals[$i]['text'] . '</td>' . "\n" .
           '              </tr>' . "\n";
    }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><table border="1" cellspacing="0" cellpadding="5">
          <tr>
            <td class="smallText" align="center"><b><?php echo TABLE_HEADING_DATE_ADDED; ?></b></td>
            <td class="smallText" align="center"><b><?php echo TABLE_HEADING_CUSTOMER_NOTIFIED; ?></b></td>
            <td class="smallText" align="center"><b><?php echo TABLE_HEADING_STATUS; ?></b></td>
            <td class="smallText" align="center"><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
          </tr>
<?php
    $orders_history_query = escs_db_query("select orders_status_id, date_added, customer_notified, comments from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . escs_db_input($oID) . "' order by date_added");
    if (escs_db_num_rows($orders_history_query)) {
      while ($orders_history = escs_db_fetch_array($orders_history_query)) {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" align="center">' . escs_datetime_short($orders_history['date_added']) . '</td>' . "\n" .
             '            <td class="smallText" align="center">';
        if ($orders_history['customer_notified'] == '1') {
          echo escs_image(DIR_WS_ICONS . 'tick.gif', ICON_TICK) . "</td>\n";
        } else {
          echo escs_image(DIR_WS_ICONS . 'cross.gif', ICON_CROSS) . "</td>\n";
        }
        echo '            <td class="smallText">' . $orders_status_array[$orders_history['orders_status_id']] . '</td>' . "\n" .
             '            <td class="smallText">' . nl2br(escs_db_output($orders_history['comments'])) . '&nbsp;</td>' . "\n" .
             '          </tr>' . "\n";
      }
    } else {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" .
             '          </tr>' . "\n";
    }
?>
        </table></td>
      </tr>
      <tr>
        <td class="main"><br><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr><?php echo escs_draw_form('status', FILENAME_ORDERS, escs_get_all_get_params(array('action')) . 'action=update_order'); ?>
        <td class="main"><?php echo escs_draw_textarea_field('comments', 'soft', '60', '5'); ?></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo ENTRY_STATUS; ?></b> <?php echo escs_draw_pull_down_menu('status', $orders_statuses, $order->info['orders_status']); ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo ENTRY_NOTIFY_CUSTOMER; ?></b> <?php echo escs_draw_checkbox_field('notify', '', true); ?></td>
                <td class="main"><b><?php echo ENTRY_NOTIFY_COMMENTS; ?></b> <?php echo escs_draw_checkbox_field('notify_comments', '', true); ?></td>
              </tr>
            </table></td>
            <td valign="top"><?php echo escs_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
          </tr>
        </table></td>
      </form></tr>
           <tr>
     <td colspan="2" align="right"><?php echo '<a href="' . escs_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $HTTP_GET_VARS['oID']) . '" TARGET="_blank">' . escs_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . escs_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $HTTP_GET_VARS['oID']) . '" TARGET="_blank">' . escs_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a> <a href="' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('action'))) . '">' . escs_image_button('button_back.gif', IMAGE_BACK) . '</a> <a href="' . escs_href_link(FILENAME_EDIT_ORDERS, 'oID=' . $HTTP_GET_VARS['oID']) . '">' . escs_image_button('button_edit.gif', IMAGE_EDIT) . '</a>'; ?></td>
     </tr>
<?php
  } else {
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr><?php echo escs_draw_form('orders', FILENAME_ORDERS, '', 'get'); ?>
                <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . escs_draw_input_field('oID', '', 'size="12"') . escs_draw_hidden_field('action', 'edit'); ?></td>
              </form></tr>
              <tr><?php echo escs_draw_form('status', FILENAME_ORDERS, '', 'get'); ?>
                <td class="smallText" align="right"><?php echo HEADING_TITLE_STATUS . ' ' . escs_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_ORDERS)), $orders_statuses), '', 'onChange="this.form.submit();"'); ?></td>
              </form></tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMERS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ORDER_TOTAL; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_PURCHASED; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    if (isset($HTTP_GET_VARS['cID'])) {
      $cID = escs_db_prepare_input($HTTP_GET_VARS['cID']);
      $orders_query_raw = "select o.orders_id, o.customers_name, o.customers_id, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$cID . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and ot.class = 'ot_total' order by orders_id DESC";
    } elseif (isset($HTTP_GET_VARS['status'])) {
      $status = escs_db_prepare_input($HTTP_GET_VARS['status']);
      $orders_query_raw = "select o.orders_id, o.customers_name, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.orders_status_id = '" . (int)$status . "' and ot.class = 'ot_total' order by o.orders_id DESC";
    } else {
      $orders_query_raw = "select o.orders_id, o.customers_name, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and ot.class = 'ot_total' order by o.orders_id DESC";
    }
    $orders_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $orders_query_raw, $orders_query_numrows);
    $orders_query = escs_db_query($orders_query_raw);
    while ($orders = escs_db_fetch_array($orders_query)) {
    if ((!isset($HTTP_GET_VARS['oID']) || (isset($HTTP_GET_VARS['oID']) && ($HTTP_GET_VARS['oID'] == $orders['orders_id']))) && !isset($oInfo)) {
        $oInfo = new objectInfo($orders);
      }

      if (isset($oInfo) && is_object($oInfo) && ($orders['orders_id'] == $oInfo->orders_id)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('oID')) . 'oID=' . $orders['orders_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<a href="' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('oID', 'action')) . 'oID=' . $orders['orders_id'] . '&action=edit') . '">' . escs_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW) . '</a>&nbsp;' . $orders['customers_name']; ?></td>
                <td class="dataTableContent" align="right"><?php echo strip_tags($orders['order_total']); ?></td>
                <td class="dataTableContent" align="center"><?php echo escs_datetime_short($orders['date_purchased']); ?></td>
                <td class="dataTableContent" align="right"><?php echo $orders['orders_status_name']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($oInfo) && is_object($oInfo) && ($orders['orders_id'] == $oInfo->orders_id)) { echo escs_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('oID')) . 'oID=' . $orders['orders_id']) . '">' . escs_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $orders_split->display_count($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></td>
                    <td class="smallText" align="right"><?php echo $orders_split->display_links($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], escs_get_all_get_params(array('page', 'oID', 'action'))); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_ORDER . '</b>');

      $contents = array('form' => escs_draw_form('orders', FILENAME_ORDERS, escs_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO . '<br><br><b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>');
      $contents[] = array('text' => '<br>' . escs_draw_checkbox_field('restock') . ' ' . TEXT_INFO_RESTOCK_PRODUCT_QUANTITY);
      $contents[] = array('align' => 'center', 'text' => '<br>' . escs_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id) . '">' . escs_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($oInfo) && is_object($oInfo)) {
        $heading[] = array('text' => '<b>[' . $oInfo->orders_id . ']&nbsp;&nbsp;' . escs_datetime_short($oInfo->date_purchased) . '</b>');

//        $contents[] = array('align' => 'center', 'text' => '<a href="' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit') . '">' . escs_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete') . '">' . escs_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
//        $contents[] = array('align' => 'center', 'text' => '<a href="' . escs_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . escs_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . escs_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . escs_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a>');
//        $contents[] = array('text' => '<br>' . TEXT_DATE_ORDER_CREATED . ' ' . escs_date_short($oInfo->date_purchased));
        if (escs_not_null($oInfo->last_modified)) $contents[] = array('text' => TEXT_DATE_ORDER_LAST_MODIFIED . ' ' . escs_date_short($oInfo->last_modified));
     $contents[] = array('align' => 'center', 'text' => '<a href="' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit') . '">' . escs_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . escs_href_link(FILENAME_ORDERS, escs_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete') . '">' . escs_image_button('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . escs_href_link(FILENAME_EDIT_ORDERS, 'oID=' . $oInfo->orders_id). '">' . escs_image_button('button_update.gif', IMAGE_UPDATE) . '</a>');
     $contents[] = array('align' => 'center', 'text' => '<a href="' . escs_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . escs_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . escs_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . escs_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a>');
     $contents[] = array('text' => '<br>' . TEXT_DATE_ORDER_CREATED . ' ' . escs_date_short($oInfo->date_purchased));
        $contents[] = array('text' => '<br>' . TEXT_INFO_PAYMENT_METHOD . ' '  . $oInfo->payment_method);

      }
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
<?php
  }
?>
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
