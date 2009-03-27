<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  OSC-Affiliate

  Contribution based on:

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/
?>
<!-- affiliate_system //-->

<?php

$result = escs_db_query("select configuration_value from configuration where configuration_key = '" .
                        "ENABLE_AFFILIATE_PROGRAM'");
while($line = escs_db_fetch_array($result))
{
	$enabled = $line['configuration_value'];
}

if($enabled == 'yes')
{
	$boxHeading = BOX_HEADING_AFFILIATE;
	$corner_left = 'square';
	$corner_right = 'square';
	if (escs_session_is_registered('affiliate_id')) {
		$boxContent = '<a href="' . escs_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'SSL') . '">' . BOX_AFFILIATE_SUMMARY . '</a><br>' .
		'<a href="' . escs_href_link(FILENAME_AFFILIATE_ACCOUNT, '', 'SSL'). '">' . BOX_AFFILIATE_ACCOUNT . '</a><br>' .
		'<a href="' . escs_href_link(FILENAME_AFFILIATE_PAYMENT, '', 'SSL'). '">' . BOX_AFFILIATE_PAYMENT . '</a><br>' .
		'<a href="' . escs_href_link(FILENAME_AFFILIATE_CLICKS, '', 'SSL'). '">' . BOX_AFFILIATE_CLICKRATE . '</a><br>' .
		'<a href="' . escs_href_link(FILENAME_AFFILIATE_SALES, '', 'SSL'). '">' . BOX_AFFILIATE_SALES . '</a><br>' .
		'<a href="' . escs_href_link(FILENAME_AFFILIATE_BANNERS). '">' . BOX_AFFILIATE_BANNERS . '</a><br>' .
		'<a href="' . escs_href_link(FILENAME_AFFILIATE_CONTACT). '">' . BOX_AFFILIATE_CONTACT . '</a><br>' .
		'<a href="' . escs_href_link(FILENAME_AFFILIATE_FAQ). '">' . BOX_AFFILIATE_FAQ . '</a><br>' .
		'<a href="' . escs_href_link(FILENAME_AFFILIATE_LOGOUT). '">' . BOX_AFFILIATE_LOGOUT . '</a>' ;
	} else {
		$boxContent = '<a href="' . escs_href_link(FILENAME_AFFILIATE_INFO). '">' . BOX_AFFILIATE_INFO . '</a><br>' .
	'<a href="' . escs_href_link(FILENAME_AFFILIATE, '', 'SSL') . '">' . BOX_AFFILIATE_LOGIN . '</a>';
	}
	require(DIR_WS_TEMPLATES . TEMPLATENAME_BOX);
	print '';
}

?>
<!-- affiliate_system_eof //-->