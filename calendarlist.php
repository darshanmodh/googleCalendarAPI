<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/calendarlist.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" href="images/ico/favicon_v2013_<?php $dayIcon = date("j"); echo $dayIcon.".ico"; ?>" rel="icon"> 
<title>Untitled Document</title>
</head>

<body>
<?php
ini_set('display_errors', '0');     # don't show any errors...
error_reporting(E_ALL | E_STRICT);  # ...but do log them

$path = 'C:\wamp\www\ZendGdata-1.12.3\library';
// Append the library path to existing paths
$oldPath = set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Calendar');

include("connection.php");
session_start();
define('ACCESS', TRUE);
require_once('userheader.php');

if($_SESSION['type'] == "user"){
	if(isset($_SESSION['uid'])){
		$result = mysql_query("SELECT * FROM google WHERE uid=$_SESSION[uid]");

		while($row = mysql_fetch_array($result))
		  {
			  $uname = $row["uname"];
			  $user = $row["googleuname"];
			  $pass = $row["googlepass"];
		  }
		  $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; // predefined service name for calendar
		  
			try{
				$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
				
				$service = new Zend_Gdata_Calendar($client);
				
				// Get the calendar list feed
				$listFeed = $service->getCalendarListFeed();
				
				echo "<h1>Calendar List</h1>";
				echo "<table border='5' align='center' cellpadding='5' cellspacing='3' bordercolor='#666666'>
					<tr bgcolor='#669900'><th>Calendar Name</th>
						<th>Calendar Feed Link</th></tr>";
				echo "<ol>";
				foreach ($listFeed as $calendar) {
					echo "<tr bgcolor='#669966'><td>" . $calendar->title . "</td><td><a title='Authorization Required' href='". $calendar->id ."'>" . $calendar->id . "</a></td></tr>";
				}
				echo "</ol></table>";
			}//try
			catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				echo "<h2>Internet Connection Error</h2>";
			}
	}//uid is set
}//type is user
else{
	header("Location: invalid.php");
}
?>
</body>
</html>