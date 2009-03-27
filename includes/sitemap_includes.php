<?php
/*
  $Id: sitemap.php,v 1.0 2004/05/21 by johnww (jw at perfectproof.com)

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
  ---------------------------------------------
   Based on Snake SEO (Search Engine Optimizer for Postnuke) by www.snakelab.de
  ---------------------------------------------

*/

// All the information below is designed solely for search engines. It will not appear
// in your normal pages.

define('SITEMAP_DOMAIN', HTTP_SERVER . DIR_WS_HTTP_CATALOG . FILENAME_INDEX);   // URL to your true home page
$store_name = STORE_NAME;
define('SITEMAP_TITLE', $store_name);                              // Page Title
define('SITEMAP_KEYWORDS', '');            // Keywords
define('SITEMAP_DESCRIPTION', '');        // Description
define('SITEMAP_COUNTRYCODE','US');                                             // Country code of site (Optional)
define('SITEMAP_AUTHOR','');                                       // Site Author
define('SITEMAP_EMAIL','');                                 // Contact e-mail
define('SITEMAP_COPYRIGHT','');        // Copyright
define('SITEMAP_CATEGORYLIST','List of product categories');                    // Text displayed at top of sitemap_categories
define('SITEMAP_PRODUCTLIST','List of products');                               // Text displayed at top of sitemap_products
define('SITEMAP_LINKS','');     // Add extra links to other sites



    function redirectBrowser()
    {
        print '<script language="JavaScript" type="text/javascript" src="sitemap.js"></script>';
    }
?>
