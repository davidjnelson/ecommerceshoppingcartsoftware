<?php
/*
  $Id$

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
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
            <td class="pageHeading"><?php echo "Edit SSL Security Web Address"; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
     </tr>

<!-- body_text //-->
    <td width="100%" valign="top">
      <!-- Start of edit header //-->

      <div class="helpText">

<p>Enter the URL (web address) that your web host has given you to use for processing secure transactions over SSL (secure sockets layer).</p>

<p><b>Important!  Do NOT end your ssl address with a trailing slash.  It should look like:  <br>&nbsp;<br>mydomain.com<br>-or-<br>
www.mydomain.com</b></p>

<form action="ssl_security.php" method="POST">

<?php

if($HTTP_POST_VARS['action'] == 'save')
{
	// set path
	$config_path = DIR_FS_CATALOG . "admin/includes/configure.php";

	// read from disk
	$file = fopen($config_path, "r");
	$file_contents = fread($file, filesize($config_path));
    fclose($file);

	// get ssl address from submitted form value, regexing out any accidentally/erroneously inputted http:// or https:// strings
	$ssl_address_here = $HTTP_POST_VARS['ssl_address'];
	$ssl_address_here = preg_replace("/http:\/\//s", "", $ssl_address_here);
	$ssl_address_here = preg_replace("/https:\/\//s", "", $ssl_address_here);

	// perform regex on in-memory string to update
	$file_contents = preg_replace("/define\('HTTPS_CATALOG_SERVER'.*\);/", "define('HTTPS_CATALOG_SERVER', 'https://" .
		$ssl_address_here . "');", $file_contents);

	// chmod temporarily to writable
	chmod($config_path, '0600');

	// write back to disk
    $new_file = fopen($config_path, 'w');
    fwrite($new_file, $file_contents, strlen($file_contents));
    fclose($new_file);

	// chmod back to not writable
	chmod($config_path, '0400');

	// set path
	$config_path2 = DIR_FS_CATALOG . "includes/configure.php";

	// read from disk
	$file2 = fopen($config_path2, "r");
	$file_contents2 = fread($file2, filesize($config_path2));
    fclose($file2);

	// remove trailing slash in url if user accidentally added one
	//if(substr($ssl_address_here, strlen(ssl_address_here)-1, 1) == '/' ||
	//	substr($ssl_address_here, strlen(ssl_address_here)-1, 1) == '\')
	//{
		print substr($ssl_address_here, strlen(ssl_address_here)-1, 1);
	//}

   	// perform regex on in-memory string to update
	$file_contents2 = preg_replace("/define\('HTTPS_COOKIE_DOMAIN'.*\);/", "define('HTTPS_COOKIE_DOMAIN', '" .
		$ssl_address_here . "');", $file_contents2);
	$file_contents2 = preg_replace("/define\('HTTPS_SERVER'.*\);/", "define('HTTPS_SERVER', 'https://" .
		$ssl_address_here . "');", $file_contents2);

	// chmod temporarily to writable
	chmod($config_path2, '0600');

	// write back to disk
    $new_file2 = fopen($config_path2, 'w');
    fwrite($new_file2, $file_contents2, strlen($file_contents2));
    fclose($new_file2);

    // chmod back to not writable
    chmod($config_path2, '0400');

    // notify user
    echo('<h3>SSL Security Web Address Updated!</h3>');
}

?>

</div><br>

<b>https://</b><input type="text" name="ssl_address" value="<?php if($HTTP_POST_VARS['action'] == 'save') { print $HTTP_POST_VARS['ssl_address']; } else { print preg_replace("/https:\/\//s", "", HTTPS_CATALOG_SERVER); } ?>">
<input type="hidden" name="action" value="save">
<input type="submit" value="Save">

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
