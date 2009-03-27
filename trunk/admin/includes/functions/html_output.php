<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

////
// The HTML href link wrapper function
  function escs_href_link($page = '', $parameters = '', $connection = 'SSL') {
    if ($page == '') {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>Function used:<br><br>escs_href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_ADMIN;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == 'true') {
        $link = HTTPS_CATALOG_SERVER . DIR_WS_ADMIN;
      } else {
        $link = HTTP_SERVER . DIR_WS_ADMIN;
      }
    } else {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL<br><br>Function used:<br><br>escs_href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    if ($parameters == '') {
      $link = $link . $page . '?' . SID;
    } else {
      $link = $link . $page . '?' . $parameters . '&' . SID;
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

    return $link;
  }

  function escs_catalog_href_link($page = '', $parameters = '', $connection = 'NONSSL') {
    if ($connection == 'NONSSL') {
      $link = HTTP_CATALOG_SERVER . DIR_WS_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL_CATALOG == 'true') {
        $link = HTTPS_CATALOG_SERVER . DIR_WS_CATALOG;
      } else {
        $link = HTTP_CATALOG_SERVER . DIR_WS_CATALOG;
      }
    } else {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL<br><br>Function used:<br><br>escs_href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    if ($parameters == '') {
      $link .= $page;
    } else {
      $link .= $page . '?' . $parameters;
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

    return $link;
  }

////
// The HTML image wrapper function
  function escs_image($src, $alt = '', $width = '', $height = '', $params = '') {
    $image = '<img src="' . $src . '" border="0" alt="' . $alt . '"';
    if ($alt) {
      $image .= ' title=" ' . $alt . ' "';
    }
    if ($width) {
      $image .= ' width="' . $width . '"';
    }
    if ($height) {
      $image .= ' height="' . $height . '"';
    }
    if ($params) {
      $image .= ' ' . $params;
    }
    $image .= '>';

    return $image;
  }

////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
  function escs_image_submit($image, $alt = '', $parameters = '') {
    global $language;

    $image_submit = '<input type="image" src="' . escs_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '" border="0" alt="' . escs_output_string($alt) . '"';

    if (escs_not_null($alt)) $image_submit .= ' title=" ' . escs_output_string($alt) . ' "';

    if (escs_not_null($parameters)) $image_submit .= ' ' . $parameters;

    $image_submit .= '>';

    return $image_submit;
  }

////
// Draw a 1 pixel black line
  function escs_black_line() {
    return escs_image(DIR_WS_IMAGES . 'pixel_black.gif', '', '100%', '1');
  }

////
// Output a separator either through whitespace, or with an image
  function escs_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
    return escs_image(DIR_WS_IMAGES . $image, '', $width, $height);
  }

////
// Output a function button in the selected language
  function escs_image_button($image, $alt = '', $params = '') {
    global $language;

    return escs_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $params);
  }

////
// javascript to dynamically update the states/provinces list when the country is changed
// TABLES: zones
  function escs_js_zone_list($country, $form, $field) {
    $countries_query = escs_db_query("select distinct zone_country_id from " . TABLE_ZONES . " order by zone_country_id");
    $num_country = 1;
    $output_string = '';
    while ($countries = escs_db_fetch_array($countries_query)) {
      if ($num_country == 1) {
        $output_string .= '  if (' . $country . ' == "' . $countries['zone_country_id'] . '") {' . "\n";
      } else {
        $output_string .= '  } else if (' . $country . ' == "' . $countries['zone_country_id'] . '") {' . "\n";
      }

      $states_query = escs_db_query("select zone_name, zone_id from " . TABLE_ZONES . " where zone_country_id = '" . $countries['zone_country_id'] . "' order by zone_name");

      $num_state = 1;
      while ($states = escs_db_fetch_array($states_query)) {
        if ($num_state == '1') $output_string .= '    ' . $form . '.' . $field . '.options[0] = new Option("' . PLEASE_SELECT . '", "");' . "\n";
        $output_string .= '    ' . $form . '.' . $field . '.options[' . $num_state . '] = new Option("' . $states['zone_name'] . '", "' . $states['zone_id'] . '");' . "\n";
        $num_state++;
      }
      $num_country++;
    }
    $output_string .= '  } else {' . "\n" .
                      '    ' . $form . '.' . $field . '.options[0] = new Option("' . TYPE_BELOW . '", "");' . "\n" .
                      '  }' . "\n";

    return $output_string;
  }

////
// Output a form
  function escs_draw_form($name, $action, $parameters = '', $method = 'post', $params = '') {
    $form = '<form name="' . escs_output_string($name) . '" action="';
    if (escs_not_null($parameters)) {
      $form .= escs_href_link($action, $parameters);
    } else {
      $form .= escs_href_link($action);
    }
    $form .= '" method="' . escs_output_string($method) . '"';
    if (escs_not_null($params)) {
      $form .= ' ' . $params;
    }
    $form .= '>';

    return $form;
  }

