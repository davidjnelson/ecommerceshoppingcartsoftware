<?php
/*
   osCommerce 2.2 (Snapshot on November 10, 2002) Open Source E-Commerce Solutions
   Authorizenet ADC Direct Connection
   Last Update: November 10, 2002
   Author: Bao Nguyen
   Email: baonguyenx@yahoo.com

   Update: August 13, 2003
   Added: Transaction Key, Sort Order
   Author: Austin Renfroe (Austin519)
   Email: Austin519@aol.com
*/

  class authorizenet {
    var $code, $title, $description, $enabled;

// class constructor
    function authorizenet() {
      $this->code = 'authorizenet';
      $this->title = MODULE_PAYMENT_AUTHORIZENET_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION;
      $this->enabled = ((MODULE_PAYMENT_AUTHORIZENET_STATUS == 'True') ? true : false);

	// Austin519 - added sort order
      $this->sort_order = MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER;

	// Change made by using ADC Direct Connection
      $this->form_action_url = escs_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', false);
    }

// class methods
    function javascript_validation() {
      $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
            '    var cc_owner = document.checkout_payment.authorizenet_cc_owner.value;' . "\n" .
            '    var cc_number = document.checkout_payment.authorizenet_cc_number.value;' . "\n" .
            '    var cc_cvv = document.checkout_payment.cvv.value;' . "\n" .
            '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_cvv == "" || cc_cvv.length < "3") {' . "\n".
            '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_CVV . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '  }' . "\n";

      return $js;
    }

    function selection() {
      global $order;

      for ($i=1; $i<13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate();
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }

      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => escs_draw_input_field('authorizenet_cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => escs_draw_input_field('authorizenet_cc_number')),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => escs_draw_pull_down_menu('authorizenet_cc_expires_month', $expires_month) . '&nbsp;' . escs_draw_pull_down_menu('authorizenet_cc_expires_year', $expires_year)),
                                           array('title' => 'CVV number ' . ' ' .'<a href="cvv.html" target="_blank"><b><u> What is it?</u></b></a>',
                                                 'field' => escs_draw_input_field('cvv','',"SIZE=4, MAXLENGTH=4"))));
       return $selection;
    }

    function pre_confirmation_check() {
      global $HTTP_POST_VARS, $cvv;

      include(DIR_WS_CLASSES . 'cc_validation.php');

      $cc_validation = new cc_validation();

      $result = $cc_validation->validate($HTTP_POST_VARS['authorizenet_cc_number'], $HTTP_POST_VARS['authorizenet_cc_expires_month'], $HTTP_POST_VARS['authorizenet_cc_expires_year'], $HTTP_POST_VARS['cvv']);

      $error = '';
      switch ($result) {
        case -1:
          $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
          break;
        case -2:
        case -3:
        case -4:
          $error = TEXT_CCVAL_ERROR_INVALID_DATE;
          break;
        case false:
          $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
          break;
      }

      if ( ($result == false) || ($result < 1) ) {
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&authorizenet_cc_owner=' . urlencode($HTTP_POST_VARS['authorizenet_cc_owner']) . '&authorizenet_cc_expires_month=' . $HTTP_POST_VARS['authorizenet_cc_expires_month'] . '&authorizenet_cc_expires_year=' . $HTTP_POST_VARS['authorizenet_cc_expires_year'];

        escs_redirect(escs_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }

      $this->cc_card_type = $cc_validation->cc_type;
      $this->cc_card_number = $cc_validation->cc_number;
      $this->cc_expiry_month = $cc_validation->cc_expiry_month;
      $this->cc_expiry_year = $cc_validation->cc_expiry_year;
      $x_Card_Code = $HTTP_POST_VARS['cvv'];

    }

    function confirmation() {
      global $HTTP_POST_VARS, $x_Card_Code;
       $x_Card_Code=$HTTP_POST_VARS['cvv'];
       $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => 'CVV number',
                                                    'field' => $HTTP_POST_VARS['cvv']),
                                                    array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $HTTP_POST_VARS['authorizenet_cc_owner']),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$HTTP_POST_VARS['authorizenet_cc_expires_month'], 1, '20' . $HTTP_POST_VARS['authorizenet_cc_expires_year'])))));

      $x_Card_Code=$HTTP_POST_VARS['cvv'];


       return $confirmation;
    }

    function process_button() {

	   // Change made by using ADC Direct Connection
	        $x_Card_Code=$HTTP_POST_VARS['cvv'];


      $process_button_string = escs_draw_hidden_field('x_Card_Code', $HTTP_POST_VARS['cvv']) .
                               escs_draw_hidden_field('x_Card_Num', $this->cc_card_number) .
                               escs_draw_hidden_field('x_Exp_Date', $this->cc_expiry_month . substr($this->cc_expiry_year, -2));

      $process_button_string .= escs_draw_hidden_field(escs_session_name(), escs_session_id());

      return $process_button_string;
    }

    function before_process() {
	  global $response;

	  // Change made by using ADC Direct Connection
	  $response_vars = explode(',', $response[0]);
	  $x_response_code = $response_vars[0];

      if ($x_response_code != '1') {
        escs_redirect(escs_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE), 'SSL', true, false));
      }
    }

    function after_process() {
      return false;
    }

    function get_error() {
      global $HTTP_GET_VARS;

      $error = array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR,
                     'error' => stripslashes(urldecode($HTTP_GET_VARS['error'])));

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = escs_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_AUTHORIZENET_STATUS'");
        $this->_check = escs_db_num_rows($check_query);
      }
      return $this->_check;
    }

