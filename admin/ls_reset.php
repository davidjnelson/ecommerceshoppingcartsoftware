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
alert("Very Well. You may now start Live Support!");

}
window.onunload=LSWarning;
</script>
</head>
<body topmargin="0">
<form method="post" action="ls_exit.php" onSubmit='this.mysubmitbutton2.value="Processing";return(true);'>
<input type="hidden" name="tech" value="1">
<p align="center" style="font-size:14pt;"><b></b>Reset The Database<br></b><br>
<input type="submit" value="Live Support Reset" name="mysubmitbutton2" ></form>

</b></p>
</body>
</html>