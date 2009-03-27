<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  OSC-Affiliate

  Contribution based on:

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

// Set the local configuration parameters - mainly for developers
  if (file_exists(DIR_WS_INCLUDES . 'local/affiliate_configure.php')) include(DIR_WS_INCLUDES . 'local/affiliate_configure.php');

  require(DIR_WS_INCLUDES . 'affiliate_configure.php');
  require(DIR_WS_FUNCTIONS . 'affiliate_functions.php');

  define('FILENAME_AFFILIATE', 'affiliate_affiliates.php');
  define('FILENAME_AFFILIATE_BANNERS', 'affiliate_banners.php');
  define('FILENAME_AFFILIATE_BANNER_MANAGER', 'affiliate_banners.php');
  define('FILENAME_AFFILIATE_CLICKS', 'affiliate_clicks.php');
  define('FILENAME_AFFILIATE_CONTACT', 'affiliate_contact.php');
  define('FILENAME_AFFILIATE_HELP_1', 'affiliate_help1.php');
  define('FILENAME_AFFILIATE_HELP_2', 'affiliate_help2.php');
  define('FILENAME_AFFILIATE_HELP_3', 'affiliate_help3.php');
  define('FILENAME_AFFILIATE_HELP_4', 'affiliate_help4.php');
  define('FILENAME_AFFILIATE_HELP_5', 'affiliate_help5.php');
  define('FILENAME_AFFILIATE_HELP_6', 'affiliate_help6.php');
  define('FILENAME_AFFILIATE_HELP_7', 'affiliate_help7.php');
  define('FILENAME_AFFILIATE_HELP_8', 'affiliate_help8.php');
  define('FILENAME_AFFILIATE_INVOICE', 'affiliate_invoice.php');
  define('FILENAME_AFFILIATE_PAYMENT', 'affiliate_payment.php');
  define('FILENAME_AFFILIATE_POPUP_IMAGE', 'affiliate_popup_image.php');
  define('FILENAME_AFFILIATE_SALES', 'affiliate_sales.php');
  define('FILENAME_AFFILIATE_STATISTICS', 'affiliate_statistics.php');
  define('FILENAME_AFFILIATE_SUMMARY', 'affiliate_summary.php');
  define('FILENAME_AFFILIATE_RESET', 'affiliate_reset.php');
  define('FILENAME_CATALOG_AFFILIATE_PAYMENT_INFO','affiliate_payment.php');
  define('FILENAME_CATALOG_PRODUCT_INFO', 'product_info.php');

  define('TABLE_AFFILIATE', 'affiliate_affiliate');
  define('TABLE_AFFILIATE_BANNERS', 'affiliate_banners');
  define('TABLE_AFFILIATE_BANNERS_HISTORY', 'affiliate_banners_history');
  define('TABLE_AFFILIATE_CLICKTHROUGHS', 'affiliate_clickthroughs');
  define('TABLE_AFFILIATE_PAYMENT', 'affiliate_payment');
  define('TABLE_AFFILIATE_PAYMENT_STATUS', 'affiliate_payment_status');
  define('TABLE_AFFILIATE_PAYMENT_STATUS_HISTORY', 'affiliate_payment_status_history');
  define('TABLE_AFFILIATE_SALES', 'affiliate_sales');
  define('TABLE_PRODUCTS_XSELL', 'products_xsell'); //X-Sell

// include the language translations
  require(DIR_WS_LANGUAGES . 'affiliate_' . $language . '.php');

// If an order is deleted delete the sale too (optional)
  if ($HTTP_GET_VARS['action'] == 'deleteconfirm' && basename($HTTP_SERVER_VARS['SCRIPT_FILENAME']) == FILENAME_ORDERS && AFFILIATE_DELETE_ORDERS == 'true') {
    $affiliate_oID = escs_db_prepare_input($HTTP_GET_VARS['oID']);
    escs_db_query("delete from " . TABLE_AFFILIATE_SALES . " where affiliate_orders_id = '" . escs_db_input($affiliate_oID) . "' and affiliate_billing_status != 1");
  }
?>