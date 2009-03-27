<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); ?>
<title><?php echo META_TAG_TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<?php if ($javascript) { require(DIR_WS_JAVASCRIPT . $javascript); } ?>
<script language="javascript">
	function mOvr(src,clrOver) { if (!src.contains(event.fromElement)) {
		src.style.cursor = 'hand';
		src.bgColor = clrOver;
		}
	}
	function mOut(src,clrIn) { if (!src.contains(event.toElement)) { src.style.cursor = 'default'; src.bgColor = clrIn; } }
	function mClk(src) { if(event.srcElement.tagName=='TD') { src.children.tags('A')[0].click(); } }
</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<table align="center" width="750" border="0"  cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td>
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>

<div align="center">
<table>
	<?php require(DIR_WS_BOXES . 'search.php'); ?>
</table>
</div>

<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'editable_header.php'); ?>
<!-- header_eof //-->

<table border="0" width="100%" cellspacing="0" cellpadding="8">
  <tr valign="top">
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="0">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- content //-->
    <td width="100%" valign="top">

<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td bgcolor="#000000">
<?php if (escs_session_is_registered('customer_id')) { ?>
	<table border="0" width="100%" cellspacing="1" cellpadding="6" border="0">
		<tr valign="top">
			<td align="center" width="25%" class="infoBoxHeading">
				<a href="<?php echo escs_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="boxTextNoRollover"><?php echo HEADER_TITLE_LOGOFF; ?></a>
			</td>
			<td align="center" width="25%" class="infoBoxHeading">	<a href="<?php echo escs_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="boxTextNoRollover">
				<?php echo HEADER_TITLE_MY_ACCOUNT; ?></a>
			</td>
			<td align="center" width="25%" class="infoBoxHeading">	<a href="<?php echo escs_href_link(FILENAME_SHOPPING_CART); ?>" class="boxTextNoRollover">
				<?php echo HEADER_TITLE_CART_CONTENTS; ?></a>
			</td>
			<td align="center" width="25%" class="infoBoxHeading">	<a href="<?php echo escs_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="boxTextNoRollover">
				<?php echo HEADER_TITLE_CHECKOUT; ?></a>
			</td>
		</tr>
	</table>
<? } else { ?>

	<table border="0" width="100%" cellspacing="1" cellpadding="6" border="0">
		<tr valign="top">
			<td align="center" width="33%" class="infoBoxHeading">	<a href="<?php echo escs_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="boxTextNoRollover">
				<?php echo HEADER_TITLE_MY_ACCOUNT; ?></a>
			</td>
			<td align="center" width="33%" class="infoBoxHeading">	<a href="<?php echo escs_href_link(FILENAME_SHOPPING_CART); ?>" class="boxTextNoRollover">
				<?php echo HEADER_TITLE_CART_CONTENTS; ?></a>
			</td>
			<td align="center" width="34%" class="infoBoxHeading">	<a href="<?php echo escs_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="boxTextNoRollover">
				<?php echo HEADER_TITLE_CHECKOUT; ?></a>
			</td>
		</tr>
	</table>

<?
}
?>
</td>
</tr>
</table>


	<?php
		if (isset($HTTP_GET_VARS['products_id'])) {
	?>
	<table border="0" cellspacing="0" cellpadding="4" width="100%">
		<tr valign="top">
			<td width="33%" align="center">
				<?php include(DIR_WS_BOXES . 'product_notifications.php'); ?>
			</td>
			<td width="33%" align="center">
				<?php require(DIR_WS_BOXES . 'manufacturer_info.php'); ?>
			</td>
			<td width="33%" align="center">
				<?php
					if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND)
					{
						include(DIR_WS_BOXES . 'tell_a_friend.php');
					}
				?>
			</td>
		</tr>
	</table>
	<?php
	}
	?>


<?php echo $breadcrumb->trail(' <font size="-2">&gt;&gt;</font> '); ?><br><br>

<!-- table to restrict content in center box November 2003 -->
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><?php
  if (isset($content_template)) {
    require(DIR_WS_CONTENT . $content_template);
  } else {
    require(DIR_WS_CONTENT . $content . '.tpl.php');
  }
?>
    </td>
  </tr>
</table>
<!-- table for center box area -->








    </td>
<!-- content_eof //-->
  </tr>
  <tr>
    <td colspan="2">
      	<table border="0" cellspacing="0" cellpadding="4" width="100%">
	  		<tr valign="top">
	  			<td width="33%" align="center">
	  				<table width="100%">
	  					<?php include(DIR_WS_BOXES . 'best_sellers.php'); ?>
	  				</table>
	  			</td>
	  			<td width="33%" align="center">
	  				<table width="100%">
	  					<?php include(DIR_WS_BOXES . 'specials.php'); ?>
	  				</table>
	  			</td>
	  			<td width="33%" align="center">
	  				<table width="100%">
	  					<?php require(DIR_WS_BOXES . 'whats_new.php'); ?>
	  				</table>
	  			</td>
	  		</tr>
  	      </table>
  	  </td>
  </tr>
  <tr>
  	<td colspan="2">
  	  <table width="100%">
	  	<?php
	  		require(DIR_WS_BOXES . 'information.php');
	  	?>
	  </table>

	  <!-- footer //-->

	  <?php require(DIR_WS_INCLUDES . 'editable_footer.php'); ?>

	  <table border="0" width="100%" cellspacing="0" cellpadding="0">
	    <tr>
	      <td align="center" class="smallText">
	  <?
	    echo FOOTER_TEXT_BODY
	  ?>

	      <p>&nbsp;</p></td>
	    </tr>
      </table>
    </td>
  </tr>

</table>

  <!-- closing tags of 750 pixel table -->


  </td>
    </tr>
</table>


<!-- footer_eof //-->

<!-- body_eof //-->



<?php
  if ($banner = escs_banner_exists('dynamic', '468x50')) {
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><?php echo escs_display_banner('static', $banner); ?></td>
  </tr>
</table>
<?php
  }
?>

</body>
</html>
