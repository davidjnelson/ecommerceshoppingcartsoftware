<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>
<!-- shopping_cart //-->
<?php
  $boxHeading = BOX_HEADING_SHOPPING_CART;
  $corner_left = 'square';
  $corner_right = 'rounded';
  $boxLink = '<a href="' . escs_href_link(FILENAME_SHOPPING_CART) . '"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';

  $boxContent = '';
  if ($cart->count_contents() > 0) {
    $boxContent = '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      $boxContent .= '<tr><td align="right" valign="top" class="infoBoxContents">';

      if ((escs_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $boxContent .= '<span class="newItemInCart">';
      } else {
        $boxContent .= '<span class="infoBoxContents">';
      }

      $boxContent .= $products[$i]['quantity'] . '&nbsp;x&nbsp;</span></td><td valign="top" class="infoBoxContents"><a href="' . escs_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">';

      if ((escs_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $boxContent .= '<span class="newItemInCart">';
      } else {
        $boxContent .= '<span class="infoBoxContents">';
      }

      $boxContent .= $products[$i]['name'] . '</span></a></td></tr>';

      if ((escs_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        escs_session_unregister('new_products_id_in_cart');
      }
    }
    $boxContent .= '</table>';
  } else {
    $boxContent .= BOX_SHOPPING_CART_EMPTY;
  }

  if ($cart->count_contents() > 0) {
    $boxContent .= escs_draw_separator();
    $boxContent .= '<div align="right">' . $currencies->format($cart->show_total()) . '</div>';

  }
// ICW ADDED FOR CREDIT CLASS GV
  if (escs_session_is_registered('customer_id')) {
    $gv_query = escs_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
    $gv_result = escs_db_fetch_array($gv_query);
    if ($gv_result['amount'] > 0 ) {
      $boxContent .= escs_draw_separator();
      $boxContent .= '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="smalltext">' . VOUCHER_BALANCE . '</td><td class="smalltext" align="right" valign="bottom">' . $currencies->format($gv_result['amount']) . '</td></tr></table>';
      $boxContent .= '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="smalltext"><a href="'. escs_href_link(FILENAME_GV_SEND) . '">' . BOX_SEND_TO_FRIEND . '</a></td></tr></table>';
    }
  }
  if (escs_session_is_registered('gv_id')) {
    $gv_query = escs_db_query("select coupon_amount from " . TABLE_COUPONS . " where coupon_id = '" . $gv_id . "'");
    $coupon = escs_db_fetch_array($gv_query);
    $boxContent .= escs_draw_separator();
    $boxContent .= '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="smalltext">' . VOUCHER_REDEEMED . '</td><td class="smalltext" align="right" valign="bottom">' . $currencies->format($coupon['coupon_amount']) . '</td></tr></table>';

  }
  if (escs_session_is_registered('cc_id') && $cc_id) {
    $boxContent .= escs_draw_separator();
    $boxContent .= '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="smalltext">' . CART_COUPON . '</td><td class="smalltext" align="right" valign="bottom">' . '<a href="javascript:couponpopupWindow(\'' . escs_href_link(FILENAME_POPUP_COUPON_HELP, 'cID=' . $cc_id) . '\')">' . CART_COUPON_INFO . '</a>' . '</td></tr></table>';

  }

// ADDED FOR CREDIT CLASS GV END ADDITTION

  require(DIR_WS_TEMPLATES . TEMPLATENAME_BOX);

  $boxLink = '';
?>
<!-- shopping_cart_eof //-->