<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  function escs_update_whos_online() {
    global $customer_id;

    if (escs_session_is_registered('customer_id')) {
      $wo_customer_id = $customer_id;

      $customer_query = escs_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
      $customer = escs_db_fetch_array($customer_query);

      $wo_full_name = $customer['customers_firstname'] . ' ' . $customer['customers_lastname'];
    } else {
      $wo_customer_id = '';
      $wo_full_name = 'Guest';
    }

    $wo_session_id = escs_session_id();
    $wo_ip_address = getenv('REMOTE_ADDR');
    $wo_last_page_url = getenv('REQUEST_URI');

    $current_time = time();
    $xx_mins_ago = ($current_time - 900);

// remove entries that have expired
    escs_db_query("delete from " . TABLE_WHOS_ONLINE . " where time_last_click < '" . $xx_mins_ago . "'");

    $stored_customer_query = escs_db_query("select count(*) as count from " . TABLE_WHOS_ONLINE . " where session_id = '" . escs_db_input($wo_session_id) . "'");
    $stored_customer = escs_db_fetch_array($stored_customer_query);

    if ($stored_customer['count'] > 0) {
      escs_db_query("update " . TABLE_WHOS_ONLINE . " set customer_id = '" . (int)$wo_customer_id . "', full_name = '" . escs_db_input($wo_full_name) . "', ip_address = '" . escs_db_input($wo_ip_address) . "', time_last_click = '" . escs_db_input($current_time) . "', last_page_url = '" . escs_db_input($wo_last_page_url) . "' where session_id = '" . escs_db_input($wo_session_id) . "'");
    } else {
      escs_db_query("insert into " . TABLE_WHOS_ONLINE . " (customer_id, full_name, session_id, ip_address, time_entry, time_last_click, last_page_url) values ('" . (int)$wo_customer_id . "', '" . escs_db_input($wo_full_name) . "', '" . escs_db_input($wo_session_id) . "', '" . escs_db_input($wo_ip_address) . "', '" . escs_db_input($current_time) . "', '" . escs_db_input($current_time) . "', '" . escs_db_input($wo_last_page_url) . "')");
    }
  }
?>
