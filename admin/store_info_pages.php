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
            <td class="pageHeading"><?php echo "Edit Store Information Pages"; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
     </tr>

<!-- body_text //-->
    <td width="100%" valign="top">
      <!-- Start of edit header //-->

		<div class="helpText">

      <p>This screen allows you to edit the contents of the store information pages shown at the bottom of your store.  The two pieces of information that look like this:</p>
      <ul>
      	<li>%%STORE_NAME%%
      	<li>%%STORE_OWNER_EMAIL_ADDRESS%%
      </ul
      <p> are automatically modified in your store to show the store name and store owner email address that you specify when you click on &quot;Configuration-&gt;My Store&quot; from the menu above.</p>

<form action="store_info_pages.php" method="POST">

  <script language="Javascript1.2"><!-- // load htmlarea
  //MaxiDVD Added WYSIWYG HTML Area Box + Admin Function v1.6.5 Products Description HTML - Head
        _editor_url = "<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_ADMIN; ?>htmlarea/";  // URL to htmlarea files
          var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
           if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
            if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
             if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
         <?php if (HTML_AREA_WYSIWYG_BASIC_DEFINE == 'Basic'){ ?>  if (win_ie_ver >= 5.5) {
         document.write('<scr' + 'ipt src="' +_editor_url+ 'editor_basic.js"');
         document.write(' language="Javascript1.2"></scr' + 'ipt>');
            } else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
         <?php } else{ ?> if (win_ie_ver >= 5.5) {
         document.write('<scr' + 'ipt src="' +_editor_url+ 'editor_advanced.js"');
         document.write(' language="Javascript1.2"></scr' + 'ipt>');
            } else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
         <?php }?>
  // --></script>

<?php

if($HTTP_POST_VARS['action'] == 'save')
{
	$new_file = fopen(DIR_FS_CATALOG . DIR_WS_INCLUDES . "editable_shipping.php", 'w');
    $file_contents = stripslashes($HTTP_POST_VARS['shipping_contents']);
   	$file_contents = preg_replace("/%%STORE_NAME%%/", "<!--store_name_begin-->" . STORE_NAME . "<!--store_name_end-->", $file_contents);
	$file_contents2 = preg_replace("/%%STORE_OWNER_EMAIL_ADDRESS%%/", "<!--store_owner_email_address_begin-->" . STORE_OWNER_EMAIL_ADDRESS . "<!--store_owner_email_address_end-->", $file_contents2);
    fwrite($new_file, $file_contents, strlen($file_contents));
    fclose($new_file);

    $new_file2 = fopen(DIR_FS_CATALOG . DIR_WS_INCLUDES . "editable_privacy.php", 'w');
	$file_contents2 = stripslashes($HTTP_POST_VARS['privacy_contents']);
	$file_contents2 = preg_replace("/%%STORE_NAME%%/", "<!--store_name_begin-->" . STORE_NAME . "<!--store_name_end-->", $file_contents2);
	$file_contents2 = preg_replace("/%%STORE_OWNER_EMAIL_ADDRESS%%/", "<!--store_owner_email_address_begin-->" . STORE_OWNER_EMAIL_ADDRESS . "<!--store_owner_email_address_end-->", $file_contents2);
	fwrite($new_file2, $file_contents2, strlen($file_contents2));
    fclose($new_file2);

    $new_file3 = fopen(DIR_FS_CATALOG . DIR_WS_INCLUDES . "editable_conditions.php", 'w');
	$file_contents3 = stripslashes($HTTP_POST_VARS['conditions_contents']);
	$file_contents3 = preg_replace("/%%STORE_NAME%%/", "<!--store_name_begin-->" . STORE_NAME . "<!--store_name_end-->", $file_contents3);
	$file_contents3 = preg_replace("/%%STORE_OWNER_EMAIL_ADDRESS%%/", "<!--store_owner_email_address_begin-->" . STORE_OWNER_EMAIL_ADDRESS . "<!--store_owner_email_address_end-->", $file_contents3);
	fwrite($new_file3, $file_contents3, strlen($file_contents3));
    fclose($new_file3);

    echo('<h3>Store Info Pages Saved!</h3>');
}

