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



  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_PAYMENT);



  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_AFFILIATE_PAYMENT, '', 'SSL'));



  $affiliate_payment_raw = "

    select p.* , s.affiliate_payment_status_name

           from " . TABLE_AFFILIATE_PAYMENT . " p, " . TABLE_AFFILIATE_PAYMENT_STATUS . " s

           where p.affiliate_payment_status = s.affiliate_payment_status_id

           and s.affiliate_language_id = '" . $languages_id . "'

           and p.affiliate_id =  '" . $affiliate_id . "'

           order by p.affiliate_payment_id DESC

           ";



  $affiliate_payment_split = new splitPageResults($affiliate_payment_raw, MAX_DISPLAY_SEARCH_RESULTS);



  $content = affiliate_payment;



  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);



  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>