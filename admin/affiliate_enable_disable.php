<?php
/*
  $Id$

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License

  cross.sale.php created By Isaac Mualem im@imwebdesigning.com

  Modified by Andrew Edmond (osc@aravia.com)
  Sept 16th, 2002
*/

  require('includes/application_top.php');

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><? echo TITLE; ?></title>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="JavaScript1.2">

function cOn(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="#CCCCCC";
  }
}

function cOnA(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="#CCFFFF";
  }
}

function cOut(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="DFE4F4";
  }
}
</script>
<script type="text/javascript" src="includes/browser.js">/************************************************ Jim's DHTML Menu v5.0- © Jim Salyer (jsalyer@REMOVETHISmchsi.com)* Visit Dynamic Drive: http://www.dynamicdrive.com for script and instructions* This notice must stay intact for use***********************************************/</script><script type="text/javascript" src="config.js"></script></head>
<body onload="init();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<? include(DIR_WS_INCLUDES . 'header.php');  ?>
<!-- header_eof //-->


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
            <td class="pageHeading"><?php echo "Enable/Disable Affiliate Program"; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
     </tr>

<!-- body_text //-->
    <td width="100%" valign="top">
      <!-- Start of edit header //-->

<?php
  if($HTTP_POST_VARS['action'] == 'save')
  {
	  if($HTTP_POST_VARS['enable_disable'] == 'yes')
	  {
	  	escs_db_query("update configuration set configuration_value = 'yes' where configuration_key = 'ENABLE_AFFILIATE_PROGRAM'");
	  	print "<div class='helpText'><h4>Affiliate Program Enabled</h4><p>The link to show the affiliate program join and tools screens are now being shown in your catalog.</p></div>";
	  }
	  if($HTTP_POST_VARS['enable_disable'] == 'no')
	  {
		escs_db_query("update configuration set configuration_value = 'no' where configuration_key = 'ENABLE_AFFILIATE_PROGRAM'");
		print "<div class='helpText'><h4>Affiliate Program Disabled</h4><p>The link to show the affiliate program join and tools screens are now not being shown in your catalog.  You should <a href='affiliate_contact.php'>email your affiliates</a> to tell them you are no longer offering an affiliate program.  The affiliate link tracking script has not been changed, and will still track clickthroughs/commissions etc.</p></div>";
	  }
  }
  $result = escs_db_query("select configuration_value from configuration where configuration_key = 'ENABLE_AFFILIATE_PROGRAM'");
  while($line = escs_db_fetch_array($result))
  {
    $enabled_disabled = $line['configuration_value'];
  }
  mysql_free_result($result);
?>

<br>

<form action="affiliate_enable_disable.php" method="POST">

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



	<!-- End of edit header //-->
	</td>
<!-- products_attributes_eof //-->
</tr></table>
<!-- body_text_eof //-->
<!-- footer //-->
<? include(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<? include(DIR_WS_INCLUDES . 'application_bottom.php');?>
