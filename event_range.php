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
	echo "<h1>Events between two dates</h1>";
		  if(isset($_POST['getevent'])){
			  $result = mysql_query("SELECT * FROM google WHERE uid=$_SESSION[uid]");
			  while($row = mysql_fetch_array($result))
			  {
				  $uname = $row["uname"];
				  $user = $row["googleuname"];
				  $pass = $row["googlepass"];
			  }
		 $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; // predefined service name for calendar
		 $start = $_POST['start'];
		 $end = $_POST['end'];
		  try{
			$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
			
			$service = new Zend_Gdata_Calendar($client);
					
			$query = $service->newEventQuery();
			// Set different query parameters
			$query->setUser('default');
			$query->setVisibility('private');
			$query->setProjection('full');
			$query->setOrderby('starttime');
			// Start date from where to get the events
			$query->setStartMin("$start");
			// End date
			$query->setStartMax("$end");
			
			// Get the event list
			try {
				$eventFeed = $service->getCalendarEventFeed($query);
			} catch (Zend_Gdata_App_Exception $e) {
				echo "Error: " . $e->getMessage();
			}
			echo "<h3>Events between $start and $end </h3>";
				echo "<table border='5' align='center' cellpadding='5' cellspacing='3' bordercolor='#666666'>
					<tr bgcolor='#669900'><th>Event Name</th>
						<th>Event Time</th></tr>";
			foreach ($eventFeed as $event) {
				echo "<tr><td>".$event->title."</td>";
				$when = $event->getWhen();
				echo "<td>".$when[0]->getStartTime()."</td></tr>";
			}
			echo "</table>";
			
			}//try
			catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				echo "<h2>Internet Connection Error</h2>";
			}
		  }//button is pressed
		  else{
			  ?>
              <form name="holidayForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
        <h3>Select start and end dates to view events</h3>
        <center>
        <table border="0" cellpadding="5" cellspacing="5">
 	 	<tr>
    <th scope="col">Starting Date<sup>*</sup></th>
    <th scope="col"><input type="date" name="start" required="required" /></th>
    	</tr>
        <tr>
    <th scope="col">Ending Date<sup>*</sup></th>
    <th scope="col"><input type="date" name="end" required="required" /></th>
    	</tr>
    	<tr>
    <th scope="col"></th>
    <th scope="col"><input type="submit" value="Submit" name="getevent" /></th>
    	</tr></table>
            </center>
            * Dates should be in DD-MMM-YYYY format.
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