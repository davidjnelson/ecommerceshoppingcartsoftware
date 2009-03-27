<?php
/*
  $Id: catalog_products_with_images.php V 3.0
  by Tom St.Croix <managememt@betterthannature.com> V 3.0

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License

  notes: added to the catalog/includes/languages/english.php
  define('IMAGE_BUTTON_UPSORT', 'Sort Asending');
  define('IMAGE_BUTTON_DOWNSORT', 'Sort Desending');
*/
  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CATALOG_PRODUCTS_WITH_IMAGES);

  // Use $location if you have a pre breadcrumb release of OSC then comment out $breadcrumb line
  //$location = ' &raquo; <a href="' . escs_href_link(FILENAME_CATALOG_PRODUCTS_WITH_IMAGES, '', 'NONSSL') . '" class="headerNavigation">' . NAVBAR_TITLE . '</a>';

  // Use $breadcrumb if you have a breadcrumb release of OSC then comment out $location line
  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(FILENAME_CATALOG_PRODUCTS_WITH_IMAGES, '', 'NONSSL'));

  $content = CONTENT_PRINTABLE_CATALOG;

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);



   require(DIR_WS_INCLUDES . 'application_bottom.php');

?>