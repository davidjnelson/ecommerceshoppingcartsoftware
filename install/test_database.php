<?

ini_set('display_errors', true);
require('includes/application.php');

$db_server = $HTTP_GET_VARS['db_server'];
$db_username = $HTTP_GET_VARS['db_username'];
$db_password = $HTTP_GET_VARS['db_password'];
$db_database = $HTTP_GET_VARS['db_database'];
$link = mysql_connect($db_server, $db_username, $db_password) or die("error");
    if (!@osc_db_select_db($db_database)) {
      if (@osc_db_query('create database ' . $db_database)) {
        osc_db_select_db($db_database);
      } else {
        print 'error';
      }
    }
    print 'successful';
?>
