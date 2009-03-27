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
escs_db_query("update " . TABLE_LS_TECHS . " set status = 'busy' where tech_id = 1 ");
$start_msg = "How may I help You?";
$system_msg = "You have entered into a conversation with $guest.";
escs_db_query("insert into " . TABLE_LS_CONVERSATIONS . " (id, guest, tech, session_id, message, tech_reply) values ('', '" . $guest . "', 'Sales',  '" . $session_id . "', '" . $system_msg . "', '3')");
escs_db_query("insert into " . TABLE_LS_CONVERSATIONS . " (id, guest, tech, session_id, message, tech_reply) values ('', '" . $guest . "', 'Sales',  '" . $session_id . "', '" . $start_msg . "', '1')");
escs_db_query("update " . TABLE_LS_TECHS . " set helping = '" . $session_id . "' where tech_id = '1'  ");
escs_redirect('ls_commwindow.php?session='.$session_id);
?>