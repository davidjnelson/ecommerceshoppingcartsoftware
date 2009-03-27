<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  $error = false;
  $processed = false;

  if (escs_not_null($action)) {
    switch ($action) {
      case 'update':
        $customers_id = escs_db_prepare_input($HTTP_GET_VARS['cID']);
        $customers_firstname = escs_db_prepare_input($HTTP_POST_VARS['customers_firstname']);
        $customers_lastname = escs_db_prepare_input($HTTP_POST_VARS['customers_lastname']);
        $customers_email_address = escs_db_prepare_input($HTTP_POST_VARS['customers_email_address']);
        $customers_telephone = escs_db_prepare_input($HTTP_POST_VARS['customers_telephone']);
        $customers_fax = escs_db_prepare_input($HTTP_POST_VARS['customers_fax']);
        $customers_newsletter = escs_db_prepare_input($HTTP_POST_VARS['customers_newsletter']);
// ****** Begin Separate Price Per Customer *****
$multiple_groups_query = escs_db_query("select distinct customers_group_id from " . TABLE_PRODUCTS_GROUPS . " ");
while ($group_ids = escs_db_fetch_array($multiple_groups_query)) {
  $multiple_customers_query = escs_db_query("select distinct customers_group_id from " . TABLE_CUSTOMERS . " where customers_group_id = " . $group_ids['customers_group_id'] . " ");
  if (!($multiple_groups = escs_db_fetch_array($multiple_customers_query))) {
    escs_db_query("delete from " . TABLE_PRODUCTS_GROUPS . " where customers_group_id = '" . $group_ids['customers_group_id'] . "'");
  }
}

$customers_group_name = escs_db_prepare_input($HTTP_POST_VARS['customers_group_name']);
$counter = 0;
$assigned = 0;

$customers_group_name_query = escs_db_query("select distinct customers_group_name, customers_group_id from " . TABLE_CUSTOMERS . " order by customers_group_id");

while ($group_name_check = escs_db_fetch_array($customers_group_name_query)) {
	$counter = $group_name_check['customers_group_id'];

  if ($group_name_check['customers_group_name'] == $customers_group_name) {
    $customers_group_id = $group_name_check['customers_group_id'];
	$assigned = 1;
    break;
  }

  ++$counter;
}

if ($assigned == 0) {
  $customers_group_id = $counter;
}
// ****** End Separate Price Per Customer *****
        $customers_gender = escs_db_prepare_input($HTTP_POST_VARS['customers_gender']);
        $customers_dob = escs_db_prepare_input($HTTP_POST_VARS['customers_dob']);

        $default_address_id = escs_db_prepare_input($HTTP_POST_VARS['default_address_id']);
        $entry_street_address = escs_db_prepare_input($HTTP_POST_VARS['entry_street_address']);
        $entry_suburb = escs_db_prepare_input($HTTP_POST_VARS['entry_suburb']);
        $entry_postcode = escs_db_prepare_input($HTTP_POST_VARS['entry_postcode']);
        $entry_city = escs_db_prepare_input($HTTP_POST_VARS['entry_city']);
        $entry_country_id = escs_db_prepare_input($HTTP_POST_VARS['entry_country_id']);

        $entry_company = escs_db_prepare_input($HTTP_POST_VARS['entry_company']);
        $entry_state = escs_db_prepare_input($HTTP_POST_VARS['entry_state']);
        if (isset($HTTP_POST_VARS['entry_zone_id'])) $entry_zone_id = escs_db_prepare_input($HTTP_POST_VARS['entry_zone_id']);

        if (strlen($customers_firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
          $error = true;
          $entry_firstname_error = true;
        } else {
          $entry_firstname_error = false;
        }

        if (strlen($customers_lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
          $error = true;
          $entry_lastname_error = true;
        } else {
          $entry_lastname_error = false;
        }

        if (ACCOUNT_DOB == 'true') {
          if (checkdate(substr(escs_date_raw($customers_dob), 4, 2), substr(escs_date_raw($customers_dob), 6, 2), substr(escs_date_raw($customers_dob), 0, 4))) {
            $entry_date_of_birth_error = false;
          } else {
            $error = true;
            $entry_date_of_birth_error = true;
          }
        }

        if (strlen($customers_email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_email_address_error = true;
        } else {
          $entry_email_address_error = false;
        }

        if (!escs_validate_email($customers_email_address)) {
          $error = true;
          $entry_email_address_check_error = true;
        } else {
          $entry_email_address_check_error = false;
        }

        if (strlen($entry_street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_street_address_error = true;
        } else {
          $entry_street_address_error = false;
        }

        if (strlen($entry_postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
          $error = true;
          $entry_post_code_error = true;
        } else {
          $entry_post_code_error = false;
        }

        if (strlen($entry_city) < ENTRY_CITY_MIN_LENGTH) {
          $error = true;
          $entry_city_error = true;
        } else {
          $entry_city_error = false;
        }

        if ($entry_country_id == false) {
          $error = true;
          $entry_country_error = true;
        } else {
          $entry_country_error = false;
        }

        if (ACCOUNT_STATE == 'true') {
          if ($entry_country_error == true) {
            $entry_state_error = true;
          } else {
            $zone_id = 0;
            $entry_state_error = false;
            $check_query = escs_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$entry_country_id . "'");
            $check_value = escs_db_fetch_array($check_query);
            $entry_state_has_zones = ($check_value['total'] > 0);
            if ($entry_state_has_zones == true) {
              $zone_query = escs_db_query("select zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$entry_country_id . "' and zone_name = '" . escs_db_input($entry_state) . "'");
              if (escs_db_num_rows($zone_query) == 1) {
                $zone_values = escs_db_fetch_array($zone_query);
                $entry_zone_id = $zone_values['zone_id'];
              } else {
                $error = true;
                $entry_state_error = true;
              }
            } else {
              if ($entry_state == false) {
                $error = true;
                $entry_state_error = true;
              }
            }
         }
      }

      if (strlen($customers_telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
        $error = true;
        $entry_telephone_error = true;
      } else {
        $entry_telephone_error = false;
      }

      $check_email = escs_db_query("select customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . escs_db_input($customers_email_address) . "' and customers_id != '" . (int)$customers_id . "'");
      if (escs_db_num_rows($check_email)) {
        $error = true;
        $entry_email_address_exists = true;
      } else {
        $entry_email_address_exists = false;
      }

      if ($error == false) {

        $sql_data_array = array('customers_firstname' => $customers_firstname,
                                'customers_lastname' => $customers_lastname,
                                'customers_email_address' => $customers_email_address,
                                'customers_telephone' => $customers_telephone,
                                'customers_fax' => $customers_fax,
                                'customers_newsletter' => $customers_newsletter,
//Begin Separate Price per Customer
                                'customers_group_id' => $customers_group_id,
                                'customers_group_name' => $customers_group_name);
//End Separate Price per Customer

        if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $customers_gender;
        if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = escs_date_raw($customers_dob);

        escs_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "'");

        escs_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . (int)$customers_id . "'");

        if ($entry_zone_id > 0) $entry_state = '';

        $sql_data_array = array('entry_firstname' => $customers_firstname,
                                'entry_lastname' => $customers_lastname,
                                'entry_street_address' => $entry_street_address,
                                'entry_postcode' => $entry_postcode,
                                'entry_city' => $entry_city,
                                'entry_country_id' => $entry_country_id);

        if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $entry_company;
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $entry_suburb;

        if (ACCOUNT_STATE == 'true') {
          if ($entry_zone_id > 0) {
            $sql_data_array['entry_zone_id'] = $entry_zone_id;
            $sql_data_array['entry_state'] = '';
          } else {
            $sql_data_array['entry_zone_id'] = '0';
            $sql_data_array['entry_state'] = $entry_state;
          }
        }

        escs_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "' and address_book_id = '" . (int)$default_address_id . "'");

        escs_redirect(escs_href_link(FILENAME_CUSTOMERS, escs_get_all_get_params(array('cID', 'action')) . 'cID=' . $customers_id));

        } else if ($error == true) {
          $cInfo = new objectInfo($HTTP_POST_VARS);
          $processed = true;
        }

        break;
      case 'deleteconfirm':
        $customers_id = escs_db_prepare_input($HTTP_GET_VARS['cID']);

        if (isset($HTTP_POST_VARS['delete_reviews']) && ($HTTP_POST_VARS['delete_reviews'] == 'on')) {
          $reviews_query = escs_db_query("select reviews_id from " . TABLE_REVIEWS . " where customers_id = '" . (int)$customers_id . "'");
          while ($reviews = escs_db_fetch_array($reviews_query)) {
            escs_db_query("delete from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$reviews['reviews_id'] . "'");
          }

          escs_db_query("delete from " . TABLE_REVIEWS . " where customers_id = '" . (int)$customers_id . "'");
        } else {
          escs_db_query("update " . TABLE_REVIEWS . " set customers_id = null where customers_id = '" . (int)$customers_id . "'");
        }
//***** Begin Separate Price per Customer ******
$multiple_groups_query = escs_db_query("select distinct customers_group_id from " . TABLE_PRODUCTS_GROUPS . " ");
while ($group_ids = escs_db_fetch_array($multiple_groups_query)) {
  $multiple_customers_query = escs_db_query("select distinct customers_group_id from " . TABLE_CUSTOMERS . " where customers_group_id = " . $group_ids['customers_group_id'] . " ");
  if (!($multiple_groups = escs_db_fetch_array($multiple_customers_query))) {
    escs_db_query("delete from " . TABLE_PRODUCTS_GROUPS . " where customers_group_id = '" . $group_ids['customers_group_id'] . "'");
  }
}
//***** End Separate Price per Customer *****


        escs_db_query("delete from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customers_id . "'");
        escs_db_query("delete from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customers_id . "'");
        escs_db_query("delete from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customers_id . "'");
        escs_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customers_id . "'");
        escs_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customers_id . "'");
        escs_db_query("delete from " . TABLE_WHOS_ONLINE . " where customer_id = '" . (int)$customers_id . "'");

        escs_redirect(escs_href_link(FILENAME_CUSTOMERS, escs_get_all_get_params(array('cID', 'action'))));
        break;
      default:

//***** Begin Separate Price per Customer ******
//        $customers_query = escs_db_query("select c.customers_id, c.customers_gender, c.customers_firstname, c.customers_lastname, c.customers_dob, c.customers_email_address, a.entry_company, a.entry_street_address, a.entry_suburb, a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id, a.entry_country_id, c.customers_telephone, c.customers_fax, c.customers_newsletter, c.customers_default_address_id from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_default_address_id = a.address_book_id where a.customers_id = c.customers_id and c.customers_id = '" . (int)$HTTP_GET_VARS['cID'] . "'");
// algo begin ad tracker mod
$customers_query = escs_db_query("select c.customers_id, c.customers_gender, c.customers_firstname, c.customers_lastname, c.customers_dob, c.customers_email_address, c.customers_advertiser, a.entry_company, a.entry_street_address, a.entry_suburb, a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id, a.entry_country_id, c.customers_telephone, c.customers_fax, c.customers_newsletter, c.customers_group_name, c.customers_default_address_id, c.customers_advertiser from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_default_address_id = a.address_book_id where a.customers_id = c.customers_id and c.customers_id = '" . $HTTP_GET_VARS['cID'] . "'");
// end ad tracker mod
$existing_customers_query = escs_db_query("select distinct customers_group_name from " . TABLE_CUSTOMERS . " order by customers_group_id ");
//***** End Separate Price per Customer ******
        $customers = escs_db_fetch_array($customers_query);
        $cInfo = new objectInfo($customers);
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<?php
  if ($action == 'edit' || $action == 'update') {
?>
<script language="javascript"><!--

function check_form() {
  var error = 0;
  var error_message = "<?php echo JS_ERROR; ?>";

  var customers_firstname = document.customers.customers_firstname.value;
  var customers_lastname = document.customers.customers_lastname.value;
<?php if (ACCOUNT_COMPANY == 'true') echo 'var entry_company = document.customers.entry_company.value;' . "\n"; ?>
<?php if (ACCOUNT_DOB == 'true') echo 'var customers_dob = document.customers.customers_dob.value;' . "\n"; ?>
  var customers_email_address = document.customers.customers_email_address.value;
  var entry_street_address = document.customers.entry_street_address.value;
  var entry_postcode = document.customers.entry_postcode.value;
  var entry_city = document.customers.entry_city.value;
  var customers_telephone = document.customers.customers_telephone.value;

<?php if (ACCOUNT_GENDER == 'true') { ?>
  if (document.customers.customers_gender[0].checked || document.customers.customers_gender[1].checked) {
  } else {
    error_message = error_message + "<?php echo JS_GENDER; ?>";
    error = 1;
  }
<?php } ?>

  if (customers_firstname == "" || customers_firstname.length < <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_FIRST_NAME; ?>";
    error = 1;
  }

  if (customers_lastname == "" || customers_lastname.length < <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_LAST_NAME; ?>";
    error = 1;
  }

<?php if (ACCOUNT_DOB == 'true') { ?>
  if (customers_dob == "" || customers_dob.length < <?php echo ENTRY_DOB_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_DOB; ?>";
    error = 1;
  }
<?php } ?>

  if (customers_email_address == "" || customers_email_address.length < <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_EMAIL_ADDRESS; ?>";
    error = 1;
  }

  if (entry_street_address == "" || entry_street_address.length < <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_ADDRESS; ?>";
    error = 1;
  }

  if (entry_postcode == "" || entry_postcode.length < <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_POST_CODE; ?>";
    error = 1;
  }

  if (entry_city == "" || entry_city.length < <?php echo ENTRY_CITY_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_CITY; ?>";
    error = 1;
  }

<?php
  if (ACCOUNT_STATE == 'true') {
?>
  if (document.customers.elements['entry_state'].type != "hidden") {
    if (document.customers.entry_state.value == '' || document.customers.entry_state.value.length < <?php echo ENTRY_STATE_MIN_LENGTH; ?> ) {
       error_message = error_message + "<?php echo JS_STATE; ?>";
       error = 1;
    }
  }
<?php
  }
?>

  if (document.customers.elements['entry_country_id'].type != "hidden") {
    if (document.customers.entry_country_id.value == 0) {
      error_message = error_message + "<?php echo JS_COUNTRY; ?>";
      error = 1;
    }
  }

  if (customers_telephone == "" || customers_telephone.length < <?php echo ENTRY_TELEPHONE_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_TELEPHONE; ?>";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>
<?php
  }
?>
<script type="text/javascript" src="includes/browser.js">/************************************************ Jim's DHTML Menu v5.0- © Jim Salyer (jsalyer@REMOVETHISmchsi.com)* Visit Dynamic Drive: http://www.dynamicdrive.com for script and instructions* This notice must stay intact for use***********************************************/</script><script type="text/javascript" src="config.js"></script></head>
<body onload="init();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($action == 'edit' || $action == 'update') {
    $newsletter_array = array(array('id' => '1', 'text' => ENTRY_NEWSLETTER_YES),
                              array('id' => '0', 'text' => ENTRY_NEWSLETTER_NO));
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr><?php echo escs_draw_form('customers', FILENAME_CUSTOMERS, escs_get_all_get_params(array('action')) . 'action=update', 'post', 'onSubmit="return check_form();"') . escs_draw_hidden_field('default_address_id', $cInfo->customers_default_address_id); ?>
        <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
<?php
    if (ACCOUNT_GENDER == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_GENDER; ?></td>
            <td class="main">
<?php
    if ($error == true) {
      if ($entry_gender_error == true) {
        echo escs_draw_radio_field('customers_gender', 'm', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . escs_draw_radio_field('customers_gender', 'f', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . ENTRY_GENDER_ERROR;
      } else {
        echo ($cInfo->customers_gender == 'm') ? MALE : FEMALE;
        echo escs_draw_hidden_field('customers_gender');
      }
    } else {
      echo escs_draw_radio_field('customers_gender', 'm', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . escs_draw_radio_field('customers_gender', 'f', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . FEMALE;
    }
?></td>
          </tr>
<?php
    }
?>
          <tr>
            <td class="main"><?php echo ENTRY_FIRST_NAME; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_firstname_error == true) {
      echo escs_draw_input_field('customers_firstname', $cInfo->customers_firstname, 'maxlength="32"') . '&nbsp;' . ENTRY_FIRST_NAME_ERROR;
    } else {
      echo $cInfo->customers_firstname . escs_draw_hidden_field('customers_firstname');
    }
  } else {
    echo escs_draw_input_field('customers_firstname', $cInfo->customers_firstname, 'maxlength="32"', true);
  }
?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_lastname_error == true) {
      echo escs_draw_input_field('customers_lastname', $cInfo->customers_lastname, 'maxlength="32"') . '&nbsp;' . ENTRY_LAST_NAME_ERROR;
    } else {
      echo $cInfo->customers_lastname . escs_draw_hidden_field('customers_lastname');
    }
  } else {
    echo escs_draw_input_field('customers_lastname', $cInfo->customers_lastname, 'maxlength="32"', true);
  }
?></td>
          </tr>
<?php
    if (ACCOUNT_DOB == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_DATE_OF_BIRTH; ?></td>
            <td class="main">

<?php
    if ($error == true) {
      if ($entry_date_of_birth_error == true) {
        echo escs_draw_input_field('customers_dob', escs_date_short($cInfo->customers_dob), 'maxlength="10"') . '&nbsp;' . ENTRY_DATE_OF_BIRTH_ERROR;
      } else {
        echo $cInfo->customers_dob . escs_draw_hidden_field('customers_dob');
      }
    } else {
      echo escs_draw_input_field('customers_dob', escs_date_short($cInfo->customers_dob), 'maxlength="10"', true);
    }
?></td>
          </tr>
<?php
    }
?>
          <tr>
            <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_email_address_error == true) {
      echo escs_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR;
    } elseif ($entry_email_address_check_error == true) {
      echo escs_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
    } elseif ($entry_email_address_exists == true) {
      echo escs_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR_EXISTS;
    } else {
      echo $customers_email_address . escs_draw_hidden_field('customers_email_address');
    }
  } else {
    echo escs_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"', true);
  }
?></td>
          </tr>
        </table></td>
      </tr>
<?php
    if (ACCOUNT_COMPANY == 'true') {
?>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_COMPANY; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_COMPANY; ?></td>
            <td class="main">
<?php
    if ($error == true) {
      if ($entry_company_error == true) {
        echo escs_draw_input_field('entry_company', $cInfo->entry_company, 'maxlength="32"') . '&nbsp;' . ENTRY_COMPANY_ERROR;
      } else {
        echo $cInfo->entry_company . escs_draw_hidden_field('entry_company');
      }
    } else {
      echo escs_draw_input_field('entry_company', $cInfo->entry_company, 'maxlength="32"');
    }
?></td>
          </tr>
        </table></td>
      </tr>
<?php
    }
?>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_ADDRESS; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_street_address_error == true) {
      echo escs_draw_input_field('entry_street_address', $cInfo->entry_street_address, 'maxlength="64"') . '&nbsp;' . ENTRY_STREET_ADDRESS_ERROR;
    } else {
      echo $cInfo->entry_street_address . escs_draw_hidden_field('entry_street_address');
    }
  } else {
    echo escs_draw_input_field('entry_street_address', $cInfo->entry_street_address, 'maxlength="64"', true);
  }
?></td>
          </tr>
<?php
    if (ACCOUNT_SUBURB == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_SUBURB; ?></td>
            <td class="main">
<?php
    if ($error == true) {
      if ($entry_suburb_error == true) {
        echo escs_draw_input_field('suburb', $cInfo->entry_suburb, 'maxlength="32"') . '&nbsp;' . ENTRY_SUBURB_ERROR;
      } else {
        echo $cInfo->entry_suburb . escs_draw_hidden_field('entry_suburb');
      }
    } else {
      echo escs_draw_input_field('entry_suburb', $cInfo->entry_suburb, 'maxlength="32"');
    }
?></td>
          </tr>
<?php
    }
?>
          <tr>
            <td class="main"><?php echo ENTRY_POST_CODE; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_post_code_error == true) {
      echo escs_draw_input_field('entry_postcode', $cInfo->entry_postcode, 'maxlength="8"') . '&nbsp;' . ENTRY_POST_CODE_ERROR;
    } else {
      echo $cInfo->entry_postcode . escs_draw_hidden_field('entry_postcode');
    }
  } else {
    echo escs_draw_input_field('entry_postcode', $cInfo->entry_postcode, 'maxlength="8"', true);
  }
?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CITY; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_city_error == true) {
      echo escs_draw_input_field('entry_city', $cInfo->entry_city, 'maxlength="32"') . '&nbsp;' . ENTRY_CITY_ERROR;
    } else {
      echo $cInfo->entry_city . escs_draw_hidden_field('entry_city');
    }
  } else {
    echo escs_draw_input_field('entry_city', $cInfo->entry_city, 'maxlength="32"', true);
  }
?></td>
          </tr>
<?php
    if (ACCOUNT_STATE == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_STATE; ?></td>
            <td class="main">
<?php
    $entry_state = escs_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state);
    if ($error == true) {
      if ($entry_state_error == true) {
        if ($entry_state_has_zones == true) {
          $zones_array = array();
          $zones_query = escs_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . escs_db_input($cInfo->entry_country_id) . "' order by zone_name");
          while ($zones_values = escs_db_fetch_array($zones_query)) {
            $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
          }
          echo escs_draw_pull_down_menu('entry_state', $zones_array) . '&nbsp;' . ENTRY_STATE_ERROR;
        } else {
          echo escs_draw_input_field('entry_state', escs_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state)) . '&nbsp;' . ENTRY_STATE_ERROR;
        }
      } else {
        echo $entry_state . escs_draw_hidden_field('entry_zone_id') . escs_draw_hidden_field('entry_state');
      }
    } else {
      echo escs_draw_input_field('entry_state', escs_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state));
    }

