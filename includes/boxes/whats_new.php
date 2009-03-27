<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  if ($random_product = escs_random_select("select products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " where products_status = '1' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
?>
<!-- whats_new //-->
<?php
    $boxHeading = BOX_HEADING_WHATS_NEW;
    $corner_left = 'square';
    $corner_right = 'square';
    $boxContent_attributes = ' align="center"';
    $boxLink = '<a href="' . escs_href_link(FILENAME_PRODUCTS_NEW) . '"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';

    $random_product['products_name'] = escs_get_products_name($random_product['products_id']);
    $random_product['specials_new_products_price'] = escs_get_products_special_price($random_product['products_id']);

    if (escs_not_null($random_product['specials_new_products_price'])) {
      $whats_new_price = '<s>' . $currencies->display_price($random_product['products_price'], escs_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br>';
      $whats_new_price .= '<span class="productSpecialPrice">' . $currencies->display_price($random_product['specials_new_products_price'], escs_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
    } else {

//******* Begin Separate Price per Customer Mod ********
//      $whats_new_price = $currencies->display_price($random_product['products_price'], escs_get_tax_rate($random_product['products_tax_class_id']));
	global $customer_id;
	$customer_group_query = escs_db_query("select customers_group_id from " . TABLE_CUSTOMERS . " where customers_id =  '" . $customer_id . "'");
	$customer_group = escs_db_fetch_array($customer_group_query);
	$customer_group_price_query = escs_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $random_product['products_id'] . "' and customers_group_id =  '" . $customer_group['customers_group_id'] . "'");
	if ( $customer_group['customers_group_id'] != 0) {
	  if ($customer_group_price = escs_db_fetch_array($customer_group_price_query)) {
	    $whats_new_price = $currencies->display_price($customer_group_price['customers_group_price'], escs_get_tax_rate($random_product['products_tax_class_id']));
	  } else {
      $whats_new_price =  $currencies->display_price($random_product['products_price'], escs_get_tax_rate($random_product['products_tax_class_id']));
	    }

	} else {

      $whats_new_price =  $currencies->display_price($random_product['products_price'], escs_get_tax_rate($random_product['products_tax_class_id']));
   }
//******* End Separate Price per Customer Mod ********

    }

    $boxContent = '<a href="' . escs_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '"><img align="left" src="' . DIR_WS_IMAGES . $random_product['products_image'] . '" alt="' . $random_product['products_name'] . '" width="' . SMALL_IMAGE_WIDTH . '" height="' . SMALL_IMAGE_HEIGHT . '" border="0">' . '</a><br><a href="' . escs_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br>' . $whats_new_price;

    require(DIR_WS_TEMPLATES . TEMPLATENAME_BOX);

    $boxLink = '';
    $boxContent_attributes = '';
?>
<!-- whats_new_eof //-->
<?php
  }
?>
