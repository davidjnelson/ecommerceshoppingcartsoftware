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



  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_SUMMARY);



  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_AFFILIATE_SUMMARY));



  $affiliate_banner_history_raw = "select sum(affiliate_banners_shown) as count from " . TABLE_AFFILIATE_BANNERS_HISTORY .  " where affiliate_banners_affiliate_id  = '" . $affiliate_id . "'";

  $affiliate_banner_history_query=escs_db_query($affiliate_banner_history_raw);

  $affiliate_banner_history = escs_db_fetch_array($affiliate_banner_history_query);

  $affiliate_impressions = $affiliate_banner_history['count'];

  if ($affiliate_impressions == 0) $affiliate_impressions="n/a";



  $affiliate_clickthroughs_raw = "select count(*) as count from " . TABLE_AFFILIATE_CLICKTHROUGHS . " where affiliate_id = '" . $affiliate_id . "'";

  $affiliate_clickthroughs_query = escs_db_query($affiliate_clickthroughs_raw);

  $affiliate_clickthroughs = escs_db_fetch_array($affiliate_clickthroughs_query);

  $affiliate_clickthroughs =$affiliate_clickthroughs['count'];



  $affiliate_sales_raw = "

			select count(*) as count, sum(affiliate_value) as total, sum(affiliate_payment) as payment from " . TABLE_AFFILIATE_SALES . " a

			left join " . TABLE_ORDERS . " o on (a.affiliate_orders_id=o.orders_id)

			where a.affiliate_id = '" . $affiliate_id . "' and o.orders_status >= " . AFFILIATE_PAYMENT_ORDER_MIN_STATUS . "

			";

  $affiliate_sales_query = escs_db_query($affiliate_sales_raw);

  $affiliate_sales = escs_db_fetch_array($affiliate_sales_query);



  $affiliate_transactions=$affiliate_sales['count'];

  if ($affiliate_clickthroughs > 0) {

	$affiliate_conversions = escs_round(($affiliate_transactions / $affiliate_clickthroughs)*100, 2) . "%";

  } else {

    $affiliate_conversions = "n/a";

  }

  $affiliate_amount = $affiliate_sales['total'];

  if ($affiliate_transactions>0) {

	$affiliate_average = escs_round($affiliate_amount / $affiliate_transactions, 2);

  } else {

	$affiliate_average = "n/a";

  }

  $affiliate_commission = $affiliate_sales['payment'];



  $affiliate_values = escs_db_query("select * from " . TABLE_AFFILIATE . " where affiliate_id = '" . $affiliate_id . "'");

  $affiliate = escs_db_fetch_array($affiliate_values);

  $affiliate_percent = 0;

  $affiliate_percent = $affiliate['affiliate_commission_percent'];

  if ($affiliate_percent < AFFILIATE_PERCENT) $affiliate_percent = AFFILIATE_PERCENT;



  $content = affiliate_summary;



  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);



  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>