?>

</div><br>

<?php
	print '<h4>Shipping &amp; Returns Policy</h4>';
    $shipping_path = DIR_FS_CATALOG . DIR_WS_INCLUDES . "editable_shipping.php";
    $shipping_file = fopen($shipping_path, "r");
	$shipping_contents = fread($shipping_file, filesize($shipping_path));
	$shipping_contents = preg_replace("/\<\!--store_name_begin--\>.*\<\!--store_name_end--\>/", "%%STORE_NAME%%", $shipping_contents);
	$shipping_contents = preg_replace("/\<\!--store_owner_email_address_begin--\>.*\<\!--store_owner_email_address_end--\>/", "%%STORE_OWNER_EMAIL_ADDRESS%%", $shipping_contents);
	echo escs_draw_textarea_field('shipping_contents', 'soft', '80', '20', $shipping_contents, '') . '<p>';


	print '<h4>Privacy Policy</h4>';
	$privacy_path = DIR_FS_CATALOG . DIR_WS_INCLUDES . "editable_privacy.php";
	$privacy_file = fopen($privacy_path, "r");
	$privacy_contents = fread($privacy_file, filesize($privacy_path));
	fclose($privacy_file);
	$privacy_contents = preg_replace("/\<\!--store_name_begin--\>.*\<\!--store_name_end--\>/", "%%STORE_NAME%%", $privacy_contents);
	$privacy_contents = preg_replace("/\<\!--store_owner_email_address_begin--\>.*\<\!--store_owner_email_address_end--\>/", "%%STORE_OWNER_EMAIL_ADDRESS%%", $privacy_contents);

	echo escs_draw_textarea_field('privacy_contents', 'soft', '80', '20', $privacy_contents, '') . '<p>';

	print '<h4>Conditions Of Use</h4>';
	$conditions_path = DIR_FS_CATALOG . DIR_WS_INCLUDES . "editable_conditions.php";
	$conditions_file = fopen($conditions_path, "r");
	$conditions_contents = fread($conditions_file, filesize($conditions_path));
	fclose($conditions_file);
	$conditions_contents = preg_replace("/\<\!--store_name_begin--\>.*\<\!--store_name_end--\>/", "%%STORE_NAME%%", $conditions_contents);
	$conditions_contents = preg_replace("/\<\!--store_owner_email_address_begin--\>.*\<\!--store_owner_email_address_end--\>/", "%%STORE_OWNER_EMAIL_ADDRESS%%", $conditions_contents);

	echo escs_draw_textarea_field('conditions_contents', 'soft', '80', '20', $conditions_contents, '') . '<p>';

?>

  <?php if (HTML_AREA_WYSIWYG_DISABLE_DEFINE == 'Disable') {} else { ?>
      <script language="JavaScript1.2" defer>
          // MaxiDVD Added WYSIWYG HTML Area Box + Admin Function v1.6.5 Products Description HTML - Body
             var config = new Object();  // create new config object
             config.width = "<?php echo DEFINE_MAINPAGE_WYSIWYG_WIDTH; ?>px";
             config.height = "<?php echo DEFINE_MAINPAGE_WYSIWYG_HEIGHT; ?>px";
             config.bodyStyle = 'background-color: <?php echo HTML_AREA_WYSIWYG_BG_COLOUR; ?>; font-family: "<?php echo HTML_AREA_WYSIWYG_FONT_TYPE; ?>"; color: <?php echo HTML_AREA_WYSIWYG_FONT_COLOUR; ?>; font-size: <?php echo HTML_AREA_WYSIWYG_FONT_SIZE; ?>pt;';
             config.debug = <?php echo HTML_AREA_WYSIWYG_DEBUG; ?>;
             // More Configs can added here:
             editor_generate('shipping_contents',config);
			 editor_generate('privacy_contents',config);
			 editor_generate('conditions_contents',config);
             // Dreamscape added Dynamic Language Function
  </script>
  <?php } ?>

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
