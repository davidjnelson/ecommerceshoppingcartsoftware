<?
	$script_filename = $_SERVER['SCRIPT_FILENAME'];
	$array = preg_split("/\//", $script_filename);
	// this should give us the directory name the script is running in,
	// ie: in my test httpdocs
	print '%%%' . $array[sizeof($array)-2] . '%%%';
?>
