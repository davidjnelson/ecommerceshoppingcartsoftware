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
	FONT-SIZE: 12px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif
}
.Button {

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
<body leftMargin=0 topMargin=0 rightMargin=0 marginheight="0" marginwidth="0" class="TextBox">
<hr size="1" width="100%">
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

	// lets see if the operator has closed the session
	$lsstatus_query = escs_db_query("select status from " . TABLE_LS_STATUS . " where session_id = '" . escs_db_prepare_input($osCsid) . "' ");
	while($lsstatus = escs_db_fetch_array($lsstatus_query)) {
		$windowstatus = $lsstatus[status];
	}

	if($windowstatus == '1') {
		// lets see if there is a tech available
		$tech_query = escs_db_query("select tech_id, status, helping from " . TABLE_LS_TECHS . " order by tech_id desc ");
		while ($tech = escs_db_fetch_array($tech_query)) {
			if(($tech[status] == 'busy') || ($tech[status] == 'yes')) {
				// If tech status is yes or busy, lets see if they are helping you
				if($osCsid == $tech[helping]) {
					$conversation_query = escs_db_query("select id, guest, tech, message, tech_reply from " . TABLE_LS_CONVERSATIONS . " where tech ='Sales' and session_id = '" . escs_db_prepare_input($osCsid) . "' order by id desc");
					while ($conversation =escs_db_fetch_array($conversation_query)) {
						if($conversation['tech_reply'] == '0') {
							echo "<span class=\"question\"><b>$conversation[guest]:</b>&nbsp;$conversation[message]</span><br>\n";
						}
						if($conversation['tech_reply'] == '1') {
							echo "<span class=\"reply\"><b>$conversation[tech]:</b>&nbsp;$conversation[message]</span><br>\n";
						}
						if($conversation['tech_reply'] == '2') {
							echo "<p align=\"center\" class=\"system\">&nbsp;$conversation[message]</p><br>\n";
						}
					}
				} else { // tell the visitor the tech is busy
					echo "<p align=\"center\" style=\"color:red;\"><br>Sorry All Operators are busy helping other customers.</p><br>\n";
					echo "<p align=\"center\">You can continue to wait or try again later.</p><br>\n";
				}
			}
		}
	} else { ?>
		<script>
			alert("The Operator has ended this session!");
			window.open('ls_exit.php','livesupport', 'width=100', 'height=100');
		</script>
	<? } ?>
    </td>
  </tr>
  </tbody>
</table>
</body>
</html>