
<?php
/*
$Id: xsell_products.php, v1  2002/09/11

Ecommerce Shopping Cart Software
<http://www.ecommerceshoppingcartsoftware.org>

Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

Released under the GNU General Public License
*/

if ($HTTP_GET_VARS['products_id']) {
$xsell_query = escs_db_query("select distinct p.products_id, p.products_image, pd.products_name, p.products_tax_class_id, products_price from " . TABLE_PRODUCTS_XSELL . " xp, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where xp.products_id = '" . $HTTP_GET_VARS['products_id'] . "' and xp.xsell_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' and p.products_status = '1' order by xp.products_id asc limit " . MAX_DISPLAY_ALSO_PURCHASED);
$num_products_xsell = escs_db_num_rows($xsell_query);
if ($num_products_xsell >= MIN_DISPLAY_ALSO_PURCHASED) {
?>
<!-- xsell_products //-->
<?php
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_XSELL_PRODUCTS);
      new contentBoxHeading($info_box_contents);

      $row = 0;
      $col = 0;
      $info_box_contents = array();
      while ($xsell = escs_db_fetch_array($xsell_query)) {
//*********** Begin Separate Price Per Customer Mod *************
         global $customer_id;
          $customer_group_query = escs_db_query("select customers_group_id from " . TABLE_CUSTOMERS . " where customers_id =  '" . $customer_id . "'");
          $customer_group = escs_db_fetch_array($customer_group_query);
          $customer_group_price_query = escs_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $xsell['products_id'] . "' and customers_group_id =  '" . $customer_group['customers_group_id'] . "'");
          if ( $customer_group['customers_group_id'] != 0)
            if ($customer_group_price = escs_db_fetch_array($customer_group_price_query))
                $xsell['specials_new_products_price']= $customer_group_price['customers_group_price'];
//*********** End Separate Price Per Customer Mod *************


        //$xsell['specials_new_products_price'] = escs_get_products_special_price($xsell['products_id']);

if ($xsell['specials_new_products_price']) {
      $xsell_price =  '<s>' . $currencies->display_price($xsell['products_price'], escs_get_tax_rate($xsell['products_tax_class_id'])) . '</s><br>';
      $xsell_price .= '<span class="productSpecialPrice">' . $currencies->display_price($xsell['specials_new_products_price'], escs_get_tax_rate($xsell['products_tax_class_id'])) . '</span>';
    } else {

      $xsell_price =  $currencies->display_price($xsell['products_price'], escs_get_tax_rate($xsell['products_tax_class_id']));

    }
        $info_box_contents[$row][$col] = array('align' => 'center',
                                               'params' => 'class="smallText" width="33%" valign="top"',
                                               'text' => '<a href="' . escs_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . escs_image(DIR_WS_IMAGES . $xsell['products_image'], $xsell['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . escs_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . $xsell['products_name'] .'</a><br>' . $xsell_price. '<br><a href="' . escs_href_link(FILENAME_DEFAULT, escs_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $xsell['products_id'], 'NONSSL') . '">' . escs_image_button('button_buy_now.gif', TEXT_BUY . $xsell['products_name'] . TEXT_NOW) .'</a>');
        $col ++;
        if ($col > 2) {
          $col = 0;
          $row ++;
        }
      }
      new contentBox($info_box_contents);
?>
<!-- xsell_products_eof //-->




<?php
    }
  }
?>
