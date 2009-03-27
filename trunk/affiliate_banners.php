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



  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_BANNERS);



  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_AFFILIATE_BANNERS));



  $affiliate_banners_values = escs_db_query("select * from " . TABLE_AFFILIATE_BANNERS . " order by affiliate_banners_title");



  $content = affiliate_banners;



  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);



  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>