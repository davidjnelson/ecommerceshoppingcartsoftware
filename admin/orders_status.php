<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (escs_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'save':
        if (isset($HTTP_GET_VARS['oID'])) $orders_status_id = escs_db_prepare_input($HTTP_GET_VARS['oID']);

        $languages = escs_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $orders_status_name_array = $HTTP_POST_VARS['orders_status_name'];
          $language_id = $languages[$i]['id'];

          $sql_data_array = array('orders_status_name' => escs_db_prepare_input($orders_status_name_array[$language_id]));

          if ($action == 'insert') {
            if (empty($orders_status_id)) {
              $next_id_query = escs_db_query("select max(orders_status_id) as orders_status_id from " . TABLE_ORDERS_STATUS . "");
              $next_id = escs_db_fetch_array($next_id_query);
              $orders_status_id = $next_id['orders_status_id'] + 1;
            }

            $insert_sql_data = array('orders_status_id' => $orders_status_id,
                                     'language_id' => $language_id);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            escs_db_perform(TABLE_ORDERS_STATUS, $sql_data_array);
          } elseif ($action == 'save') {
            escs_db_perform(TABLE_ORDERS_STATUS, $sql_data_array, 'update', "orders_status_id = '" . (int)$orders_status_id . "' and language_id = '" . (int)$language_id . "'");
          }
        }

        if (isset($HTTP_POST_VARS['default']) && ($HTTP_POST_VARS['default'] == 'on')) {
          escs_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . escs_db_input($orders_status_id) . "' where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
        }

        escs_redirect(escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $orders_status_id));
        break;
      case 'deleteconfirm':
        $oID = escs_db_prepare_input($HTTP_GET_VARS['oID']);

        $orders_status_query = escs_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
        $orders_status = escs_db_fetch_array($orders_status_query);

        if ($orders_status['configuration_value'] == $oID) {
          escs_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '' where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
        }

        escs_db_query("delete from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . escs_db_input($oID) . "'");

        escs_redirect(escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page']));
        break;
      case 'delete':
        $oID = escs_db_prepare_input($HTTP_GET_VARS['oID']);

        $status_query = escs_db_query("select count(*) as count from " . TABLE_ORDERS . " where orders_status = '" . (int)$oID . "'");
        $status = escs_db_fetch_array($status_query);

        $remove_status = true;
        if ($oID == DEFAULT_ORDERS_STATUS_ID) {
          $remove_status = false;
          $messageStack->add(ERROR_REMOVE_DEFAULT_ORDER_STATUS, 'error');
        } elseif ($status['count'] > 0) {
          $remove_status = false;
          $messageStack->add(ERROR_STATUS_USED_IN_ORDERS, 'error');
        } else {
          $history_query = escs_db_query("select count(*) as count from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_status_id = '" . (int)$oID . "'");
          $history = escs_db_fetch_array($history_query);
          if ($history['count'] > 0) {
            $remove_status = false;
            $messageStack->add(ERROR_STATUS_USED_IN_HISTORY, 'error');
          }
        }
        break;
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript" src="includes/browser.js">/************************************************ Jim's DHTML Menu v5.0- © Jim Salyer (jsalyer@REMOVETHISmchsi.com)* Visit Dynamic Drive: http://www.dynamicdrive.com for script and instructions* This notice must stay intact for use***********************************************/</script><script type="text/javascript" src="config.js"></script></head>
<body onload="init();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ORDERS_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $orders_status_query_raw = "select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "' order by orders_status_id";
  $orders_status_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $orders_status_query_raw, $orders_status_query_numrows);
  $orders_status_query = escs_db_query($orders_status_query_raw);
  while ($orders_status = escs_db_fetch_array($orders_status_query)) {
    if ((!isset($HTTP_GET_VARS['oID']) || (isset($HTTP_GET_VARS['oID']) && ($HTTP_GET_VARS['oID'] == $orders_status['orders_status_id']))) && !isset($oInfo) && (substr($action, 0, 3) != 'new')) {
      $oInfo = new objectInfo($orders_status);
    }

    if (isset($oInfo) && is_object($oInfo) && ($orders_status['orders_status_id'] == $oInfo->orders_status_id)) {
      echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->orders_status_id . '&action=edit') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $orders_status['orders_status_id']) . '\'">' . "\n";
    }

    if (DEFAULT_ORDERS_STATUS_ID == $orders_status['orders_status_id']) {
      echo '                <td class="dataTableContent"><b>' . $orders_status['orders_status_name'] . ' (' . TEXT_DEFAULT . ')</b></td>' . "\n";
    } else {
      echo '                <td class="dataTableContent">' . $orders_status['orders_status_name'] . '</td>' . "\n";
    }
?>
                <td class="dataTableContent" align="right"><?php if (isset($oInfo) && is_object($oInfo) && ($orders_status['orders_status_id'] == $oInfo->orders_status_id)) { echo escs_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $orders_status['orders_status_id']) . '">' . escs_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $orders_status_split->display_count($orders_status_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS); ?></td>
                    <td class="smallText" align="right"><?php echo $orders_status_split->display_links($orders_status_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="2" align="right"><?php echo '<a href="' . escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&action=new') . '">' . escs_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_ORDERS_STATUS . '</b>');

      $contents = array('form' => escs_draw_form('status', FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&action=insert'));
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);

      $orders_status_inputs_string = '';
      $languages = escs_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $orders_status_inputs_string .= '<br>' . escs_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . escs_draw_input_field('orders_status_name[' . $languages[$i]['id'] . ']');
      }

      $contents[] = array('text' => '<br>' . TEXT_INFO_ORDERS_STATUS_NAME . $orders_status_inputs_string);
      $contents[] = array('text' => '<br>' . escs_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('align' => 'center', 'text' => '<br>' . escs_image_submit('button_insert.gif', IMAGE_INSERT) . ' <a href="' . escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page']) . '">' . escs_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_ORDERS_STATUS . '</b>');

      $contents = array('form' => escs_draw_form('status', FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->orders_status_id  . '&action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);

      $orders_status_inputs_string = '';
      $languages = escs_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $orders_status_inputs_string .= '<br>' . escs_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . escs_draw_input_field('orders_status_name[' . $languages[$i]['id'] . ']', escs_get_orders_status_name($oInfo->orders_status_id, $languages[$i]['id']));
      }

      $contents[] = array('text' => '<br>' . TEXT_INFO_ORDERS_STATUS_NAME . $orders_status_inputs_string);
      if (DEFAULT_ORDERS_STATUS_ID != $oInfo->orders_status_id) $contents[] = array('text' => '<br>' . escs_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('align' => 'center', 'text' => '<br>' . escs_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->orders_status_id) . '">' . escs_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_ORDERS_STATUS . '</b>');

      $contents = array('form' => escs_draw_form('status', FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->orders_status_id  . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $oInfo->orders_status_name . '</b>');
      if ($remove_status) $contents[] = array('align' => 'center', 'text' => '<br>' . escs_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->orders_status_id) . '">' . escs_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($oInfo) && is_object($oInfo)) {
        $heading[] = array('text' => '<b>' . $oInfo->orders_status_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->orders_status_id . '&action=edit') . '">' . escs_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . escs_href_link(FILENAME_ORDERS_STATUS, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->orders_status_id . '&action=delete') . '">' . escs_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');

        $orders_status_inputs_string = '';
        $languages = escs_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $orders_status_inputs_string .= '<br>' . escs_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . escs_get_orders_status_name($oInfo->orders_status_id, $languages[$i]['id']);
        }

        $contents[] = array('text' => $orders_status_inputs_string);
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
