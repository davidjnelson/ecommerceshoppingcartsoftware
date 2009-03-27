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
            <td class="pageHeading"><?php echo "Edit Color Scheme"; ?></td>
            <td class="pageHeading" align="right"><?php echo escs_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
     </tr>

<!-- body_text //-->
    <td width="100%" valign="top">
      <!-- Start of edit color scheme //-->

      <div class="helpText">

<?php

if($HTTP_GET_VARS['action'] == 'save')
{
	// to install a color scheme, we need to copy all the button images and stylesheet from the DIR_FS_CATALOG . includes/
	// color_schemes/
	// folder to the root catalog folder (for stylesheet) and the DIR_FS_CATALOG . \includes\languages\english\
	// images\buttons folder...

	// first, copy the stylesheet
	copy(DIR_FS_CATALOG . DIR_WS_INCLUDES . 'color_schemes/' . $HTTP_GET_VARS['scheme_id'] . '/stylesheet.css',
	  DIR_FS_CATALOG . 'stylesheet.css');

	// next, copy all the button images
	if ($handle = opendir(DIR_FS_CATALOG . DIR_WS_INCLUDES . 'color_schemes/' . $HTTP_GET_VARS['scheme_id']))
	{

	    /* This is the correct way to loop over the directory. */
	    while (false !== ($file = readdir($handle)))
	    {
	        if($file != '.' && $file != '..')
	        {
  	        	copy(DIR_FS_CATALOG . DIR_WS_INCLUDES . 'color_schemes/' . $HTTP_GET_VARS['scheme_id'] . '/' . $file,
	        	  DIR_FS_CATALOG . DIR_WS_INCLUDES . 'languages/english/images/buttons/' . $file);
	    	}
	    }

	    closedir($handle);
	}


	// notify the user

    echo('<h3>Color Scheme Changed To ' . $HTTP_GET_VARS['scheme_name'] . '!</h3>');

    // easy as pie!
}

?>

<p>Please click on the color scheme that you would like to use:</p>

</div><br>

<a href="edit_color_scheme.php?action=save&scheme_name=Light%20Blue&scheme_id=1">Light Blue</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Light%20Grey&scheme_id=2">Light Grey</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Dark%20Blue,%20Dark%20Grey,%20and%20Yellow&scheme_id=3">Dark Blue, Dark Grey, and Yellow</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Aqua&scheme_id=4">Aqua</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Emerald%20Green&scheme_id=5">Emerald Green</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Orange&scheme_id=6">Orange</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Pink&scheme_id=7">Pink</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Black%20And%20White&scheme_id=8">Black And White</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Maroon&scheme_id=9">Maroon</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Purple&scheme_id=10">Purple</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Yellow%20And%20Black&scheme_id=11">Yellow And Black</a><br>
<a href="edit_color_scheme.php?action=save&scheme_name=Green%20And%20Orange&scheme_id=12">Green And Orange</a><br>




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
