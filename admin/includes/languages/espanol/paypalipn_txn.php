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
define('TABLE_HEADING_PAYPALIPN_AMOUNT', 'Monto');
define('TABLE_HEADING_PAYPALIPN_RESULT', 'Resultado');
define('TABLE_HEADING_PAYPALIPN_DATE', 'Fecha');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_HEADING_VIEW_PAYPALIPN_TRANSACTIONS', 'Detalles de la Transacción');
define('TEXT_HEADING_DELETE_PAYPALIPN_TRANSACTIONS', 'Eliminar Transacción');

define('TEXT_DELETE_INTRO', 'Seguro que desea eliminar esta transacción?');
?>