?></td>
         </tr>
<?php
    }
?>
          <tr>
            <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_country_error == true) {
      echo escs_draw_pull_down_menu('entry_country_id', escs_get_countries(), $cInfo->entry_country_id) . '&nbsp;' . ENTRY_COUNTRY_ERROR;
    } else {
      echo escs_get_country_name($cInfo->entry_country_id) . escs_draw_hidden_field('entry_country_id');
    }
  } else {
    echo escs_draw_pull_down_menu('entry_country_id', escs_get_countries(), $cInfo->entry_country_id);
  }
?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_CONTACT; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_telephone_error == true) {
      echo escs_draw_input_field('customers_telephone', $cInfo->customers_telephone, 'maxlength="32"') . '&nbsp;' . ENTRY_TELEPHONE_NUMBER_ERROR;
    } else {
      echo $cInfo->customers_telephone . escs_draw_hidden_field('customers_telephone');
    }
  } else {
    echo escs_draw_input_field('customers_telephone', $cInfo->customers_telephone, 'maxlength="32"', true);
  }
?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_FAX_NUMBER; ?></td>
            <td class="main">
<?php
  if ($processed == true) {
    echo $cInfo->customers_fax . escs_draw_hidden_field('customers_fax');
  } else {
    echo escs_draw_input_field('customers_fax', $cInfo->customers_fax, 'maxlength="32"');
  }
