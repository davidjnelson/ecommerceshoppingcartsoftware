<?php
/*
  Contribution by Emmanuel Alliel <manu@maboutique.biz>

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  class paybox {
    var $code, $title, $description, $enabled;

// class constructor
    function paybox() {
      global $order;

      $this->code = 'paybox';
      $this->title = MODULE_PAYMENT_PAYBOX_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_PAYBOX_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_PAYBOX_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_PAYBOX_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_PAYBOX_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_PAYBOX_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url = MODULE_PAYMENT_PAYBOX_CGI;
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PAYBOX_ZONE > 0) ) {
        $check_flag = false;
        $check_query = escs_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAYBOX_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = escs_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return false;
    }

    function process_button() {
      global $order;

      $process_button_string = escs_draw_hidden_field('IBS_MODE', '1') .
                               escs_draw_hidden_field('IBS_SITE', '1999888') .
                               escs_draw_hidden_field('IBS_RANG', '99') .
                               escs_draw_hidden_field('IBS_TOTAL', $order->info['total'] * 100) .
                               escs_draw_hidden_field('IBS_DEVISE', '978') .
                       	       escs_draw_hidden_field('IBS_CMD', $order->customer['email_address'] . '|' . $order->info['total']) .
	                       escs_draw_hidden_field('IBS_PORTEUR', $order->customer['email_address']) .
                               escs_draw_hidden_field('IBS_RETOUR', 'IBS_TOTAL:M;IBS_CMD:R;auto:A;trans:T') .
	escs_draw_hidden_field('IBS_ANNULE', escs_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'NONSSL', true)) .
	escs_draw_hidden_field('IBS_REFUSE', escs_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'NONSSL', true)) .
                               escs_draw_hidden_field('IBS_EFFECTUE', escs_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', false)) .
                               escs_draw_hidden_field(escs_session_name(), escs_session_id()) .
                               escs_draw_hidden_field('options', 'test_status=' . $test_status . ',dups=false,cb_post=true,cb_flds=' . escs_session_name());

      return $process_button_string;
    }

    function before_process() {
      global $HTTP_POST_VARS;

      if ($HTTP_POST_VARS['valid'] == 'true') {
        if ($remote_host = getenv('REMOTE_HOST')) {
          if ($remote_host != 'paybox.com') {
            $remote_host = gethostbyaddr($remote_host);
          }
          if ($remote_host != 'paybox.com') {
            escs_redirect(escs_href_link(FILENAME_CHECKOUT_PAYMENT, escs_session_name() . '=' . $HTTP_POST_VARS[escs_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));
          }
        } else {
          escs_redirect(escs_href_link(FILENAME_CHECKOUT_PAYMENT, escs_session_name() . '=' . $HTTP_POST_VARS[escs_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));
        }
      }
    }

    function after_process() {
      return false;
    }

    function get_error() {
      global $HTTP_GET_VARS;

      if (isset($HTTP_GET_VARS['message']) && (strlen($HTTP_GET_VARS['message']) > 0)) {
        $error = stripslashes(urldecode($HTTP_GET_VARS['message']));
      } else {
        $error = MODULE_PAYMENT_PAYBOX_TEXT_ERROR_MESSAGE;
      }

      return array('title' => MODULE_PAYMENT_PAYBOX_TEXT_ERROR,
                   'error' => $error);
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = escs_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYBOX_STATUS'");
        $this->_check = escs_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Paybox Module', 'MODULE_PAYMENT_PAYBOX_STATUS', 'True', 'Activer ce module Paybox ?', '6', '1', 'escs_cfg_select_option(array(\'True\', \'False\'), ', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('IBS_SITE', 'MODULE_PAYMENT_PAYBOX_IBS_SITE', '1999888', 'IBS_SITE fournit par Paybox', '6', '2', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('IBS_RANG', 'MODULE_PAYMENT_PAYBOX_IBS_RANG', '99', 'IBS_RANG fournit par Paybox', '6', '3', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CGI Path', 'MODULE_PAYMENT_PAYBOX_CGI', 'http://www.maboutique.biz/cgi-bin/paybox.cgi', 'Chemin de votre module CGI fournit par Paybox', '6', '4', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYBOX_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYBOX_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'escs_get_zone_class_title', 'escs_cfg_pull_down_zone_classes(', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PAYBOX_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'escs_cfg_pull_down_order_statuses(', 'escs_get_order_status_name', now())");
    }

    function remove() {
      escs_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_PAYBOX_STATUS', 'MODULE_PAYMENT_PAYBOX_IBS_SITE', 'MODULE_PAYMENT_PAYBOX_IBS_RANG', 'MODULE_PAYMENT_PAYBOX_CGI', 'MODULE_PAYMENT_PAYBOX_ZONE', 'MODULE_PAYMENT_PAYBOX_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYBOX_SORT_ORDER');
    }
  }
?>
