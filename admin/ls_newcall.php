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

if($c == 'r') {
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
}
?>
<html>
<head>
<title>Live Support New Call</title>
<script>
this.focus();
function playHome() {
if (document.all) {
  document.all.sound.src = "live_support/<? echo LS_WARNING; ?>";
 }
}
document.write('<EMBED SRC="live_support/<? echo LS_WARNING; ?>" autostart="true" hidden="true">')
document.write('<bgsound id="sound">')
playHome();
</script>
</head>
<body>
<p align="center"><b style="font-size:16pt;">You Have A New Call!</b></p>
<p><b>The following are waiting for live help:</b></p>

<?
$conversation_query = escs_db_query("select guest, session_id, message, tech_reply from " . TABLE_LS_CONVERSATIONS . " a where tech ='Sales' and tech_reply ='2' ");
$conversation_rows = escs_db_num_rows($conversation_query);
while ($conversation =escs_db_fetch_array($conversation_query)) {
	$guest = "$conversation[guest]";
	$session = "$conversation[session_id]";
	if($guest) {

		echo "<li><b style=\"font-size:9pt;\"><a href=\"ls_answercall.php?c=r&session=$session\" target=\"conversation\">REMOVE</a></b>&nbsp;&nbsp;<a href=\"#\" onclick=\"window.open('ls_answercall.php?guest=$guest&session_id=$session','conversation','width=280,height=340')\">$guest</a></li>\n";
	}
}

if($conversation_rows == '0') { echo "<script>window.close()</script>\n"; }

?>

<p align="center"><b>Click Name to Start Conversation</b></p>
</body>
</html>