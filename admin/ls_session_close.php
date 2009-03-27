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
$archive_query = escs_db_query("select id from " . TABLE_LS_CONVERSATIONS . " where session_id = '" . $session . "' ");
$archive_results = escs_db_num_rows($archive_query);

if(LS_ARCHIVE == "true") {
	for($i=0; $i < $archive_results; $i++) {
		escs_db_query("update  " . TABLE_LS_CONVERSATIONS . "  set tech_reply = '4' where session_id = '" . $session . "' ");
	}
} else  {
	for($i=0; $i < $archive_results; $i++) {
		escs_db_query("delete from  " . TABLE_LS_CONVERSATIONS . "  where session_id = '" . $session . "' ");
	}
}

escs_db_query("delete from  " . TABLE_LS_STATUS . "  where session_id = '" . $session . "' ");
escs_db_query("update " . TABLE_LS_TECHS . " set status = 'yes', helping = '' where tech_id = 1 ");

echo "<script>window.close()</script>";
?>
