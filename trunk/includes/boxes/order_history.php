<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  if (escs_session_is_registered('customer_id')) {
// retreive the last x products purchased
    $orders_query = escs_db_query("select distinct op.products_id from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_PRODUCTS . " p where o.customers_id = '" . (int)$customer_id . "' and o.orders_id = op.orders_id and op.products_id = p.products_id and p.products_status = '1' group by products_id order by o.date_purchased desc limit " . MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX);
    if (escs_db_num_rows($orders_query)) {
?>
<!-- customer_orders //-->
<?php
      $boxHeading = BOX_HEADING_CUSTOMER_ORDERS;
      $corner_left = 'square';
      $corner_right = 'square';

      $product_ids = '';
      while ($orders = escs_db_fetch_array($orders_query)) {
        $product_ids .= (int)$orders['products_id'] . ',';
      }
      $product_ids = substr($product_ids, 0, -1);

      $boxContent = '<table border="0" width="100%" cellspacing="0" cellpadding="1">';
      $products_query = escs_db_query("select products_id, products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id in (" . $product_ids . ") and language_id = '" . (int)$languages_id . "' order by products_name");
      while ($products = escs_db_fetch_array($products_query)) {
        $boxContent .= '  <tr>' .
                                   '    <td class="infoBoxContents"><a href="' . escs_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id']) . '">' . $products['products_name'] . '</a></td>' .
                                   '  </tr>';
      }
      $boxContent .= '</table>';

      require(DIR_WS_TEMPLATES . TEMPLATENAME_BOX);
?>
<!-- customer_orders_eof //-->
<?php
    }
  }
?>
