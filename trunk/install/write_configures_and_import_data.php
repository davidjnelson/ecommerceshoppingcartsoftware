<?

// toggle error reporting

ini_set('display_errors', true);
$debug = "true";

// require application functions

require('includes/application.php');

// -------------

// query system for application environment related variables

  $db = array();
  $db_error = false;
  $script_filename = getenv('PATH_TRANSLATED');
  if (empty($script_filename)) {
    $script_filename = getenv('SCRIPT_FILENAME');
  }
  $script_filename = str_replace('\\', '/', $script_filename);
  $script_filename = str_replace('//', '/', $script_filename);
  $dir_fs_www_root_array = explode('/', dirname($script_filename));
  $dir_fs_www_root = array();
  for ($i=0, $n=sizeof($dir_fs_www_root_array)-1; $i<$n; $i++) {
    $dir_fs_www_root[] = $dir_fs_www_root_array[$i];
  }
  $dir_fs_document_root = implode('/', $dir_fs_www_root) . '/';
  $sql_file = $dir_fs_document_root . 'install/db.sql';
  $db_server = trim(stripslashes($HTTP_GET_VARS['db_server']));
  $db_username = trim(stripslashes($HTTP_GET_VARS['db_username']));
  $db_password = trim(stripslashes($HTTP_GET_VARS['db_password']));
  $db_database = $HTTP_GET_VARS['db_database'];
  $http_server = 'http://' . getenv('SERVER_NAME');
  $http_catalog = $http_server;
  $https_server = 'https://' . getenv('SERVER_NAME');
  $https_catalog = $https_server;
  $http_cookie_path = substr(dirname(getenv('SCRIPT_NAME')), 0, -7);
  $https_cookie_path = $http_cookie_path;
  $www_location = 'http://' . getenv('HTTP_HOST') . getenv('SCRIPT_NAME');
  $www_location = substr($www_location, 0, strpos($www_location, 'install'));
  $http_cookie_domain = getenv('HTTP_HOST');
  $https_cookie_domain = $http_cookie_domain;
  $http_url = parse_url($HTTP_POST_VARS['HTTP_WWW_ADDRESS']);

// print debug vars

if($debug == "true")
{
	print 'http_cookie_path: ' . $http_cookie_path . '<p>';
	print 'https_cookie_path: ' . $http_cookie_path . '<p>';
	print 'www_location: ' . $www_location . '<p>';
	print 'http_catalog: ' . $http_catalog . '<p>';
    print 'https_server: ' . $https_server . '<p>';
    print 'https_catalog: ' . $https_catalog . '<p>';
   	print 'http_cookie_domain: ' . $http_cookie_domain . '<p>';
	print 'https_cookie_domain: ' . $http_cookie_domain . '<p>';
	print 'http_server: ' . $http_server . '<p>';
	print 'script_filename: ' . $script_filename . '<p>';
	print 'dir_fs_document_root: ' . $dir_fs_document_root . '<p>';
}

// install database

	osc_db_connect($db_server, $db_username, $db_password);
    osc_set_time_limit(0);
    if(!osc_db_install($db_database, $sql_file))
    {
    }

