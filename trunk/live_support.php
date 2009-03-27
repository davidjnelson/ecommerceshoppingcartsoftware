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

if($login) {
	// first lets check to see if live support is really available
	$support_query = escs_db_query("select status from " . TABLE_LS_TECHS . " where status='yes' or status='busy' ");
	$support_results = escs_db_num_rows($support_query);
	if($support_results > 0) {
		// enter the user into the que
		$guest = escs_db_prepare_input($HTTP_POST_VARS['login']);
		if(!$guest) { $guest = "Guest"; }
		$start_msg = "Welcome $guest, please wait a few seconds for a live operator to come to your assistance.";
		escs_db_query("insert into " . TABLE_LS_CONVERSATIONS . " (id, guest, tech, session_id, message, tech_reply) values ('', '" . escs_db_prepare_input($guest) . "', 'Sales',  '" . escs_db_prepare_input($osCsid) . "', '" . escs_db_prepare_input($start_msg) . "', '2')");
		escs_db_query("insert into " . TABLE_LS_STATUS . " (id, session_id, status) values ('', '" . $osCsid . "', '1')");
		escs_redirect(escs_href_link('ls_start.php', '', 'NONSSL'));
	} else {
		echo "<br><br><div align=\"center\"><b>Sorry but support is currently not available!</b></div>\n";
	}
} else {

?>
<html>
<head>
<title>Live Support </title>
<style type="text/css">
<!--
td.main {
	font-size: 8pt;
	font-family: arial;
	color: #000000;
}
td.header {
	font-size: 8pt;
	font-family: arial;
	color: #ffffff;
}
td.hidden {
	font-size: 0pt;
	font-family: arial;
	color: #ffffff;
}
a.bluelink{
	font-size: 8pt;
	font-family: arial;
	color: #0000ff;
	text-decoration: none;
}
a.bluelink:hover{
	text-decoration: underline;
}
a.whitelink{
	font-size: 8pt;
	font-family: arial;
	color: #ffffff;
	text-decoration: none;
}
a.bluelink:hover{
	text-decoration: underline;
}

.TextBox {
border: #000000 1px inset;
border-color: #000000 #000000 #000000 #000000;
background-attachment: fixed;
background-image: url(live_support/box_shadow.gif);
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 12px;
color: #000000;
}
.Button {
border: #000000 1px inset;
border-color: #000000;
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 11px;
color: #000000;
}
-->
</style>
</head>
<body bgcolor="<? echo LS_COLOR; ?>" style="margin: 0" topmargin="0" leftmargin="0" rightmargin="0" marginwidth="0" marginheight="0">
<center>
<p>&nbsp;</p>
<b>Live Support</b>
  <table  width="250" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center">
        <table  width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000">
          <tr>
            <td bgcolor="#ffffff" align="center">
              <table  width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center">
                    <table  width="100%" border="0" cellspacing="2" cellpadding="0">
                      <tr>
                        <td>
                          <table  width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000">
                            <tr>
                              <td bgcolor="<? echo LS_COLOR; ?>" align="center">
                                <b> Login </b> </td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffff" class="main" align="center"><font color="#008040"><b></b></font>
                                <table  width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr>
                                    <td class="main" align="center"> <br>
                                      <form action="live_support.php" method="post" target="livesupport">
                                        <input type="text" name="login" size="10" class="textbox">
                                        <input type="submit" value="Enter" class="button">
                                      </form>
                                      Our live representatives are waiting for you. Please enter your name in the box above and press the enter button. <br>
                                      <br>
                                    </td>
                                  </tr>
                                </table>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

</center>
</body>
</html>
<?
}
?>