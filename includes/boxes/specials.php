<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

// ***** Begin Separate Price per Customer Mod ***
//  if ($random_product = escs_random_select("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS)) {
  $customer_group_query = escs_db_query("select customers_group_id from " . TABLE_CUSTOMERS . "        where customers_id =  '" . $customer_id . "'");
  $customer_group = escs_db_fetch_array($customer_group_query);

  if ($random_product = escs_random_select("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and s.customers_group_id=".(int)$customer_group['customers_group_id']." order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS)) {

  $scustomer_group_price_query = escs_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $random_product['products_id']. "' and customers_group_id =  '" . $customer_group['customers_group_id'] . "'");
    if ($scustomer_group_price = escs_db_fetch_array($scustomer_group_price_query))
        $random_product['products_price']=$specials['products_price']= $scustomer_group_price['customers_group_price'];
// ***** End Separate Price per Customer Mod ***
?>
<!-- specials //-->
<?php
  $boxHeading = BOX_HEADING_SPECIALS;
  $corner_left = 'square';
  $corner_right = 'square';
  $boxContent_attributes = ' align="center"';
  $boxLink = '<a href="' . escs_href_link(FILENAME_SPECIALS) . '" class="boxTextNoRollover"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';

  $boxContent = '<a class="boxTextNoRollover" href="' . escs_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"]) . '"><img src="' . DIR_WS_IMAGES . $random_product['products_image'] . '" align="left" border="0" alt="' . $random_product['products_name'] . '" width="' . SMALL_IMAGE_WIDTH . '" height="' . SMALL_IMAGE_HEIGHT . '">' . '</a><br><a class="boxTextNoRollover" href="' . escs_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br><s>' . $currencies->display_price($random_product['products_price'], escs_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br><span class="boxTextNoRollover">' . $currencies->display_price($random_product['specials_new_products_price'], escs_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';

  require(DIR_WS_TEMPLATES . TEMPLATENAME_BOX);

  $boxLink = '';
  $boxContent_attributes = '';
?>
<!-- specials_eof //-->
<?php
  }
?>