// -------------------
// write catalog and admin configure.php files

    $file_contents = '<?php' . "\n" .
                     '/*' . "\n" .
                     '  Ecommerce Shopping Cart Software' . "\n" .
                     '  http://www.ecommerceshoppingcartsoftware.org' . "\n" .
                     '' . "\n" .
                     '  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com' . "\n" .
                     '' . "\n" .
                     '  Released under the GNU General Public License' . "\n" .
                     '*/' . "\n" .
                     '' . "\n" .
                     '// Define the webserver and path parameters' . "\n" .
                     '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                     '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                     '  define(\'HTTP_SERVER\', \'' . $http_server . '\'); // eg, http://localhost - should not be empty for productive servers' . "\n" .
                     "  define('HTTPS_SERVER', '" . $https_server . "'); // eg, https://localhost - should not be empty for productive servers" . "\n" .
                     '  define(\'ENABLE_SSL\', ' . 'true' . '); // secure webserver for checkout procedure?' . "\n" .
                     '  define(\'HTTP_COOKIE_DOMAIN\', \'' . $http_cookie_domain . '\');' . "\n" .
                     '  define(\'HTTPS_COOKIE_DOMAIN\', \'' . $https_cookie_domain . '\');' . "\n" .
                     '  define(\'HTTP_COOKIE_PATH\', \'' . $http_cookie_path . '\');' . "\n" .
                     '  define(\'HTTPS_COOKIE_PATH\', \'' . $https_cookie_path . '\');' . "\n" .
                     '  define(\'DIR_WS_HTTP_CATALOG\', \'/ecommerce_shopping_cart_software/\');' . "\n" .
                     '  define(\'DIR_WS_HTTPS_CATALOG\', \'/ecommerce_shopping_cart_software/\');' . "\n" .
                     '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                     '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                     '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                     '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                     '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                     '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                     '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                     '  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n" .
                     '' . "\n" .
                     '//Added for BTS1.0' . "\n" .
                     '  define(\'DIR_WS_TEMPLATES\', \'templates/\');' . "\n" .
                     '  define(\'DIR_WS_CONTENT\', DIR_WS_TEMPLATES . \'content/\');' . "\n" .
                     '  define(\'DIR_WS_JAVASCRIPT\', DIR_WS_INCLUDES . \'javascript/\');' . "\n" .
                     '//End BTS1.0' . "\n" .
                     '  define(\'DIR_WS_DOWNLOAD_PUBLIC\', \'pub/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\');' . "\n" .
                     '  define(\'DIR_FS_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');' . "\n" .
                     '  define(\'DIR_FS_DOWNLOAD_PUBLIC\', DIR_FS_CATALOG . \'pub/\');' . "\n" .
                     '' . "\n" .
                     '// define our database connection' . "\n" .
                     '  define(\'DB_SERVER\', \'' . $db_server . '\'); // eg, localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'DB_SERVER_USERNAME\', \'' . $db_username . '\');' . "\n" .
                     '  define(\'DB_SERVER_PASSWORD\', \'' . $db_password. '\');' . "\n" .
                     '  define(\'DB_DATABASE\', \'' . $db_database . '\');' . "\n" .
                     '  define(\'USE_PCONNECT\', \'' . 'false' . '\'); // use persistent connections?' . "\n" .
                     '  define(\'STORE_SESSIONS\', \'' . 'mysql' . '\'); // leave empty \'\' for default handler or set to \'mysql\'' . "\n" .
                     '?>';

    $fp = fopen($dir_fs_document_root . 'includes/configure.php', 'w');
    fputs($fp, $file_contents);
    fclose($fp);

    $file_contents = '<?php' . "\n" .
                     '/*' . "\n" .
                     '  Ecommerce Shopping Cart Software' . "\n" .
                     '  http://www.ecommerceshoppingcartsoftware.org' . "\n" .
                     '' . "\n" .
                     '  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com' . "\n" .
                     '' . "\n" .
                     '  Released under the GNU General Public License' . "\n" .
                     '*/' . "\n" .
                     '' . "\n" .
                     '// Define the webserver and path parameters' . "\n" .
                     '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                     '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                     '  define(\'HTTP_SERVER\', \'' . $http_server . '\'); // eg, http://localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'HTTP_CATALOG_SERVER\', \'' . $http_server . '\');' . "\n" .
                     "  define('HTTPS_CATALOG_SERVER', '$https_server');" . "\n" .
                     '  define(\'ENABLE_SSL_CATALOG\', \'' . 'true' . '\'); // secure webserver for catalog module' . "\n" .
                     '  define(\'DIR_FS_DOCUMENT_ROOT\', \'' . $dir_fs_document_root . '\'); // where the pages are located on the server' . "\n" .
                     "  define('DIR_WS_ADMIN', '/ecommerce_shopping_cart_software/admin/'); // absolute path required" . "\n" .
                     '  define(\'DIR_FS_ADMIN\', \'' . $dir_fs_document_root . 'admin/\'); // absolute pate required' . "\n" .
                     "  define('DIR_WS_CATALOG', '/ecommerce_shopping_cart_software/'); // absolute path required" . "\n" .
                     '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\'); // absolute path required' . "\n" .
                     '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                     '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG_IMAGES\', DIR_WS_CATALOG . \'images/\');' . "\n" .
                     '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                     '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                     '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                     '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                     '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                     '  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n" .
                     '  define(\'DIR_WS_CATALOG_LANGUAGES\', DIR_WS_CATALOG . \'includes/languages/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_LANGUAGES\', DIR_FS_CATALOG . \'includes/languages/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_IMAGES\', DIR_FS_CATALOG . \'images/\');' . "\n" .
                     '  define(\'DIR_FS_CATALOG_MODULES\', DIR_FS_CATALOG . \'includes/modules/\');' . "\n" .
                     '  define(\'DIR_FS_BACKUP\', DIR_FS_ADMIN . \'backups/\');' . "\n" .
                     '' . "\n" .
                     '// define our database connection' . "\n" .
                     '  define(\'DB_SERVER\', \'' . $db_server . '\'); // eg, localhost - should not be empty for productive servers' . "\n" .
                     '  define(\'DB_SERVER_USERNAME\', \'' . $db_username . '\');' . "\n" .
                     '  define(\'DB_SERVER_PASSWORD\', \'' . $db_password. '\');' . "\n" .
                     '  define(\'DB_DATABASE\', \'' . $db_database. '\');' . "\n" .
                     '  define(\'USE_PCONNECT\', \'' . 'false' . '\'); // use persisstent connections?' . "\n" .
                     '  define(\'STORE_SESSIONS\', \'' . 'mysql' . '\'); // leave empty \'\' for default handler or set to \'mysql\'' . "\n" .
                     '?>';

    $fp = fopen($dir_fs_document_root . 'admin/includes/configure.php', 'w');
    fputs($fp, $file_contents);
    fclose($fp);
?>

successful
