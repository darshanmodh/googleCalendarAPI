<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/calendarlist.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" href="images/ico/favicon_v2013_<?php $dayIcon = date("j"); echo $dayIcon.".ico"; ?>" rel="icon"> 
<title>Google Events</title>
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
	echo "<h1>Modify Events</h1>";
		if(isset($_POST['modifyevent'])){ 
			  $link = $_POST['darsh'];
			  $result = mysql_query("SELECT * FROM google WHERE uid=$_SESSION[uid]");
			  while($row = mysql_fetch_array($result))
			  {
				  $uid = $row["uid"];
				  $uname = $row["uname"];
				  $user = $row["googleuname"];
				  $pass = $row["googlepass"];
			  }
		 $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; // predefined service name for calendar
		 
		  try{
			$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
			
			$service = new Zend_Gdata_Calendar($client);
			try {
			 		$event = $service->getCalendarEventEntry($link);
					$event->title = $service->newTitle($_POST['eventname']);
					$event->where = array($service->newWhere($_POST['eventloc']));
					$event->content = $service->newContent($_POST['eventdesc']);
					$when = $service->newWhen();
					$when->startTime = $_POST['startdate'];
					$when->endTime = $_POST['enddate'];
					//$when->startTime = "{2013-12-28}T{22:00}:00.000{+05}:{30}";
					//$when->endTime = "{2013-12-28}T{23:00}:00.000{+05}:{30}";
					$event->when = array($when);
					$event->save();
			
				} catch (Zend_Gdata_App_Exception $e) {
					die("Error: " . $e->getResponse());
				}
				header('Location:modifyevent.php?flag=1'); 
			}//try
			catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				echo "<h2>Internet Connection Error</h2>";
			}
		}//button is pressed
		else{
			$link = $_GET['link'];
			  $result = mysql_query("SELECT * FROM google WHERE uid=$_SESSION[uid]");
			  while($row = mysql_fetch_array($result))
			  {
				  $uid = $row["uid"];
				  $uname = $row["uname"];
				  $user = $row["googleuname"];
				  $pass = $row["googlepass"];
			  }
		 $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; // predefined service name for calendar
		 
		  try{
			$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
			
			$service = new Zend_Gdata_Calendar($client);
			try {
			 		$event = $service->getCalendarEventEntry($link);
					//for fetching existing data
				} catch (Zend_Gdata_App_Exception $e) {
					die("Error: " . $e->getResponse());
				} 
			}//try
			catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				echo "<h2>Internet Connection Error</h2>";
			}
			?>
              <form name="modifyeventform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
        <h3>Enter the information of event to modify event in Google Calendar.</h3>
        <center>
        <table border="0" cellpadding="5" cellspacing="5">
        <tr>
    <th scope="col" align="left">Event Name<sup style="color:#F00">*</sup></th>
    <th scope="col"><input type="text" name="eventname" placeholder="Event Name" required="required" value="<?php echo $event->title; ?>" /></th>
    	</tr>
        <tr>
    <th scope="col" align="left">Event Location</th>
    <th scope="col"><input type="text" name="eventloc" placeholder="Event Location" value="<?php echo $event->where[0]; ?>"/></th>
    	</tr>
        <tr valign="top">
    <th scope="col" align="left">Event Description</th>
    <th scope="col"><textarea cols="17" rows="5" name="eventdesc" placeholder="Event Description"><?php echo $event->content; ?></textarea></th>
    	</tr>
        <tr>
    <th scope="col" align="left">Start Date<sup style="color:#F00">**</sup></th>
    <th scope="col"><input type="text" name="startdate" placeholder="Format : YYYY-MM-DD" required="required" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" oninvalid="setCustomValidity('Enter Date as format:YYYY-MM-DD')" onchange="try{setCustomValidity('')}catch(e){}" value="<?php $when = $service->newWhen();
echo $when->startTime; ?>" /></th>
    	</tr>
        <tr>
    <th scope="col" align="left">End Date<sup style="color:#F00">**</sup></th>
    <th scope="col"><input type="text" name="enddate" placeholder="Format : YYYY-MM-DD" required="required" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" oninvalid="setCustomValidity('Enter Date as format:YYYY-MM-DD')" onchange="try{setCustomValidity('')}catch(e){}" value="<?php $when = $service->newWhen();
echo $when->endTime; ?>"/></th>
    	</tr>
    	<tr>
        <input type="hidden" name="darsh" value="<?php echo $link ?>" />
    <th scope="col"></th>
    <th scope="col"><input type="submit" value="Submit" name="modifyevent" /></th>
    	</tr></table>
            </center>
            <sup style="color:#F00">*</sup> Mandatory Fields<br />
            <sup style="color:#F00">**</sup> Event's time boundry will not be change.<br />
            </fieldset>
        </form>
              <?php
		  }//button is not pressed
	}//uid is set
}//type is user
else{
	header("Location: invalid.php");
}
?>
</body>
</html>