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

function FixQuotes ($what = "") {
	$what = ereg_replace("'","''",$what);
	while (eregi("\\\\'", $what)) {
		$what = ereg_replace("\\\\'","'",$what);
	}
	return $what;
}

if($text) {
	$guest_query = escs_db_query("select guest from " . TABLE_LS_CONVERSATIONS . " a where session_id = '" . $session_id . "'");
	while ($guest_info =escs_db_fetch_array($guest_query)) {
		$guest = $guest_info['guest'];
	}
	$message = $HTTP_POST_VARS['text'];
	$message = FixQuotes($message);
	escs_db_query("insert into " . TABLE_LS_CONVERSATIONS . " (id, guest, tech, session_id, message, tech_reply) values ('', '" . $guest . "', 'Sales',  '" . $session_id . "', '" . $message . "', '1')");
}
?>
<!doctype HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
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
<body style="MARGIN: 0px" leftMargin=0 topMargin=0 rightMargin=0 marginheight="0" marginwidth="0" onload="chatform.text.focus();">
<form action="ls_comm_top.php?session_id=<? echo $session_id; ?>" method="post" name="chatform">
  <table height=25 cellSpacing=0 cellPadding=0 width="100%" border=0>
    <tbody>
    <tr>
      <td>&nbsp;<input class="textbox" size="30" name="text" id="text">&nbsp;<input class="button" type="submit" value="Send"></td>
    </tr>
    </tbody>
  </table>
  <table height=15 cellSpacing=0 cellPadding=0 border=0>
    <tbody>
    <tr>
      <td class=header width=265 bgColor=#000000><b>&nbsp;&nbsp;&nbsp;Chat Box </b></td>
      <td width=15 bgColor=#000000><img height=15 src="live_support/white/top_right_curve.gif" width=15></td>
    </tr>
    </tbody>
  </table>
</form>
</body>
</html>
