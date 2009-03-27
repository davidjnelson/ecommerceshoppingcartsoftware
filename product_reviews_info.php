<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (isset($HTTP_GET_VARS['reviews_id']) && escs_not_null($HTTP_GET_VARS['reviews_id']) && isset($HTTP_GET_VARS['products_id']) && escs_not_null($HTTP_GET_VARS['products_id'])) {
    $review_check_query = escs_db_query("select count(*) as total from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.reviews_id = '" . (int)$HTTP_GET_VARS['reviews_id'] . "' and r.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "'");
    $review_check = escs_db_fetch_array($review_check_query);

    if ($review_check['total'] < 1) {
      escs_redirect(escs_href_link(FILENAME_PRODUCT_REVIEWS, escs_get_all_get_params(array('reviews_id'))));
    }
  } else {
    escs_redirect(escs_href_link(FILENAME_PRODUCT_REVIEWS, escs_get_all_get_params(array('reviews_id'))));
  }

  escs_db_query("update " . TABLE_REVIEWS . " set reviews_read = reviews_read+1 where reviews_id = '" . (int)$HTTP_GET_VARS['reviews_id'] . "'");

  $review_query = escs_db_query("select rd.reviews_text, r.reviews_rating, r.reviews_id, r.customers_name, r.date_added, r.reviews_read, p.products_id, p.products_price, p.products_tax_class_id, p.products_image, p.products_model, pd.products_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where r.reviews_id = '" . (int)$HTTP_GET_VARS['reviews_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and r.products_id = p.products_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '". (int)$languages_id . "'");
  $review = escs_db_fetch_array($review_query);

  if ($new_price = escs_get_products_special_price($review['products_id'])) {
    $products_price = '<s>' . $currencies->display_price($review['products_price'], escs_get_tax_rate($review['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, escs_get_tax_rate($review['products_tax_class_id'])) . '</span>';
  } else {
    $products_price = $currencies->display_price($review['products_price'], escs_get_tax_rate($review['products_tax_class_id']));
  }

  if (escs_not_null($review['products_model'])) {
    $products_name = $review['products_name'] . '<br><span class="smallText">[' . $review['products_model'] . ']</span>';
  } else {
    $products_name = $review['products_name'];
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_REVIEWS_INFO);

  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_PRODUCT_REVIEWS, escs_get_all_get_params()));

  $content = CONTENT_PRODUCT_REVIEWS_INFO;
  $javascript = 'popup_window.js';

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
