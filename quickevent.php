<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/calendarlist.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" href="images/ico/favicon_v2013_<?php $dayIcon = date("j"); echo $dayIcon.".ico"; ?>" rel="icon"> 
<title>Quick Event</title>
</head>

<body>
<?php
if($_GET['flag']==1){
	echo "<script>alert('Event is added Successfully in Google Calendar.')</script>";
}

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
		echo "<h1>Quick Event</h1>";
		
		if(isset($_POST['quickevent'])){
			  $result = mysql_query("SELECT * FROM google WHERE uid=$_SESSION[uid]");
			  while($row = mysql_fetch_array($result))
			  {
				  $uname = $row["uname"];
				  $user = $row["googleuname"];
				  $pass = $row["googlepass"];
			  }
		 $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; // predefined service name for calendar
		 $eventdesc = $_POST['eventdesc'];
		  try{
			$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
			
			$service = new Zend_Gdata_Calendar($client);
			
			// Create a new entry using the calendar service's magic factory method
			$event= $service->newEventEntry();
 
			// Populate the event with the desired information
			$event->content= $service->newContent("$eventdesc");
			$event->quickAdd = $service->newQuickAdd("true");
			 
			// Upload the event to the calendar server
			// A copy of the event as it is recorded on the server is returned
			$newEvent = $service->insertEvent($event);
			
			header('Location:quickevent.php?flag=1');
			}//try
			catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				echo "<h2>Internet Connection Error</h2>";
			}
		  }//button is pressed
		  else{
			  ?>
              <form name="quickeventform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
        <h3>Enter the Event description with title, time, date and place.</h3>
        <center>
        <table border="0" cellpadding="5" cellspacing="5">
        <tr valign="top">
    <th scope="col">Event Description<sup>*</sup></th>
    <th scope="col"><textarea name="eventdesc" cols="30" rows="5" placeholder="Enter Event Description"></textarea></th>
    	</tr>
    	<tr>
    <th scope="col"></th>
    <th scope="col"><input type="submit" value="Submit" name="quickevent" /></th>
    	</tr></table>
            </center>
            * For Example, Dinner at Joe's Diner on Thursday at 20:00
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