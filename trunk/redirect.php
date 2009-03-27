<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  switch ($HTTP_GET_VARS['action']) {
    case 'banner':
      $banner_query = escs_db_query("select banners_url from " . TABLE_BANNERS . " where banners_id = '" . (int)$HTTP_GET_VARS['goto'] . "'");
      if (escs_db_num_rows($banner_query)) {
        $banner = escs_db_fetch_array($banner_query);
        escs_update_banner_click_count($HTTP_GET_VARS['goto']);

        escs_redirect($banner['banners_url']);
      }
      break;

    case 'url':
      if (isset($HTTP_GET_VARS['goto']) && escs_not_null($HTTP_GET_VARS['goto'])) {
        escs_redirect('http://' . $HTTP_GET_VARS['goto']);
      }
      break;

    case 'manufacturer':
      if (isset($HTTP_GET_VARS['manufacturers_id']) && escs_not_null($HTTP_GET_VARS['manufacturers_id'])) {
        $manufacturer_query = escs_db_query("select manufacturers_url from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' and languages_id = '" . (int)$languages_id . "'");
        if (escs_db_num_rows($manufacturer_query)) {
// url exists in selected language
          $manufacturer = escs_db_fetch_array($manufacturer_query);

          if (escs_not_null($manufacturer['manufacturers_url'])) {
            escs_db_query("update " . TABLE_MANUFACTURERS_INFO . " set url_clicked = url_clicked+1, date_last_click = now() where manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' and languages_id = '" . (int)$languages_id . "'");

            escs_redirect($manufacturer['manufacturers_url']);
          }
        } else {
// no url exists for the selected language, lets use the default language then
          $manufacturer_query = escs_db_query("select mi.languages_id, mi.manufacturers_url from " . TABLE_MANUFACTURERS_INFO . " mi, " . TABLE_LANGUAGES . " l where mi.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' and mi.languages_id = l.languages_id and l.code = '" . DEFAULT_LANGUAGE . "'");
          if (escs_db_num_rows($manufacturer_query)) {
            $manufacturer = escs_db_fetch_array($manufacturer_query);

            if (escs_not_null($manufacturer['manufacturers_url'])) {
              escs_db_query("update " . TABLE_MANUFACTURERS_INFO . " set url_clicked = url_clicked+1, date_last_click = now() where manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' and languages_id = '" . (int)$manufacturer['languages_id'] . "'");

              escs_redirect($manufacturer['manufacturers_url']);
            }
          }
        }
      }
      break;
  }

  escs_redirect(escs_href_link(FILENAME_DEFAULT));
?>
