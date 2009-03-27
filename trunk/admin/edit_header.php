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
            <td class="pageHeading"><?php echo "Edit Header"; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
     </tr>

<!-- body_text //-->
    <td width="100%" valign="top">
      <!-- Start of edit header //-->

<form action="edit_header.php" method="POST">

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
	$new_file = fopen(DIR_FS_CATALOG . DIR_WS_INCLUDES . "editable_header.php", 'w');
    $file_contents = stripslashes($HTTP_POST_VARS['file_contents']);
    fwrite($new_file, $file_contents, strlen($file_contents));
    fclose($new_file);
    echo('<div class="helpText">Header Saved!</div><br>');
}

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
             // Dreamscape added Dynamic Language Function
          editor_generate('file_contents',config);
  </script>

<?php
    }
    $header_path = DIR_FS_CATALOG . DIR_WS_INCLUDES . "editable_header.php";
    $file = fopen($header_path, "r");
	$file_contents = fread($file, filesize($header_path));
    fclose($file);
	echo escs_draw_textarea_field('file_contents', 'soft', '80', '20', $file_contents, '');

?>
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
