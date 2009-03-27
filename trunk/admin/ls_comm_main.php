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
	BORDER-RIGHT: #000000 1px inset; BORDER-TOP: #000000 1px inset; FONT-SIZE: 12px; BACKGROUND-ATTACHMENT: fixed; BACKGROUND-IMAGE: url('live_support/box_shadow.gif'); BORDER-LEFT: #000000 1px inset; COLOR: #000000; BORDER-BOTTOM: #000000 1px inset; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif
}
.Button {
	BORDER-RIGHT: #000000 1px inset; BORDER-TOP: #000000 1px inset; FONT-SIZE: 11px; BORDER-LEFT: #000000 1px inset; COLOR: #000000; BORDER-BOTTOM: #000000 1px inset; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif
}
.question {
	FONT-SIZE: 8pt; COLOR: #000000; FONT-FAMILY: arial
}
.reply {
	FONT-SIZE: 8pt; COLOR: #ff0000; FONT-FAMILY: arial
}
.system {
	FONT-SIZE: 8pt; COLOR: #008000; FONT-FAMILY: arial
}
</style>
<script language=JavaScript>
var countDownInterval=5;
var c_reloadwidth=200
</script>
</head>
<body style="BACKGROUND-ATTACHMENT: fixed; MARGIN: 0px; BACKGROUND-REPEAT: no-repeat" leftMargin=0 topMargin=0 rightMargin=0 marginheight="0" marginwidth="0" class="TextBox">
<ilayer id=c_reload width="&amp;{c_reloadwidth};">
<layer id=c_reload2 width="&amp;{c_reloadwidth};" top="0" left="0"></layer>
</ilayer>
<script>
var countDownTime=countDownInterval+1;
function countDown(){
countDownTime--;
if (countDownTime <=0){
countDownTime=countDownInterval;
clearTimeout(counter)
window.location.reload()
return
}
if (document.all)
document.all.countDownText.innerText = countDownTime+" ";
else if (document.getElementById)
document.getElementById("countDownText").innerHTML=countDownTime+" "
else if (document.layers){
document.c_reload.document.c_reload2.document.write('<table  width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="hidden"><b id="countDownText">'+countDownTime+'</b></td></tr></table>')
document.c_reload.document.c_reload2.document.close()
}
counter=setTimeout("countDown()", 1000);
}

function startit(){
if (document.all||document.getElementById)
document.write('<table  width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="hidden"><b id="countDownText">'+countDownTime+'</b></td></tr></table>')
countDown()
}

if (document.all||document.getElementById)
startit()
else
window.onload=startit
</script>

<table cellSpacing=0 cellPadding=0 width="100%" border=0>
  <tbody>
  <tr>
    <td width=10></td>
    <td class=main>
<?
	$windowstatus = 0;

	// lets see if the user has closed the session
	$lsstatus_query = escs_db_query("select status from " . TABLE_LS_STATUS . " where session_id = '" . $session . "' ");
	while($lsstatus = escs_db_fetch_array($lsstatus_query)) {
		$windowstatus = $lsstatus[status];
	}

	if($windowstatus == '1') {
		// Lets read the contents of the conversation
		$conversation_query = escs_db_query("select id, guest, tech, message, tech_reply from " . TABLE_LS_CONVERSATIONS . " a where session_id = '" . $session . "' order by id desc");
		while ($conversation =escs_db_fetch_array($conversation_query)) {
			if($conversation['tech_reply'] == '1') {
				echo "<span class=\"question\"><b>$conversation[tech]</b>&nbsp;$conversation[message]</span><br>\n";
			}
			if($conversation['tech_reply'] == '0') {
				echo "<span class=\"reply\"><b>$conversation[guest]</b>&nbsp;$conversation[message]</span><br>\n";
			}
			if($conversation['tech_reply'] == '3') {
echo "<p align=\"center\" class=\"system\">&nbsp;$conversation[message]</p><br>\n";
}
}
} else {
echo " The User has left the conversation!<br>FIRST HANG UP and then End Support Session!!<form method=post action=ls_comm_exit.php onSubmit='this.mysubmitbutton1.value=Processing;return(true);'>
<input type=hidden name=tech value=1>
<input type=submit value=Hang&nbsp;Up name=mysubmitbutton1 ></form>";
}
?>
    </td>
  </tr>
  </tbody>
</table>
</body>
</html>
