<?php
/*
  $Id: paypal_notify.php,v 0.981 2003-16-07 10:57:31 pablo_pasqualino Exp pablo_pasqualino $
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Paypal IPN v0.981 for Milestone 2
  Copyright (c) 2003 Pablo Pasqualino
  pablo_osc@osmosisdc.com
  http://www.osmosisdc.com

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Paypal IPN');

define('TABLE_HEADING_PAYPALIPN_TRANSACTIONS', 'TXN Id');
define('TABLE_HEADING_PAYPALIPN_AMOUNT', 'Amount');
define('TABLE_HEADING_PAYPALIPN_RESULT', 'Result');
define('TABLE_HEADING_PAYPALIPN_DATE', 'Date');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_HEADING_VIEW_PAYPALIPN_TRANSACTIONS', 'Transaction Details');
define('TEXT_HEADING_DELETE_PAYPALIPN_TRANSACTIONS', 'Delete Transaction');

define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this transaction?');
?>