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
escs_db_query("update " . TABLE_LS_TECHS . " set status = 'yes', helping = '' where tech_id = ' " . $tech . " ' ");
echo "<script>
redirTime = '350';
redirURL = 'ls_callwaiting.php';
function redirTimer() { self.setTimeout('self.location.href = redirURL;',redirTime); }
// End -->
</script>";
?>
<html>
<head>
<title>Live Support</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" onLoad="redirTimer()">
</p>
<p><input type="hidden" name="tech" value="1"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">If you are not automatically redirected click <a href="ls_callwaiting.php">here</a>.</font>
</p>
</body>
</html>