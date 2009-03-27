<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

// define the content used in the project
  define('CONTENT_ACCOUNT', 'account');
  define('CONTENT_ACCOUNT_EDIT', 'account_edit');
  define('CONTENT_ACCOUNT_HISTORY', 'account_history');
  define('CONTENT_ACCOUNT_HISTORY_INFO', 'account_history_info');
  define('CONTENT_ACCOUNT_NEWSLETTERS', 'account_newsletters');
  define('CONTENT_ACCOUNT_NOTIFICATIONS', 'account_notifications');
  define('CONTENT_ACCOUNT_PASSWORD', 'account_password');
  define('CONTENT_ADDRESS_BOOK', 'address_book');
  define('CONTENT_ADDRESS_BOOK_PROCESS', 'address_book_process');
  define('CONTENT_ADVANCED_SEARCH', 'advanced_search');
  define('CONTENT_ADVANCED_SEARCH_RESULT', 'advanced_search_result');
  define('CONTENT_ALSO_PURCHASED_PRODUCTS', 'also_purchased_products');
  define('CONTENT_CHECKOUT_CONFIRMATION', 'checkout_confirmation');
  define('CONTENT_CHECKOUT_PAYMENT', 'checkout_payment');
  define('CONTENT_CHECKOUT_PAYMENT_ADDRESS', 'checkout_payment_address');
  define('CONTENT_CHECKOUT_SHIPPING', 'checkout_shipping');
  define('CONTENT_CHECKOUT_SHIPPING_ADDRESS', 'checkout_shipping_address');
  define('CONTENT_CHECKOUT_SUCCESS', 'checkout_success');
  define('CONTENT_CONTACT_US', 'contact_us');
  define('CONTENT_CONDITIONS', 'conditions');
  define('CONTENT_COOKIE_USAGE', 'cookie_usage');
  define('CONTENT_CREATE_ACCOUNT', 'create_account');
  define('CONTENT_CREATE_ACCOUNT_SUCCESS', 'create_account_success');
  define('CONTENT_INDEX_DEFAULT', 'index_default');
  define('CONTENT_INDEX_NESTED', 'index_nested');
  define('CONTENT_INDEX_PRODUCTS', 'index_products');
  define('CONTENT_INFO_SHOPPING_CART', 'info_shopping_cart');
  define('CONTENT_LOGIN', 'login');
  define('CONTENT_LOGOFF', 'logoff');
  define('CONTENT_NEW_PRODUCTS', 'new_products');
  define('CONTENT_PASSWORD_FORGOTTEN', 'password_forgotten');
  define('CONTENT_POPUP_IMAGE', 'popup_image');
  define('CONTENT_POPUP_SEARCH_HELP', 'popup_search_help');
  define('CONTENT_PRIVACY', 'privacy');
  define('CONTENT_PRODUCT_INFO', 'product_info');
  define('CONTENT_PRODUCT_LISTING', 'product_listing');
  define('CONTENT_PRODUCT_REVIEWS', 'product_reviews');
  define('CONTENT_PRODUCT_REVIEWS_INFO', 'product_reviews_info');
  define('CONTENT_PRODUCT_REVIEWS_WRITE', 'product_reviews_write');
  define('CONTENT_PRODUCTS_NEW', 'products_new');
  define('CONTENT_REVIEWS', 'reviews');
  define('CONTENT_SHIPPING', 'shipping');
  define('CONTENT_SHOPPING_CART', 'shopping_cart');
  define('CONTENT_SPECIALS', 'specials');
  define('CONTENT_SSL_CHECK', 'ssl_check');
  define('CONTENT_TELL_A_FRIEND', 'tell_a_friend');
  define('CONTENT_UPCOMING_PRODUCTS', 'upcoming_products');
  define('CONTENT_CHECKOUT_PROCESS', 'checkout_process');
  define('CONTENT_GV_FAQ', 'gv_faq');
  define('CONTENT_GV_REDEEM', 'gv_redeem');
  define('CONTENT_GV_SEND', 'gv_send');
  define('CONTENT_PRINTABLE_CATALOG', 'catalog_products_with_images');
  define('CONTENT_ALLPRODS', 'allprods');
  define('CONTENT_DOWN_FOR_MAINT', 'down_for_maintenance');

// MaxiDVD Added Line For WYSIWYG HTML Area: BOF
  define('FILENAME_DEFINE_MAINPAGE', 'mainpage.php');
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF

