<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

////
// Sets the status of a special product
  function escs_set_specials_status($specials_id, $status) {
    return escs_db_query("update " . TABLE_SPECIALS . " set status = '" . $status . "', date_status_change = now() where specials_id = '" . (int)$specials_id . "'");
  }

////
// Auto expire products on special
  function escs_expire_specials() {
    $specials_query = escs_db_query("select specials_id from " . TABLE_SPECIALS . " where status = '1' and now() >= expires_date and expires_date > 0");
    if (escs_db_num_rows($specials_query)) {
      while ($specials = escs_db_fetch_array($specials_query)) {
        escs_set_specials_status($specials['specials_id'], '0');
      }
    }
  }
?>