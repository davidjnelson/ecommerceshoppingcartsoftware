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
    osc_db_install($db_database, $sql_file);

?>

successful
