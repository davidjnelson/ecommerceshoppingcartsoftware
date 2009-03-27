<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

//Admin begin
  define('FILENAME_ADMIN_ACCOUNT', 'admin_account.php');
  define('FILENAME_ADMIN_FILES', 'admin_files.php');
  define('FILENAME_ADMIN_MEMBERS', 'admin_members.php');
  Define('FILENAME_FORBIDEN', 'forbiden.php');
  define('FILENAME_LOGIN', 'login.php');
  define('FILENAME_LOGOFF', 'logoff.php');
  define('FILENAME_PASSWORD_FORGOTTEN', 'password_forgotten.php');
//Admin end

// MaxiDVD Added Line For WYSIWYG HTML Area: BOF
  define('FILENAME_DEFINE_MAINPAGE', 'define_mainpage.php');
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF

// define the filenames used in the project
  define('FILENAME_BACKUP', 'backup.php');
  define('FILENAME_BANNER_MANAGER', 'banner_manager.php');
  define('FILENAME_BANNER_STATISTICS', 'banner_statistics.php');
  define('FILENAME_CACHE', 'cache.php');
  define('FILENAME_CATALOG_ACCOUNT_HISTORY_INFO', 'account_history_info.php');
  define('FILENAME_CATEGORIES', 'categories.php');
  define('FILENAME_CONFIGURATION', 'configuration.php');
  define('FILENAME_COUNTRIES', 'countries.php');
  define('FILENAME_CURRENCIES', 'currencies.php');
  define('FILENAME_CUSTOMERS', 'customers.php');
  define('FILENAME_DEFAULT', 'index.php');
  define('FILENAME_DEFINE_LANGUAGE', 'define_language.php');
  define('FILENAME_FILE_MANAGER', 'file_manager.php');
  define('FILENAME_GEO_ZONES', 'geo_zones.php');
  define('FILENAME_LANGUAGES', 'languages.php');
  define('FILENAME_MAIL', 'mail.php');
  define('FILENAME_MANUFACTURERS', 'manufacturers.php');
  define('FILENAME_MODULES', 'modules.php');
  define('FILENAME_NEW_ATTRIBUTES', 'new_attributes.php');
  define('FILENAME_NEWSLETTERS', 'newsletters.php');
  define('FILENAME_ORDERS', 'orders.php');
  define('FILENAME_ORDERS_INVOICE', 'invoice.php');
  define('FILENAME_ORDERS_PACKINGSLIP', 'packingslip.php');
  define('FILENAME_ORDERS_STATUS', 'orders_status.php');
  define('FILENAME_POPUP_IMAGE', 'popup_image.php');
  define('FILENAME_PRODUCTS_ATTRIBUTES', 'products_attributes.php');
  define('FILENAME_PRODUCTS_EXPECTED', 'products_expected.php');
  define('FILENAME_REVIEWS', 'reviews.php');
  define('FILENAME_SERVER_INFO', 'server_info.php');
  define('FILENAME_SHIPPING_MODULES', 'shipping_modules.php');
  define('FILENAME_SPECIALS', 'specials.php');
  define('FILENAME_STATS_CUSTOMERS', 'stats_customers.php');
  define('FILENAME_STATS_PRODUCTS_PURCHASED', 'stats_products_purchased.php');
  define('FILENAME_STATS_PRODUCTS_VIEWED', 'stats_products_viewed.php');
  define('FILENAME_TAX_CLASSES', 'tax_classes.php');
  define('FILENAME_TAX_RATES', 'tax_rates.php');
  define('FILENAME_WHOS_ONLINE', 'whos_online.php');
  define('FILENAME_ZONES', 'zones.php');
  define('FILENAME_PAYPALIPN_TRANSACTIONS', 'paypalipn_txn.php'); // PAYPALIPN
  define('FILENAME_PAYPALIPN_TESTS', 'paypalipn_tests.php'); // PAYPALIPN
  define('FILENAME_XSELL_PRODUCTS', 'xsell_products.php'); // X-Sell
  define('FILENAME_EASYPOPULATE', 'easypopulate.php');
  define('FILENAME_EDIT_ORDERS', 'edit_orders.php');

  // begin live support mod
  define('FILENAME_LIVE_SUPPORT', 'live_support.php');
  define('FILENAME_LS_ANSWERCALL', 'ls_answercall.php');
  define('FILENAME_LS_CALLWAITING', 'ls_callwaiting.php');
  define('FILENAME_LS_COMM_EXIT', 'ls_comm_exit.php');
  define('FILENAME_LS_COMM_MAIN', 'ls_comm_main.php');
  define('FILENAME_LS_COMM_TOP', 'ls_comm_top.php');
  define('FILENAME_LS_COMMWINDOW', 'ls_commwindow.php');
  define('FILENAME_LS_EXIT', 'ls_exit.php');
  define('FILENAME_LS_HANGUP', 'ls_hangup.php');
  define('FILENAME_LS_INFOBAR', 'ls_infobar.php');
  define('FILENAME_LS_MESSAGES', 'ls_messages.php');
  define('FILENAME_LS_NEWCALL', 'ls_newcall.php');
  define('FILENAME_LS_RESET', 'ls_reset.php');
  define('FILENAME_LS_SESSION_CLOSE', 'ls_session_close.php');
  define('FILENAME_LS_START', 'ls_start.php');
  // Control options for Live Support
  // Colors Available blue, green, red, white, yellow
  // Archive: set to false to delete conversation when user leaves
  // warning set what warning you wish to use:
  //   include the name of the .wav or .midi file and be sure to upload to the live_support folder
  define('LS_COLOR', 'white');
  define('LS_ARCHIVE', 'false');
  define('LS_WARNING', 'warning.wav');
  // end live support mod
?>