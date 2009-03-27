<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  if (STORE_SESSIONS == 'mysql') {
    if (!$SESS_LIFE = get_cfg_var('session.gc_maxlifetime')) {
      $SESS_LIFE = 1440;
    }

    function _sess_open($save_path, $session_name) {
      return true;
    }

    function _sess_close() {
      return true;
    }

    function _sess_read($key) {
      $qid = escs_db_query("select value from " . TABLE_SESSIONS . " where sesskey = '" . escs_db_input($key) . "' and expiry > '" . time() . "'");

      $value = escs_db_fetch_array($qid);
      if ($value['value']) {
        return $value['value'];
      }

      return false;
    }

    function _sess_write($key, $val) {
      global $SESS_LIFE;

      $expiry = time() + $SESS_LIFE;
      $value = $val;

      $qid = escs_db_query("select count(*) as total from " . TABLE_SESSIONS . " where sesskey = '" . escs_db_input($key) . "'");
      $total = escs_db_fetch_array($qid);

      if ($total['total'] > 0) {
        return escs_db_query("update " . TABLE_SESSIONS . " set expiry = '" . escs_db_input($expiry) . "', value = '" . escs_db_input($value) . "' where sesskey = '" . escs_db_input($key) . "'");
      } else {
        return escs_db_query("insert into " . TABLE_SESSIONS . " values ('" . escs_db_input($key) . "', '" . escs_db_input($expiry) . "', '" . escs_db_input($value) . "')");
      }
    }

    function _sess_destroy($key) {
      return escs_db_query("delete from " . TABLE_SESSIONS . " where sesskey = '" . escs_db_input($key) . "'");
    }

    function _sess_gc($maxlifetime) {
      escs_db_query("delete from " . TABLE_SESSIONS . " where expiry < '" . time() . "'");

      return true;
    }

    session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
  }

  function escs_session_start() {
    return session_start();
  }

  function escs_session_register($variable) {
    return session_register($variable);
  }

  function escs_session_is_registered($variable) {
    return session_is_registered($variable);
  }

  function escs_session_unregister($variable) {
    return session_unregister($variable);
  }

  function escs_session_id($sessid = '') {
    if ($sessid != '') {
      return session_id($sessid);
    } else {
      return session_id();
    }
  }

  function escs_session_name($name = '') {
    if ($name != '') {
      return session_name($name);
    } else {
      return session_name();
    }
  }

  function escs_session_close() {
    if (function_exists('session_close')) {
      return session_close();
    }
  }

  function escs_session_destroy() {
    return session_destroy();
  }

  function escs_session_save_path($path = '') {
    if ($path != '') {
      return session_save_path($path);
    } else {
      return session_save_path();
    }
  }
?>
