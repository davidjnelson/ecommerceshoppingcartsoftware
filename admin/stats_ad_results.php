<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
			<tr>
			<?php echo escs_draw_form('ad_results', FILENAME_STATS_AD_RESULTS, 'action=new_product_preview', 'post', 'enctype="multipart/form-data"'); ?>
            <td class="main" colspan=3><?php echo TEXT_AD_RANGE_START; ?><br><small>(YYYY-MM-DD)</small>: <?php echo escs_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . escs_draw_input_field('date_start'); ?><input type="submit" value="Filter By Start Date"></td>
          </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NUMBER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ADS ; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_AMOUNT; ?>&nbsp;</td>
              </tr>
<?php
  if ($HTTP_GET_VARS['page'] > 1) $rows = $HTTP_GET_VARS['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
  $ad_query_raw = "select distinct customers_advertiser, sum(value) as total_value from " . TABLE_CUSTOMERS . ", " . TABLE_ORDERS . ", " . TABLE_ORDERS_TOTAL . " where customers_advertiser <> '' and customers.customers_id = orders.customers_id and orders.orders_id = orders_total.orders_id and title = 'Total:'  and
date_purchased > '$date_start' group by customers_advertiser";

// select p.products_id, p.products_ordered, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id. "' and p.products_ordered > 0 group by pd.products_id order by p.products_ordered DESC, pd.products_name";
  $products_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $products_query_raw, $products_query_numrows);

$grand_total_value = 0;

  $ad_query = escs_db_query($ad_query_raw);
  while ($ads = escs_db_fetch_array($ad_query)) {
    $rows++;



    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }
?>
              <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';" onmouseout="this.className='dataTableRow'">
                <td class="dataTableContent"><?php echo $rows; ?>.</td>
                <td class="dataTableContent"><?php echo $ads['customers_advertiser']; ?></td>
                <td class="dataTableContent" align="right"><?php echo $currencies->format($ads['total_value']); ?>&nbsp;</td>
              </tr>

<?php
  $grand_total_value = $grand_total_value + $ads['total_value'];
  }
?>

              <tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';" onmouseout="this.className='dataTableRow'">
                <td class="dataTableContent">&nbsp;</td>
                <td class="dataTableContent">&nbsp;</td>
                <td class="dataTableContent" align="right"><strong><?php echo $currencies->format($grand_total_value); ?></strong>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="3">
			<!--- <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?>&nbsp;</td>
              </tr>
            </table> --->
			</td>
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
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>