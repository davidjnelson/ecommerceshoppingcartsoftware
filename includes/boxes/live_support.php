<?php
/*

	Live Support v 1.0
	Author: Mike Lessar <mlessar@bluetruck.net>

	for use with:
	Ecommerce Shopping Cart Software
	http://www.ecommerceshoppingcartsoftware.org

	Released under the GNU General Public License

*/

?>
<!-- Live_Support //-->

<?php
$result = escs_db_query("select configuration_value from configuration where configuration_key = '" .
                        "ENABLE_DISABLE_LIVE_SUPPORT'");
while($line = escs_db_fetch_array($result))
{
	$enabled = $line['configuration_value'];
}

if($enabled == 'yes')
{
	print '<tr><td>';

	//Check to see if support is available
	$support_query = escs_db_query("select status from " . TABLE_LS_TECHS . " where status='yes' or status='busy' ");
	$support_results = escs_db_num_rows($support_query);

	$info_box_contents = array();
	$info_box_contents[] = array('align' => 'left',
                               'text'  => BOX_HEADING_LIVE_SUPPORT
                              );
	new infoBoxHeading($info_box_contents, false, false);

	$info_box_contents = array();
	if($support_results > 0) {
		$info_box_contents[] = array('align' => 'center',
                               'text'  => '<a href="' . FILENAME_LIVE_SUPPORT . '">' . escs_image(DIR_WS_IMAGES . 'live_support1.gif', IMAGE_LIVE_SUPPORT_AVAILABLE) . '</a>');
	} else {
		$info_box_contents[] = array('align' => 'center',
                               'text'  => '<a href="' . escs_href_link(FILENAME_CONTACT_US, '', 'NONSSL') . '">' . escs_image(DIR_WS_IMAGES . 'live_support2.gif', IMAGE_LIVE_SUPPORT_NOT_AVAILABLE) . '</a>');
	}
	new infoBox($info_box_contents);
	print '</td></tr>';
}
?>

<!-- Live_Support_eof //-->