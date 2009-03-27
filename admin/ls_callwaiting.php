<?
/*

	Live Support v 1.2b
	Author: Mike Lessar <mlessar@bluetruck.net>

	for use with:
	Ecommerce Shopping Cart Software
	http://www.ecommerceshoppingcartsoftware.org

	Released under the GNU General Public License

*/

?>
<html>
<head>
<title>Live Support Call Waiting</title>
<script language="javascript">
function LSWarning() {
alert("If You are hanging up a busy line You will be redirected to Waiting status! Close Session will turn off Live Support!");

}
window.onunload=LSWarning;
</script>
</head>
<body topmargin="0">
<form method="post" action="ls_exit.php" onSubmit='this.mysubmitbutton2.value="Processing";return(true);'>
<input type="hidden" name="tech" value="1">
<iframe src="ls_messages.php" width=190 height=50 scrolling="no" name="callwaiting" frameborder="0" align="center">
Currently Live Support works with iframe, and your browser does not support iframe
</iframe>
<p align="center" style="font-size:8pt;">You can minimize this window<br>for your convienence.<br><b>Close Window Close session!</b><br>
<input type="submit" value="Close Live Help" name="mysubmitbutton2" ></form>
<form method="post" action="ls_hangup.php" onSubmit='this.mysubmitbutton1.value="Processing";return(true);'>
<input type="hidden" name="tech" value="1">
<input type="submit" value="Hang Up" name="mysubmitbutton1" ></form>
</b></p>
</body>
</html>
