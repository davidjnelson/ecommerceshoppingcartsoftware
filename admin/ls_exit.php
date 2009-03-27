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
escs_db_query("update " . TABLE_LS_TECHS . " set status = 'no', helping = '' where tech_id = 1 ");
echo "<script>window.close()</script>";
?>