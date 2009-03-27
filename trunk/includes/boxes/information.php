<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>
<!-- information //-->
<?php
  $boxHeading = BOX_HEADING_INFORMATION;
  $corner_left = 'square';
  $corner_right = 'square';

  $boxContent = '<table border="0" cellspacing="0" cellpadding="2" width="100%"><tr>' .
  				'<td width="17%" align="center"><a class="boxText" href="' . escs_href_link(FILENAME_SHIPPING) . '"> ' . BOX_INFORMATION_SHIPPING . '</a></td>' .
                '<td width="17%" align="center"><a class="boxText" href="' . escs_href_link(FILENAME_PRIVACY) . '"> ' . BOX_INFORMATION_PRIVACY . '</a></td>' .
                '<td width="17%" align="center"><a class="boxText" href="' . escs_href_link(FILENAME_CONDITIONS) . '"> ' . BOX_INFORMATION_CONDITIONS . '</a></td>' .
                '<td width="17%" align="center"><a class="boxText" href="' . escs_href_link(FILENAME_CONTACT_US) . '"> ' . BOX_INFORMATION_CONTACT . '</a></td>'.
                '<td width="17%" align="center"><a class="boxText" href="' . escs_href_link(FILENAME_CATALOG_PRODUCTS_WITH_IMAGES, '', 'NONSSL') . '">' . BOX_CATALOG_PRODUCTS_WITH_IMAGES . '</a></td>'; // .
                //'<td width="15%" align="center"><a class="boxText" href="' . escs_href_link(FILENAME_GV_FAQ, '', 'NONSSL') . '"> ' . BOX_INFORMATION_GV . '</a></td>';//ICW ORDER TOTAL CREDIT CLASS/GV

  require(DIR_WS_TEMPLATES . TEMPLATENAME_BOX);
?>
<!-- information_eof //-->