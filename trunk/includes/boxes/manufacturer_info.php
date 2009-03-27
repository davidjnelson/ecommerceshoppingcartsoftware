<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>

<!-- manufacturer_info //-->

<?php
  if (isset($HTTP_GET_VARS['products_id'])) {
    $manufacturer_query = escs_db_query("select m.manufacturers_id, m.manufacturers_name, m.manufacturers_image, mi.manufacturers_url from " . TABLE_MANUFACTURERS . " m left join " . TABLE_MANUFACTURERS_INFO . " mi on (m.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$languages_id . "'), " . TABLE_PRODUCTS . " p  where p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and p.manufacturers_id = m.manufacturers_id");
    if (escs_db_num_rows($manufacturer_query)) {
      $manufacturer = escs_db_fetch_array($manufacturer_query);
	print '<a class="boxText" href="' . escs_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturer['manufacturers_id']) . '">' .
		'Other products by ' . $manufacturer['manufacturers_name'] . '</a>';
?>
<!-- manufacturer_info_eof //-->
<?php
    }
  }
?>
