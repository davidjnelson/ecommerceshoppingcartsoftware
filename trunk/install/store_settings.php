<?

# STORE_NAME
# STORE_OWNER
# STORE_OWNER_EMAIL
# EMAIL_FROM
# STORE_COUNTRY
# STORE_ZONE

$store_name = $HTTP_GET_VARS['store_name'];
$store_owner = $HTTP_GET_VARS['store_owner'];
$store_owner_email = $HTTP_GET_VARS['store_owner_email'];
$email_from = $store_owner_email;
$store_country = $HTTP_GET_VARS['store_country'];
$store_zone = $HTTP_GET_VARS['store_zone'];
$store_name_address = $HTTP_GET_VARS['store_name_address'];

$db_server = $HTTP_GET_VARS['db_server'];
$db_username = $HTTP_GET_VARS['db_username'];
$db_password = $HTTP_GET_VARS['db_password'];
$db_database = $HTTP_GET_VARS['db_database'];

$link = mysql_connect($db_server, $db_username, $db_password) or die("Could not connect");
mysql_select_db($db_database) or die("Could not select database");

$query = "update configuration set configuration_value='$store_name' where configuration_key='STORE_NAME' ";
$result = mysql_query($query, $link) or die("STORE_NAME Query failed" . mysql_error());

$query = "update configuration set configuration_value='$store_owner' where configuration_key='STORE_OWNER' ";
$result = mysql_query($query, $link) or die("STORE_OWNER Query failed");

$query = "update configuration set configuration_value='$store_owner_email' where configuration_key='STORE_OWNER_EMAIL_ADDRESS' ";
$result = mysql_query($query, $link) or die("STORE_OWNER_EMAIL_ADDRESS Query failed");

$query = "update configuration set configuration_value='$email_from' where configuration_key='EMAIL_FROM' ";
$result = mysql_query($query, $link) or die("EMAIL_FROM Query failed");

$query = "update configuration set configuration_value='$store_country' where configuration_key='STORE_COUNTRY' ";
$result = mysql_query($query, $link) or die("STORE_COUNTRY Query failed");

$query = "update configuration set configuration_value='$store_zone' where configuration_key='STORE_ZONE' ";
$result = mysql_query($query, $link) or die("STORE_ZONE Query failed");

$query = "update configuration set configuration_value='$store_name_address' where configuration_key='STORE_NAME_ADDRESS' ";
$result = mysql_query($query, $link) or die("STORE_ZONE Query failed");

for ($i=0; $i<10; $i++) {
  $password .= escs_rand();
}

    $salt = substr(md5($password), 0, 2);

    $md5_password = md5($salt . $db_password) . ':' . $salt;

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

?>

successful
