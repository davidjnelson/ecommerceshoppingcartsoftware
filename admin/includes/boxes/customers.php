<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>
<!-- customers //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_CUSTOMERS,
                     'link'  => escs_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'));

  if ($selected_box == 'customers') {
    $contents[] = array('text'  =>
//Admin begin
//                                   '<a href="' . escs_href_link(FILENAME_CUSTOMERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_CUSTOMERS . '</a><br>' .
//                                   '<a href="' . escs_href_link(FILENAME_ORDERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_ORDERS . '</a>');
                                   escs_admin_files_boxes(FILENAME_CUSTOMERS, BOX_CUSTOMERS_CUSTOMERS) .
                                   escs_admin_files_boxes(FILENAME_ORDERS, BOX_CUSTOMERS_ORDERS));
//Admin end
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- customers_eof //-->