// define the filenames used in the project
  define('FILENAME_ACCOUNT', CONTENT_ACCOUNT . '.php');
  define('FILENAME_ACCOUNT_EDIT', CONTENT_ACCOUNT_EDIT . '.php');
  define('FILENAME_ACCOUNT_HISTORY', CONTENT_ACCOUNT_HISTORY . '.php');
  define('FILENAME_ACCOUNT_HISTORY_INFO', CONTENT_ACCOUNT_HISTORY_INFO . '.php');
  define('FILENAME_ACCOUNT_NEWSLETTERS', CONTENT_ACCOUNT_NEWSLETTERS . '.php');
  define('FILENAME_ACCOUNT_NOTIFICATIONS', CONTENT_ACCOUNT_NOTIFICATIONS . '.php');
  define('FILENAME_ACCOUNT_PASSWORD', CONTENT_ACCOUNT_PASSWORD . '.php');
  define('FILENAME_ADDRESS_BOOK', CONTENT_ADDRESS_BOOK . '.php');
  define('FILENAME_ADDRESS_BOOK_PROCESS', CONTENT_ADDRESS_BOOK_PROCESS . '.php');
  define('FILENAME_ADVANCED_SEARCH', CONTENT_ADVANCED_SEARCH . '.php');
  define('FILENAME_ADVANCED_SEARCH_RESULT', CONTENT_ADVANCED_SEARCH_RESULT . '.php');
  define('FILENAME_ALSO_PURCHASED_PRODUCTS', CONTENT_ALSO_PURCHASED_PRODUCTS . '.php');
  define('FILENAME_CATALOG_PRODUCTS_WITH_IMAGES', 'catalog_products_with_images.php'); // CATALOG_PRODUCTS_WITH_IMAGES_mod
  define('FILENAME_CHECKOUT_CONFIRMATION', CONTENT_CHECKOUT_CONFIRMATION . '.php');
  define('FILENAME_CHECKOUT_PAYMENT', CONTENT_CHECKOUT_PAYMENT . '.php');
  define('FILENAME_CHECKOUT_PAYMENT_ADDRESS', CONTENT_CHECKOUT_PAYMENT_ADDRESS . '.php');
  define('FILENAME_CHECKOUT_PROCESS', CONTENT_CHECKOUT_PROCESS . '.php');
  define('FILENAME_CHECKOUT_SHIPPING', CONTENT_CHECKOUT_SHIPPING . '.php');
  define('FILENAME_CHECKOUT_SHIPPING_ADDRESS', CONTENT_CHECKOUT_SHIPPING_ADDRESS . '.php');
  define('FILENAME_CHECKOUT_SUCCESS', CONTENT_CHECKOUT_SUCCESS . '.php');
  define('FILENAME_CONTACT_US', CONTENT_CONTACT_US . '.php');
  define('FILENAME_CONDITIONS', CONTENT_CONDITIONS . '.php');
  define('FILENAME_COOKIE_USAGE', CONTENT_COOKIE_USAGE . '.php');
  define('FILENAME_CREATE_ACCOUNT', CONTENT_CREATE_ACCOUNT . '.php');
  define('FILENAME_CREATE_ACCOUNT_SUCCESS', CONTENT_CREATE_ACCOUNT_SUCCESS . '.php');
  define('FILENAME_DEFAULT', 'index.php');
  define('FILENAME_DEFAULT_SPECIALS', 'default_specials.php');
  define('FILENAME_DOWNLOAD', 'download.php');
  define('FILENAME_INFO_SHOPPING_CART', CONTENT_INFO_SHOPPING_CART . '.php');
  define('FILENAME_LOGIN', CONTENT_LOGIN . '.php');
  define('FILENAME_LOGOFF', CONTENT_LOGOFF . '.php');
  define('FILENAME_NEW_PRODUCTS', CONTENT_NEW_PRODUCTS . '.php');
  define('FILENAME_PASSWORD_FORGOTTEN', CONTENT_PASSWORD_FORGOTTEN . '.php');
  define('FILENAME_POPUP_IMAGE', CONTENT_POPUP_IMAGE . '.php');
  define('FILENAME_POPUP_SEARCH_HELP', CONTENT_POPUP_SEARCH_HELP . '.php');
  define('FILENAME_PRIVACY', CONTENT_PRIVACY . '.php');
  define('FILENAME_PRODUCT_INFO', CONTENT_PRODUCT_INFO . '.php');
  define('FILENAME_PRODUCT_LISTING', CONTENT_PRODUCT_LISTING . '.php');
  define('FILENAME_PRODUCT_REVIEWS', CONTENT_PRODUCT_REVIEWS . '.php');
  define('FILENAME_PRODUCT_REVIEWS_INFO', CONTENT_PRODUCT_REVIEWS_INFO . '.php');
  define('FILENAME_PRODUCT_REVIEWS_WRITE', CONTENT_PRODUCT_REVIEWS_WRITE . '.php');
  define('FILENAME_PRODUCTS_NEW', CONTENT_PRODUCTS_NEW . '.php');
  define('FILENAME_REDIRECT', 'redirect.php');
  define('FILENAME_REVIEWS', CONTENT_REVIEWS . '.php');
  define('FILENAME_SHIPPING', CONTENT_SHIPPING . '.php');
  define('FILENAME_SHOPPING_CART', CONTENT_SHOPPING_CART . '.php');
  define('FILENAME_SPECIALS', CONTENT_SPECIALS . '.php');
  define('FILENAME_SSL_CHECK', CONTENT_SSL_CHECK . '.php');
  define('FILENAME_TELL_A_FRIEND', CONTENT_TELL_A_FRIEND . '.php');
  define('FILENAME_UPCOMING_PRODUCTS', CONTENT_UPCOMING_PRODUCTS . '.php');
  define('FILENAME_CHECKOUT_PAYPALIPN', 'checkout_paypalipn.php'); // PAYPALIPN

