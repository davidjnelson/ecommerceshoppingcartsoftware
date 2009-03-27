<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!escs_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    escs_redirect(escs_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $product_info_query = escs_db_query("select p.products_id, p.products_model, p.products_image, p.products_price, p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
  if (!escs_db_num_rows($product_info_query)) {
    escs_redirect(escs_href_link(FILENAME_PRODUCT_REVIEWS, escs_get_all_get_params(array('action'))));
  } else {
    $product_info = escs_db_fetch_array($product_info_query);
  }

  $customer_query = escs_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $customer = escs_db_fetch_array($customer_query);

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
    $rating = escs_db_prepare_input($HTTP_POST_VARS['rating']);
    $review = escs_db_prepare_input($HTTP_POST_VARS['review']);

    $error = false;
    if (strlen($review) < REVIEW_TEXT_MIN_LENGTH) {
      $error = true;

      $messageStack->add('review', JS_REVIEW_TEXT);
    }

    if (($rating < 1) || ($rating > 5)) {
      $error = true;

      $messageStack->add('review', JS_REVIEW_RATING);
    }

    if ($error == false) {
      escs_db_query("insert into " . TABLE_REVIEWS . " (products_id, customers_id, customers_name, reviews_rating, date_added) values ('" . (int)$HTTP_GET_VARS['products_id'] . "', '" . (int)$customer_id . "', '" . escs_db_input($customer['customers_firstname']) . ' ' . escs_db_input($customer['customers_lastname']) . "', '" . escs_db_input($rating) . "', now())");
      $insert_id = escs_db_insert_id();

      escs_db_query("insert into " . TABLE_REVIEWS_DESCRIPTION . " (reviews_id, languages_id, reviews_text) values ('" . (int)$insert_id . "', '" . (int)$languages_id . "', '" . escs_db_input($review) . "')");

      escs_redirect(escs_href_link(FILENAME_PRODUCT_REVIEWS, escs_get_all_get_params(array('action'))));
    }
  }

  if ($new_price = escs_get_products_special_price($product_info['products_id'])) {
    $products_price = '<s>' . $currencies->display_price($product_info['products_price'], escs_get_tax_rate($product_info['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, escs_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
  } else {
    $products_price = $currencies->display_price($product_info['products_price'], escs_get_tax_rate($product_info['products_tax_class_id']));
  }

  if (escs_not_null($product_info['products_model'])) {
    $products_name = $product_info['products_name'] . '<br><span class="smallText">[' . $product_info['products_model'] . ']</span>';
  } else {
    $products_name = $product_info['products_name'];
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_REVIEWS_WRITE);

  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_PRODUCT_REVIEWS, escs_get_all_get_params()));

  $content = CONTENT_PRODUCT_REVIEWS_WRITE;
  $javascript = $content . '.js';

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
