<?php
/*
  Created by: Linda McGrath osCOMMERCE@WebMakers.com

  Update by: fram 05-05-2003
  Updated by: Donald Harriman - 08-08-2003 - MS2

  down_for_maintenance.php v1.1

  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . DOWN_FOR_MAINTENANCE_FILENAME);

  $breadcrumb->add(NAVBAR_TITLE, escs_href_link(DOWN_FOR_MAINTENANCE_FILENAME));

  $content = CONTENT_DOWN_FOR_MAINT;

  require(DIR_WS_TEMPLATES . TEMPLATENAME_MAIN_PAGE);


 require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>