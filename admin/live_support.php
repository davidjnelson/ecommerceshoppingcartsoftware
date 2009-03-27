<?php
/*

	Live Support v1.2
	Author: Mike Lessar <mlessar@bluetruck.net>

	for use with:
	Ecommerce Shopping Cart Software
	http://www.ecommerceshoppingcartsoftware.org

	Released under the GNU General Public License

*/

  require('includes/application_top.php');

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript" src="includes/browser.js">/************************************************ Jim's DHTML Menu v5.0- © Jim Salyer (jsalyer@REMOVETHISmchsi.com)* Visit Dynamic Drive: http://www.dynamicdrive.com for script and instructions* This notice must stay intact for use***********************************************/</script><script type="text/javascript" src="config.js"></script></head>
<body onload="init();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<script language="javascript">
var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}
</script>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->




    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo 'Live Support'; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>



        <div class="helpText">You can do one of three things on this screen: 1) Enable or disable live support,
        2) Start live support, 3) Reset live support if it won't let you answer a call due to another window
        being already open.</div><br>

        <p class="smallText">1) Enable Disable Live Support:</p>

		<?php
		  if($HTTP_POST_VARS['action'] == 'save')
		  {
			  if($HTTP_POST_VARS['enable_disable'] == 'yes')
			  {
			  	escs_db_query("update configuration set configuration_value = 'yes' where configuration_key = 'ENABLE_DISABLE_LIVE_SUPPORT'");
			  	print "<div class='smallText'><h4>Live Support Enabled</h4><p>The link to show the live support tool is now being shown in your catalog.</p></div>";
			  }
			  if($HTTP_POST_VARS['enable_disable'] == 'no')
			  {
				escs_db_query("update configuration set configuration_value = 'no' where configuration_key = 'ENABLE_DISABLE_LIVE_SUPPORT'");
				print "<div class='smallText'><h4>Live Support Disabled</h4><p>The link to show the live support tool is now not being shown in your catalog.</p></div>";
			  }
		  }
		  $result = escs_db_query("select configuration_value from configuration where configuration_key = 'ENABLE_DISABLE_LIVE_SUPPORT'");
		  while($line = escs_db_fetch_array($result))
		  {
		    $enabled_disabled = $line['configuration_value'];
		  }
		  mysql_free_result($result);
		?>

		<form action="live_support.php" method="POST">

		<input type="hidden" name="action" value="save">


		<table border="0" cellspacing="1" cellpadding="4">
			<tr class="dataTableHeadingRow">
				<td class="dataTableHeadingContent">
					Enable
				</td>
				<td>
					<input type="radio" name="enable_disable" value="yes" <?php if($enabled_disabled == 'yes') { print 'checked'; }?>>
				</td>
			</tr>
			<tr class="dataTableHeadingRow">
				<td class="dataTableHeadingContent">
					Disable
				</td>
				<td>
					<input type="radio" name="enable_disable" value="no" <?php if($enabled_disabled == 'no') { print 'checked'; }?>>
				</td>
			</tr>
			<tr class="dataTableHeadingRow">
				<td colspan="2" align="center">
					<input type="submit" value="Save">
				</td>
			</tr>
		</table>

</form>


          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
             <td valign="top" class="smallText"><br>
<a href="javascript:void(0);" onclick="NewWindow('ls_start.php','tech','220','200','no');return false">2) Start Live Support</a><br><br>
<a href="javascript:void(0);" onclick="NewWindow('ls_reset.php','tech','220','200','no');return false">3) Reset Live Support</a> (Fixes open window error)
</td>
            </tr>
          </table>
        </td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>