////
// Output a form input field
  function escs_draw_input_field($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true) {
    $field = '<input type="' . escs_output_string($type) . '" name="' . escs_output_string($name) . '"';

    if (isset($GLOBALS[$name]) && ($reinsert_value == true) && is_string($GLOBALS[$name])) {
      $field .= ' value="' . escs_output_string(stripslashes($GLOBALS[$name])) . '"';
    } elseif (escs_not_null($value)) {
      $field .= ' value="' . escs_output_string($value) . '"';
    }

    if (escs_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }

////
// Output a form password field
  function escs_draw_password_field($name, $value = '', $required = false) {
    $field = escs_draw_input_field($name, $value, 'maxlength="40"', $required, 'password', false);

    return $field;
  }

////
// Output a form filefield
  function escs_draw_file_field($name, $required = false) {
    $field = escs_draw_input_field($name, '', '', $required, 'file');

    return $field;
  }

//Admin begin
////
// Output a selection field - alias function for escs_draw_checkbox_field() and escs_draw_radio_field()
//  function escs_draw_selection_field($name, $type, $value = '', $checked = false, $compare = '') {
//    $selection = '<input type="' . escs_output_string($type) . '" name="' . escs_output_string($name) . '"';
//
//    if (escs_not_null($value)) $selection .= ' value="' . escs_output_string($value) . '"';
//
//    if ( ($checked == true) || (isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && ($GLOBALS[$name] == 'on')) || (isset($value) && isset($GLOBALS[$name]) && (stripslashes($GLOBALS[$name]) == $value)) || (escs_not_null($value) && escs_not_null($compare) && ($value == $compare)) ) {
//      $selection .= ' CHECKED';
//    }
//
//    $selection .= '>';
//
//    return $selection;
//  }
//
////
// Output a form checkbox field
//  function escs_draw_checkbox_field($name, $value = '', $checked = false, $compare = '') {
//    return escs_draw_selection_field($name, 'checkbox', $value, $checked, $compare);
//  }
//
////
// Output a form radio field
//  function escs_draw_radio_field($name, $value = '', $checked = false, $compare = '') {
//    return escs_draw_selection_field($name, 'radio', $value, $checked, $compare);
//  }
////
// Output a selection field - alias function for escs_draw_checkbox_field() and escs_draw_radio_field()
  function escs_draw_selection_field($name, $type, $value = '', $checked = false, $compare = '', $parameter = '') {
    $selection = '<input type="' . $type . '" name="' . $name . '"';
    if ($value != '') {
      $selection .= ' value="' . $value . '"';
    }
    if ( ($checked == true) || ($GLOBALS[$name] == 'on') || ($value && ($GLOBALS[$name] == $value)) || ($value && ($value == $compare)) ) {
      $selection .= ' CHECKED';
    }
    if ($parameter != '') {
      $selection .= ' ' . $parameter;
    }
    $selection .= '>';

    return $selection;
  }

////
// Output a form checkbox field
  function escs_draw_checkbox_field($name, $value = '', $checked = false, $compare = '', $parameter = '') {
    return escs_draw_selection_field($name, 'checkbox', $value, $checked, $compare, $parameter);
  }

////
// Output a form radio field
  function escs_draw_radio_field($name, $value = '', $checked = false, $compare = '', $parameter = '') {
    return escs_draw_selection_field($name, 'radio', $value, $checked, $compare, $parameter);
  }
//Admin end

////
// Output a form textarea field
  function escs_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
    $field = '<textarea name="' . escs_output_string($name) . '" wrap="' . escs_output_string($wrap) . '" cols="' . escs_output_string($width) . '" rows="' . escs_output_string($height) . '"';

    if (escs_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
      $field .= stripslashes($GLOBALS[$name]);
    } elseif (escs_not_null($text)) {
      $field .= $text;
    }

    $field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function escs_draw_hidden_field($name, $value = '', $parameters = '') {
    $field = '<input type="hidden" name="' . escs_output_string($name) . '"';

    if (escs_not_null($value)) {
      $field .= ' value="' . escs_output_string($value) . '"';
    } elseif (isset($GLOBALS[$name]) && is_string($GLOBALS[$name])) {
      $field .= ' value="' . escs_output_string(stripslashes($GLOBALS[$name])) . '"';
    }

    if (escs_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
  }

////
// Output a form pull down menu
  function escs_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
    $field = '<select name="' . escs_output_string($name) . '"';

    if (escs_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
      $field .= '<option value="' . escs_output_string($values[$i]['id']) . '"';
      if ($default == $values[$i]['id']) {
        $field .= ' SELECTED';
      }

      $field .= '>' . escs_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }
?>
