<?php

/*

  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


  OSC-Affiliate



  Contribution based on:



  osCommerce, Open Source E-Commerce Solutions

  http://www.oscommerce.com



  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com



  Released under the GNU General Public License

*/



  require('includes/application_top.php');



  if (in_array('remove_current_page',get_class_methods($navigation)) ) $navigation->remove_current_page();



  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_SUMMARY);

?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">

<html <?php echo HTML_PARAMS; ?>>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">

<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">

<title><?php echo TITLE; ?></title>

<link rel="stylesheet" type="text/css" href="stylesheet.css">

</head>

<style type="text/css"><!--

BODY { margin-bottom: 10px; margin-left: 10px; margin-right: 10px; margin-top: 10px; }

//--></style>

<body marginwidth="10" marginheight="10" topmargin="10" bottommargin="10" leftmargin="10" rightmargin="10">



<?php

  $info_box_contents = array();

  $info_box_contents[] = array('text' => HEADING_SUMMARY_HELP);



  new infoBoxHeading($info_box_contents, true, true);



  $info_box_contents = array();

  $info_box_contents[] = array('text' => TEXT_COMMISSION_RATE_HELP);



  new infoBox($info_box_contents);

?>



<p class="smallText" align="right"><?php echo '<a href="javascript:window.close()">' . TEXT_CLOSE_WINDOW . '</a>'; ?></p>



</body>

</html>

<?php require('includes/application_bottom.php'); ?>