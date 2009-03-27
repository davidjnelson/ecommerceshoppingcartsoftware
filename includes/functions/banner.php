<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

////
// Sets the status of a banner
  function escs_set_banner_status($banners_id, $status) {
    if ($status == '1') {
      return escs_db_query("update " . TABLE_BANNERS . " set status = '1', date_status_change = now(), date_scheduled = NULL where banners_id = '" . (int)$banners_id . "'");
    } elseif ($status == '0') {
      return escs_db_query("update " . TABLE_BANNERS . " set status = '0', date_status_change = now() where banners_id = '" . (int)$banners_id . "'");
    } else {
      return -1;
    }
  }

////
// Auto activate banners
  function escs_activate_banners() {
    $banners_query = escs_db_query("select banners_id, date_scheduled from " . TABLE_BANNERS . " where date_scheduled != ''");
    if (escs_db_num_rows($banners_query)) {
      while ($banners = escs_db_fetch_array($banners_query)) {
        if (date('Y-m-d H:i:s') >= $banners['date_scheduled']) {
          escs_set_banner_status($banners['banners_id'], '1');
        }
      }
    }
  }

////
// Auto expire banners
  function escs_expire_banners() {
    $banners_query = escs_db_query("select b.banners_id, b.expires_date, b.expires_impressions, sum(bh.banners_shown) as banners_shown from " . TABLE_BANNERS . " b, " . TABLE_BANNERS_HISTORY . " bh where b.status = '1' and b.banners_id = bh.banners_id group by b.banners_id");
    if (escs_db_num_rows($banners_query)) {
      while ($banners = escs_db_fetch_array($banners_query)) {
        if (escs_not_null($banners['expires_date'])) {
          if (date('Y-m-d H:i:s') >= $banners['expires_date']) {
            escs_set_banner_status($banners['banners_id'], '0');
          }
        } elseif (escs_not_null($banners['expires_impressions'])) {
          if ( ($banners['expires_impressions'] > 0) && ($banners['banners_shown'] >= $banners['expires_impressions']) ) {
            escs_set_banner_status($banners['banners_id'], '0');
          }
        }
      }
    }
  }

////
// Display a banner from the specified group or banner id ($identifier)
  function escs_display_banner($action, $identifier) {
    if ($action == 'dynamic') {
      $banners_query = escs_db_query("select count(*) as count from " . TABLE_BANNERS . " where status = '1' and banners_group = '" . $identifier . "'");
      $banners = escs_db_fetch_array($banners_query);
      if ($banners['count'] > 0) {
        $banner = escs_random_select("select banners_id, banners_title, banners_image, banners_html_text from " . TABLE_BANNERS . " where status = '1' and banners_group = '" . $identifier . "'");
      } else {
        return '<b>TEP ERROR! (escs_display_banner(' . $action . ', ' . $identifier . ') -> No banners with group \'' . $identifier . '\' found!</b>';
      }
    } elseif ($action == 'static') {
      if (is_array($identifier)) {
        $banner = $identifier;
      } else {
        $banner_query = escs_db_query("select banners_id, banners_title, banners_image, banners_html_text from " . TABLE_BANNERS . " where status = '1' and banners_id = '" . (int)$identifier . "'");
        if (escs_db_num_rows($banner_query)) {
          $banner = escs_db_fetch_array($banner_query);
        } else {
          return '<b>TEP ERROR! (escs_display_banner(' . $action . ', ' . $identifier . ') -> Banner with ID \'' . $identifier . '\' not found, or status inactive</b>';
        }
      }
    } else {
      return '<b>TEP ERROR! (escs_display_banner(' . $action . ', ' . $identifier . ') -> Unknown $action parameter value - it must be either \'dynamic\' or \'static\'</b>';
    }

    if (escs_not_null($banner['banners_html_text'])) {
      $banner_string = $banner['banners_html_text'];
    } else {
      $banner_string = '<a href="' . escs_href_link(FILENAME_REDIRECT, 'action=banner&goto=' . $banner['banners_id']) . '" target="_blank">' . escs_image(DIR_WS_IMAGES . $banner['banners_image'], $banner['banners_title']) . '</a>';
    }

    escs_update_banner_display_count($banner['banners_id']);

    return $banner_string;
  }

////
// Check to see if a banner exists
  function escs_banner_exists($action, $identifier) {
    if ($action == 'dynamic') {
      return escs_random_select("select banners_id, banners_title, banners_image, banners_html_text from " . TABLE_BANNERS . " where status = '1' and banners_group = '" . $identifier . "'");
    } elseif ($action == 'static') {
      $banner_query = escs_db_query("select banners_id, banners_title, banners_image, banners_html_text from " . TABLE_BANNERS . " where status = '1' and banners_id = '" . (int)$identifier . "'");
      return escs_db_fetch_array($banner_query);
    } else {
      return false;
    }
  }

////
// Update the banner display statistics
  function escs_update_banner_display_count($banner_id) {
    $banner_check_query = escs_db_query("select count(*) as count from " . TABLE_BANNERS_HISTORY . " where banners_id = '" . (int)$banner_id . "' and date_format(banners_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
    $banner_check = escs_db_fetch_array($banner_check_query);

    if ($banner_check['count'] > 0) {
      escs_db_query("update " . TABLE_BANNERS_HISTORY . " set banners_shown = banners_shown + 1 where banners_id = '" . (int)$banner_id . "' and date_format(banners_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
    } else {
      escs_db_query("insert into " . TABLE_BANNERS_HISTORY . " (banners_id, banners_shown, banners_history_date) values ('" . (int)$banner_id . "', 1, now())");
    }
  }

////
// Update the banner click statistics
  function escs_update_banner_click_count($banner_id) {
    escs_db_query("update " . TABLE_BANNERS_HISTORY . " set banners_clicked = banners_clicked + 1 where banners_id = '" . (int)$banner_id . "' and date_format(banners_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
  }
?>