?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_OPTIONS; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_NEWSLETTER; ?></td>
            <td class="main">
<?php
  if ($processed == true) {
    if ($cInfo->customers_newsletter == '1') {
      echo ENTRY_NEWSLETTER_YES;
    } else {
      echo ENTRY_NEWSLETTER_NO;
    }
    echo escs_draw_hidden_field('customers_newsletter');
  } else {
    echo escs_draw_pull_down_menu('customers_newsletter', $newsletter_array, (($cInfo->customers_newsletter == '1') ? '1' : '0'));
  }
?></td>
<tr>
  <td class="main"><?php echo ENTRY_CUSTOMERS_GROUP_NAME; ?></td>
  <td class="main"><?php echo escs_draw_input_field('customers_group_name', $cInfo->customers_group_name, 'maxlength="25"'); ?></td>
</tr>
<tr>
  <td class="main"><?php
  $index = 0;
  echo ("Existing Groups: ");
  while ($existing_customers =  escs_db_fetch_array($existing_customers_query)) {
    echo ($existing_customers['customers_group_name']);
    echo (", ");
    ++$index;
    if ($index%10 == 0) {
    echo ("&nbsp;");
    }
  }?>
  </td>
</tr>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo escs_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . escs_href_link(FILENAME_CUSTOMERS, escs_get_all_get_params(array('action'))) .'">' . escs_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr></form>
<?php
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr><?php echo escs_draw_form('search', FILENAME_CUSTOMERS, '', 'get'); ?>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . escs_draw_input_field('search'); ?></td>
          </form></tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LASTNAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FIRSTNAME; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACCOUNT_CREATED; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
                <!-- begin ad tracker mod-->
                <td class="dataTableHeadingContent"><?php echo 'Came From This Ad'; ?></td>
                <!-- end ad tracker mod-->
              </tr>