// Lango and PopioWeb added for Affiliate Mod: BOF
  define('CONTENT_AFFILIATE', 'affiliate_affiliate');
  define('CONTENT_AFFILIATE', 'affiliate_banners');
  define('CONTENT_AFFILIATE', 'affiliate_clicks');
  define('CONTENT_AFFILIATE', 'affiliate_contact');
  define('CONTENT_AFFILIATE', 'affiliate_details');
  define('CONTENT_AFFILIATE', 'affiliate_details_ok');
  define('CONTENT_AFFILIATE', 'affiliate_faq');
  define('CONTENT_AFFILIATE', 'affiliate_info');
  define('CONTENT_AFFILIATE', 'affiliate_logout');
  define('CONTENT_AFFILIATE', 'affiliate_password_forgotten');
  define('CONTENT_AFFILIATE', 'affiliate_payment');
  define('CONTENT_AFFILIATE', 'affiliate_sales');
  define('CONTENT_AFFILIATE', 'affiliate_show_banner');
  define('CONTENT_AFFILIATE', 'affiliate_signup');
  define('CONTENT_AFFILIATE', 'affiliate_signup_ok');
  define('CONTENT_AFFILIATE', 'affiliate_summary');
  define('CONTENT_AFFILIATE', 'affiliate_terms');

// Added for Xsell Products Mod
  define('FILENAME_XSELL_PRODUCTS', 'xsell_products.php');
  define('FILENAME_PRODUCT_LISTING_COL', 'product_listing_col.php');
//BEGIN allprods modification
define('FILENAME_ALLPRODS', 'allprods.php');
//END allprods modification
  define('FILENAME_DYNAMIC_MOPICS', 'dynamic_mopics.php');

// define the templatenames used in the project
  define('TEMPLATENAME_BOX', 'box.tpl.php');
  define('TEMPLATENAME_MAIN_PAGE', 'main_page.tpl.php');
  define('TEMPLATENAME_POPUP', 'popup.tpl.php');
  define('TEMPLATENAME_STATIC', 'static.tpl.php');

  // begin live support mod
  define('FILENAME_LIVE_SUPPORT', "javascript:void(0);\" onclick=\"window.open('live_support.php','livesupport','width=280,height=280') ");
  define('FILENAME_LS_COMM_EXIT', 'ls_comm_exit.php');
  define('FILENAME_LS_COMM_MAIN', 'ls_comm_main.php');
  define('FILENAME_LS_COMM_TOP', 'ls_comm_top.php');
  define('FILENAME_LS_EXIT', 'ls_exit.php');
  define('FILENAME_LS_INFOBAR', 'ls_infobar.php');
  define('FILENAME_LS_START', 'ls_start.php');
  // Control options for Live Support
  // Colors Available blue, green, red, white, yellow
  // Archive: set to false to delete conversation when user leaves
  define('LS_COLOR', 'white');
  define('LS_ARCHIVE', 'false');
  // end live support mod

?>