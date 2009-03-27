<?php
/*
  $Id: default_specials.php,v 2.0 2003/06/13

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>
<!-- default_specials //-->

  <tr>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
<?php
$info_box_contents = array();
//  $info_box_contents[] = array('align' => 'left', 'text' => sprintf(TABLE_HEADING_DEFAULT_SPECIALS, strftime('%B')));
  $info_box_contents[] = array('align' => 'left', 'text' => '<a class="boxTextNoRollover" href="' . escs_href_link(FILENAME_SPECIALS) . '">' . sprintf(TABLE_HEADING_DEFAULT_SPECIALS, strftime('%B') . '</a>'));
  new infoBoxHeading($info_box_contents, false, false, escs_href_link(FILENAME_SPECIALS));

 $new = escs_db_query("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' and s.status = '1' order by s.specials_date_added DESC limit " . MAX_DISPLAY_SPECIAL_PRODUCTS);


 $info_box_contents = array();
  $row = 0;
  $col = 0;
  while ($default_specials = escs_db_fetch_array($new)) {
//*********** Begin Separate Price Per Customer Mod *************
         global $customer_id;
          $customer_group_query = escs_db_query("select customers_group_id from " . TABLE_CUSTOMERS . " where customers_id =  '" . $customer_id . "'");
          $customer_group = escs_db_fetch_array($customer_group_query);
          $customer_group_price_query = escs_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $default_specials['products_id'] . "' and customers_group_id =  '" . $customer_group['customers_group_id'] . "'");
          if ( $customer_group['customers_group_id'] != 0)
            if ($customer_group_price = escs_db_fetch_array($customer_group_price_query))
                $default_specials['specials_new_products_price']= $customer_group_price['customers_group_price'];
//*********** End Separate Price Per Customer Mod *************
//    $default_specials['products_name'] = escs_get_products_name($default_specials['products_id']);


    $info_box_contents[$row][$col] = array('align' => 'center',
                                           'params' => 'class="smallText" width="33%" valign="top"',
                                           'text' => '<a href="' . escs_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $default_specials["products_id"]) . '">' . escs_image(DIR_WS_IMAGES . $default_specials['products_image'], $default_specials['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . escs_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $default_specials['products_id']) . '">' . $default_specials['products_name'] . '</a><br><s>' .
$currencies->display_price($default_specials['products_price'], escs_get_tax_rate($default_specials['products_tax_class_id'])) . '</s><br><span class="productSpecialPrice">' . $currencies->display_price($default_specials['specials_new_products_price'], escs_get_tax_rate($default_specials['products_tax_class_id'])) . '</span>');
    $col ++;
    if ($col > 2) {
      $col = 0;
      $row ++;

    }
  }
  new contentBox($info_box_contents);
?>

<!-- default_specials_eof //-->