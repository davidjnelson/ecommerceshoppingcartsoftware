<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGOFF);

  $breadcrumb->add(NAVBAR_TITLE);

  escs_session_unregister('customer_id');
  escs_session_unregister('customer_default_address_id');
  escs_session_unregister('customer_first_name');
  escs_session_unregister('customer_country_id');
  escs_session_unregister('customer_zone_id');
  escs_session_unregister('comments');
//ICW - logout -> unregister GIFT VOUCHER sessions - Thanks Fredrik
  escs_session_unregister('gv_id');
  escs_session_unregister('cc_id');
//ICW - logout -> unregister GIFT VOUCHER sessions  - Thanks Fredrik
  $cart->reset();

  $content = CONTENT_LOGOFF;

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>