<?php
/*
  $Id: paypal_notify.php,v 0.981 2003-16-07 10:57:31 pablo_pasqualino Exp pablo_pasqualino $
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Paypal IPN v0.981 for Milestone 2
  Copyright (c) 2003 Pablo Pasqualino
  pablo_osc@osmosisdc.com
  http://www.osmosisdc.com

  Released under the GNU General Public License
*/
?>
<!-- paypalipn //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_HEADING_PAYPALIPN_ADMIN,
                     'link'  => escs_href_link(basename($PHP_SELF), escs_get_all_get_params(array('selected_box')) . 'selected_box=paypalipn'));

  if ($selected_box == 'paypalipn') {
    $contents[] = array('text'  => '<a href="' . escs_href_link(FILENAME_PAYPALIPN_TRANSACTIONS) . '?action=view">' . BOX_PAYPALIPN_ADMIN_TRANSACTIONS . '</a><br>');
    $contents[] = array('text'  => '<a href="' . escs_href_link(FILENAME_PAYPALIPN_TESTS) . '?action=view">' . BOX_PAYPALIPN_ADMIN_TESTS . '</a><br>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- paypalipn_eof //-->