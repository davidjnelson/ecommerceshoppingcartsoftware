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
$guest_query = escs_db_query("select guest from " . TABLE_LS_CONVERSATIONS . " a where session_id = '" . $session . "'");
while ($guest_info =escs_db_fetch_array($guest_query)) {
	$guest = $guest_info['guest'];
	$session_id = $session;
}
?>
<!doctype HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Live Support</title>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<script>
function popup(){
	var win = window.open('ls_comm_exit','conversation');
}
window.onunload=popup;
</script>
<style type=text/css>TD.main {
	FONT-SIZE: 8pt; COLOR: #000000; FONT-FAMILY: arial
}
TD.header {
	FONT-SIZE: 8pt; COLOR: #ffffff; FONT-FAMILY: arial
}
TD.hidden {
	FONT-SIZE: 0pt; COLOR: #ffffff; FONT-FAMILY: arial
}
A.bluelink {
	FONT-SIZE: 8pt; COLOR: #0000ff; FONT-FAMILY: arial; TEXT-DECORATION: none
}
A.bluelink:hover {
	TEXT-DECORATION: underline
}
A.whitelink {
	FONT-SIZE: 8pt; COLOR: #ffffff; FONT-FAMILY: arial; TEXT-DECORATION: none
}
A.bluelink:hover {
	TEXT-DECORATION: underline
}
.TextBox {
	BORDER-RIGHT: #000000 1px inset; BORDER-TOP: #000000 1px inset; FONT-SIZE: 12px; BACKGROUND-ATTACHMENT: fixed; BACKGROUND-IMAGE: url(images/box_shadow.gif); BORDER-LEFT: #000000 1px inset; COLOR: #000000; BORDER-BOTTOM: #000000 1px inset; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif
}
.Button {
	BORDER-RIGHT: #000000 1px inset; BORDER-TOP: #000000 1px inset; FONT-SIZE: 11px; BORDER-LEFT: #000000 1px inset; COLOR: #000000; BORDER-BOTTOM: #000000 1px inset; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif
}
</style>
</head>
<body style="MARGIN: 0px" leftMargin=0 topMargin=0 rightMargin=0 marginheight="0" marginwidth="0">
  <iframe border=0 name=frameTop src="ls_comm_top.php?session_id=<? echo $session_id; ?>" frameBorder=0 width=300 height=40> </iframe>
  <table cellSpacing=0 cellPadding=0 width=280 border=0>
    <tbody>
    <tr>
      <td><iframe border=1 name=FrameMain src="ls_comm_main.php?session=<? echo $session_id; ?>" frameBorder=0 width=280 height=214 scrollbars="no"></iframe></td>
    </tr>
    </tbody>
  </table>
  <iframe border=0 name=FrameBottom src="ls_infobar.php" frameBorder=0 width=300 height=44> </iframe>

	<div align="center"><input class="button" type="button" value="End Support Session" onclick="window.open('ls_session_close.php?session=<? echo $session_id; ?>','conversation', 'width=100', 'height=100'); window.close();"></div>

</body>
</html>