//Austin519 - added transaction key
    function install() {
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Authorize.net Module', 'MODULE_PAYMENT_AUTHORIZENET_STATUS', 'True', 'Do you want to accept Authorize.net payments?', '6', '0', 'escs_cfg_select_option(array(\'True\', \'False\'), ', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Login Username', 'MODULE_PAYMENT_AUTHORIZENET_LOGIN', 'Your Login Name', 'The login username used for the Authorize.net service', '6', '0', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Login Transaction Key', 'MODULE_PAYMENT_AUTHORIZENET_TRANSKEY', 'Your Transaction Key', 'The transaction key used for the Authorize.net service', '6', '0', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Mode', 'MODULE_PAYMENT_AUTHORIZENET_TESTMODE', 'Test', 'Transaction mode used for processing orders', '6', '0', 'escs_cfg_select_option(array(\'Test\', \'Production\'), ', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Method', 'MODULE_PAYMENT_AUTHORIZENET_METHOD', 'Credit Card', 'Transaction method used for processing orders', '6', '0', 'escs_cfg_select_option(array(\'Credit Card\', \'eCheck\'), ', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0' , now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Customer Notifications', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER', 'False', 'Should Authorize.Net e-mail a receipt to the customer?', '6', '0', 'escs_cfg_select_option(array(\'True\', \'False\'), ', now())");
      escs_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Merchant Notifications', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_MERCHANT', 'True', 'Should Authorize.Net e-mail a receipt to the store owner?', '6', '0', 'escs_cfg_select_option(array(\'True\', \'False\'), ', now())");
    }

    function remove() {
      $keys = '';
      $keys_array = $this->keys();
      for ($i=0; $i<sizeof($keys_array); $i++) {
        $keys .= "'" . $keys_array[$i] . "',";
      }
      $keys = substr($keys, 0, -1);

      escs_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")");
    }

//Austin519 - added transaction key
    function keys() {
      return array('MODULE_PAYMENT_AUTHORIZENET_STATUS', 'MODULE_PAYMENT_AUTHORIZENET_LOGIN', 'MODULE_PAYMENT_AUTHORIZENET_TRANSKEY', 'MODULE_PAYMENT_AUTHORIZENET_TESTMODE', 'MODULE_PAYMENT_AUTHORIZENET_METHOD', 'MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_MERCHANT');
    }
  }
?>