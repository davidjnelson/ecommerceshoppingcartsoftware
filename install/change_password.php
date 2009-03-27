<?

$db_server = $HTTP_GET_VARS['db_server'];
$db_username = $HTTP_GET_VARS['db_username'];
$db_password = $HTTP_GET_VARS['db_password'];
$db_database = $HTTP_GET_VARS['db_database'];

for ($i=0; $i<10; $i++) {
$password .= escs_rand();
}

$salt = substr(md5($password), 0, 2);

$md5_password = md5($salt . $db_password) . ':' . $salt;

$link = mysql_connect($db_server, $db_username, $db_password);
mysql_select_db($db_database);
$query = "update admin set admin_email_address='$db_username', admin_password='$md5_password'";
$result = mysql_query($query, $link) or die("admin user/pass query failed" . mysql_error());

function escs_rand($min = null, $max = null) {
static $seeded;

if (!isset($seeded)) {
mt_srand((double)microtime()*1000000);
$seeded = true;
}

if (isset($min) && isset($max)) {
if ($min >= $max) {
return $min;
} else {
return mt_rand($min, $max);
}
} else {
return mt_rand();
}
}

print 'password successfully changed to your database username/password!';
?>