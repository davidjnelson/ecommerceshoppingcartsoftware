<?
/*

	Live Support v 1.2b
	Author: Mike Lessar <mlessar@bluetruck.net>

	for use with:
	Ecommerce Shopping Cart Software
	http://www.ecommerceshoppingcartsoftware.org

	Released under the GNU General Public License

*/

require('includes/application_top.php');
?>
<html>
<head>
<title>Live Support Call Waiting</title>
<script lnaguage="javascript">
	var limit="0:5"
	if (document.images){
		var parselimit=limit.split(":")
		parselimit=parselimit[0]*60+parselimit[1]*1
	}
	function beginrefresh(){
		if (!document.images)
			return
		if (parselimit==1)
			window.location.reload() && window.scroll(0,20000)
		else{
			parselimit-=1
			curmin=Math.floor(parselimit/60)
			cursec=parselimit%60
		if (curmin!=0)
			curtime=curmin+" minutes and "+cursec+" seconds left until page refresh!"
		else
			curtime=cursec+" seconds left until page refresh!"
			setTimeout("beginrefresh()",1000)
		}
	}
	window.onload=beginrefresh

	var win = null;
	function NewWindow(mypage,myname,w,h,scroll){
		LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
		TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
		settings =
		'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
		win = window.open(mypage,myname,settings)
	}
</script>

</head>
<body>
<?
$status_query = escs_db_query("select status from " . TABLE_LS_TECHS . " a where tech_id ='1' ");
while ($status = escs_db_fetch_array($status_query)) {
	if($status['status'] == 'yes') {
		echo "<p align=\"center\"><b style=\"font-size:16pt;\">Waiting for Calls!</b></p>\n";
		$i = 0;
		$conversation_query = escs_db_query("select guest, session_id from " . TABLE_LS_CONVERSATIONS . " a where tech ='Sales' ");
		while ($conversation =escs_db_fetch_array($conversation_query)) {
			$i++;
		}
		if($i > 0) {
			echo "<script>NewWindow('ls_newcall.php','conversation','280','320','no')</script>\n";
		}
	}
	if($status['status'] == 'busy') {
		echo "<p align=\"center\"><b style=\"font-size:16pt;\">Busy!</b></p>\n";
	}
}
?>
</body>
</html>

