<?php
/*
  $Id: allprods.php,v 1.7 2002/12/02

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com
  Copyright (c) 2002 HMCservices

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ALLPRODS);

// Set number of columns in listing
define ('NR_COLUMNS', 1);
//
  $breadcrumb->add(HEADING_TITLE, escs_href_link(FILENAME_ALLPRODS, '', 'NONSSL'));

  $content = CONTENT_ALLPRODS;

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>