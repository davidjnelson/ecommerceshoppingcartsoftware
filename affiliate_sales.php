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



  require('includes/application_top.php');



  if (!escs_session_is_registered('affiliate_id')) {

    $navigation->set_snapshot();

    escs_redirect(escs_href_link(FILENAME_AFFILIATE, '', 'SSL'));

  }



  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_SALES);



  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_AFFILIATE_SALES, '', 'SSL'));



  $affiliate_sales_raw = "

    select  a.*, o.orders_status as orders_status_id, os.orders_status_name as orders_status from " . TABLE_AFFILIATE_SALES . " a

    left join " . TABLE_ORDERS . " o on (a.affiliate_orders_id = o.orders_id)

    left join " . TABLE_ORDERS_STATUS . " os on (o.orders_status = os.orders_status_id and language_id = '" . $languages_id . "')

    where a.affiliate_id = '" . $affiliate_id . "'

    order by affiliate_date DESC

    ";



  $affiliate_sales_split = new splitPageResults($affiliate_sales_raw, MAX_DISPLAY_SEARCH_RESULTS);



  $content = affiliate_sales;



  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);



  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>