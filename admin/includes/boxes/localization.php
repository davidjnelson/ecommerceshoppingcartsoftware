<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>
<!-- localization //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_LOCALIZATION,
                     'link'  => escs_href_link(FILENAME_CURRENCIES, 'selected_box=localization'));

  if ($selected_box == 'localization') {
    $contents[] = array('text'  =>
//Admin begin
//                                   '<a href="' . escs_href_link(FILENAME_CURRENCIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_CURRENCIES . '</a><br>' .
//                                   '<a href="' . escs_href_link(FILENAME_LANGUAGES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_LANGUAGES . '</a><br>' .
//                                   '<a href="' . escs_href_link(FILENAME_ORDERS_STATUS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_ORDERS_STATUS . '</a>');
                                   escs_admin_files_boxes(FILENAME_CURRENCIES, BOX_LOCALIZATION_CURRENCIES) .
                                   escs_admin_files_boxes(FILENAME_LANGUAGES, BOX_LOCALIZATION_LANGUAGES) .
                                   escs_admin_files_boxes(FILENAME_ORDERS_STATUS, BOX_LOCALIZATION_ORDERS_STATUS));
//Admin end
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- localization_eof //-->