<?php
    $search = '';
    if (isset($HTTP_GET_VARS['search']) && escs_not_null($HTTP_GET_VARS['search'])) {
      $keywords = escs_db_input(escs_db_prepare_input($HTTP_GET_VARS['search']));
      $search = "where c.customers_lastname like '%" . $keywords . "%' or c.customers_firstname like '%" . $keywords . "%' or c.customers_email_address like '%" . $keywords . "%'";
    }
    $customers_query_raw = "select c.customers_id, c.customers_lastname, c.customers_firstname, c.customers_email_address, c.customers_advertiser, a.entry_country_id from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_id = a.customers_id and c.customers_default_address_id = a.address_book_id " . $search . " order by c.customers_lastname, c.customers_firstname";
    $customers_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $customers_query_raw, $customers_query_numrows);
    $customers_query = escs_db_query($customers_query_raw);
    while ($customers = escs_db_fetch_array($customers_query)) {
      $info_query = escs_db_query("select customers_info_date_account_created as date_account_created, customers_info_date_account_last_modified as date_account_last_modified, customers_info_date_of_last_logon as date_last_logon, customers_info_number_of_logons as number_of_logons from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . $customers['customers_id'] . "'");
      $info = escs_db_fetch_array($info_query);

      if ((!isset($HTTP_GET_VARS['cID']) || (isset($HTTP_GET_VARS['cID']) && ($HTTP_GET_VARS['cID'] == $customers['customers_id']))) && !isset($cInfo)) {
        $country_query = escs_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$customers['entry_country_id'] . "'");
        $country = escs_db_fetch_array($country_query);

        $reviews_query = escs_db_query("select count(*) as number_of_reviews from " . TABLE_REVIEWS . " where customers_id = '" . (int)$customers['customers_id'] . "'");
        $reviews = escs_db_fetch_array($reviews_query);

        $customer_info = array_merge($country, $info, $reviews);

        $cInfo_array = array_merge($customers, $customer_info);
        $cInfo = new objectInfo($cInfo_array);
      }

      if (isset($cInfo) && is_object($cInfo) && ($customers['customers_id'] == $cInfo->customers_id)) {
        echo '          <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . escs_href_link(FILENAME_CUSTOMERS, escs_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . escs_href_link(FILENAME_CUSTOMERS, escs_get_all_get_params(array('cID')) . 'cID=' . $customers['customers_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo $customers['customers_lastname']; ?></td>
                <td class="dataTableContent"><?php echo $customers['customers_firstname']; ?></td>
                <td class="dataTableContent" align="right"><?php echo escs_date_short($info['date_account_created']); ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($cInfo) && is_object($cInfo) && ($customers['customers_id'] == $cInfo->customers_id)) { echo escs_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . escs_href_link(FILENAME_CUSTOMERS, escs_get_all_get_params(array('cID')) . 'cID=' . $customers['customers_id']) . '">' . escs_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
				<!-- begin ad tracker mod -->
                <td class="dataTableContent"><?php echo $customers['customers_advertiser']; ?></td>
                <!-- end ad tracker mod -->
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $customers_split->display_count($customers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS); ?></td>
                    <td class="smallText" align="right"><?php echo $customers_split->display_links($customers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], escs_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
                  </tr>
<?php
    if (isset($HTTP_GET_VARS['search']) && escs_not_null($HTTP_GET_VARS['search'])) {
?>
                  <tr>
                    <td align="right" colspan="2"><?php echo '<a href="' . escs_href_link(FILENAME_CUSTOMERS) . '">' . escs_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
                  </tr>
<?php
    }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'confirm':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_CUSTOMER . '</b>');

      $contents = array('form' => escs_draw_form('customers', FILENAME_CUSTOMERS, escs_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO . '<br><br><b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>');
      if (isset($cInfo->number_of_reviews) && ($cInfo->number_of_reviews) > 0) $contents[] = array('text' => '<br>' . escs_draw_checkbox_field('delete_reviews', 'on', true) . ' ' . sprintf(TEXT_DELETE_REVIEWS, $cInfo->number_of_reviews));
      $contents[] = array('align' => 'center', 'text' => '<br>' . escs_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . escs_href_link(FILENAME_CUSTOMERS, escs_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id) . '">' . escs_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($cInfo) && is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . escs_href_link(FILENAME_CUSTOMERS, escs_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=edit') . '">' . escs_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . escs_href_link(FILENAME_CUSTOMERS, escs_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=confirm') . '">' . escs_image_button('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . escs_href_link(FILENAME_ORDERS, 'cID=' . $cInfo->customers_id) . '">' . escs_image_button('button_orders.gif', IMAGE_ORDERS) . '</a> <a href="' . escs_href_link(FILENAME_MAIL, 'selected_box=tools&customer=' . $cInfo->customers_email_address) . '">' . escs_image_button('button_email.gif', IMAGE_EMAIL) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_DATE_ACCOUNT_CREATED . ' ' . escs_date_short($cInfo->date_account_created));
        $contents[] = array('text' => '<br>' . TEXT_DATE_ACCOUNT_LAST_MODIFIED . ' ' . escs_date_short($cInfo->date_account_last_modified));
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_LAST_LOGON . ' '  . escs_date_short($cInfo->date_last_logon));
        $contents[] = array('text' => '<br>' . TEXT_INFO_NUMBER_OF_LOGONS . ' ' . $cInfo->number_of_logons);
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY . ' ' . $cInfo->countries_name);
        $contents[] = array('text' => '<br>' . TEXT_INFO_NUMBER_OF_REVIEWS . ' ' . $cInfo->number_of_reviews);
      }
      break;
  }

  if ( (escs_not_null($heading)) && (escs_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
