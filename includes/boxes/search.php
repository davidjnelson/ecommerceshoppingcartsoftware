<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>
<!-- search //-->
<?php
  $boxContent = escs_draw_form('quick_find',
  		escs_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get') .
  		'<div class="boxText">Search Catalog: ' .
  		escs_draw_input_field('keywords', '', 'size="10" maxlength="30" style="width: ' .
  		(BOX_WIDTH-30) . 'px"') . '&nbsp;' . escs_hide_session_id() . '<input type="submit" value="Search"> ' .
  		'<a href="' . escs_href_link(FILENAME_ADVANCED_SEARCH) . '"> ' . BOX_SEARCH_ADVANCED_SEARCH . '</a> ' .
  		'| <a href="' . escs_href_link(FILENAME_ALLPRODS, '', 'NONSSL') . '">' . BOX_INFORMATION_ALLPRODS .
  		'</a></div></form>';
  print $boxContent;
?>
<!-- search_eof //-->
