<?
/*

	Live Support v 1.2b
	Author: Mike Lessar <mlessar@bluetruck.net>

	for use with:
	Ecommerce Shopping Cart Software
	http://www.ecommerceshoppingcartsoftware.org

	Released under the GNU General Public License

*/

require('includes/application_top.php');

$support_query = escs_db_query("select status from " . TABLE_LS_TECHS . " where tech_id=1");
$support = escs_db_fetch_array($support_query);
$status = $support['status'];
if($status == 'no') {
	escs_db_query("update " . TABLE_LS_TECHS . " set status = 'yes' where tech_id = 1 ");
	echo "<script>window.open('ls_callwaiting.php', 'tech', 'width=200,height=200');</script>\n";
}
else {
echo "<div align=\"center\">Live Support is currently open<br>Currently only 1 window can be open.<br> Most likely the reason for this message is you closed the previous session (window) from the window controls in the upper right hand corner or you tried to initiate a second session!</div>\n";
}
?>