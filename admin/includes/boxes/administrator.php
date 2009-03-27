<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>
<!-- catalog //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_ADMINISTRATOR,
                     'link'  => escs_href_link(basename($PHP_SELF), escs_get_all_get_params(array('selected_box')) . 'selected_box=administrator'));

  if ($selected_box == 'administrator') {
    $contents[] = array('text'  => escs_admin_files_boxes(FILENAME_ADMIN_MEMBERS, BOX_ADMINISTRATOR_MEMBERS) .
                                   escs_admin_files_boxes(FILENAME_ADMIN_FILES, BOX_ADMINISTRATOR_BOXES));
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- catalog_eof //-->
