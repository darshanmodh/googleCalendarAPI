<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="application/javascript">
$('#reminder').live("click", function() {
    if (this.checked) {
        $('#divReminder').fadeIn();
    }
    else {
        $('#divReminder').fadeOut();
    }
});
$('#remMin').live("click", function() {
    if (this.checked) {
        $('#divMin').fadeIn();
    }
    else {
        $('#divMin').fadeOut();
    }
});

</script>
<link href="css/calendarlist.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" href="images/ico/favicon_v2013_<?php $dayIcon = date("j"); echo $dayIcon.".ico"; ?>" rel="icon"> 
<title>Single Event</title>
</head>

<body>
<?php
if($_GET['flag']==1){
	echo "<script>alert('Event is added Successfully in Google Calendar.')</script>";
}

$currentdate = date("Y-m-d");
$currenttime = date("H:i");
$hour = date("H") + 1;
$min = date("i");
$advtime = $hour.":".$min;

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
		echo "<h1>Single Event</h1>";
		
		if(isset($_POST['singleevent'])){
			$eventname = $_POST['eventname'];
			$eventloc = $_POST['eventloc'];
			$eventdesc = $_POST['eventdesc'];
			$eventstartdate = $_POST['startdate'];
			$eventstarttime = $_POST['starttime'];
			$eventenddate = $_POST['enddate'];
			$eventendtime = $_POST['endtime'];
			if(isset($_POST['reminder'])){
				$rem = $_POST['rem'];
				$remmin = $_POST['remmin'];
			}
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
			
			// Create a new entry using the calendar service's magic factory method
			$event= $service->newEventEntry();
			 
			// Populate the event with the desired information
			// Note that each attribute is crated as an instance of a matching class
			$event->title = $service->newTitle($eventname);
			$event->where = array($service->newWhere($eventloc));
			$event->content =
				$service->newContent($eventdesc);
			 
			// Set the date using RFC 3339 format.
			$startDate = $eventstartdate;
			$startTime = $eventstarttime;
			$endDate = $eventenddate;
			$endTime = $eventendtime;
			$tzOffset = "+05";
			$tzOffset1 = "30";
			
			$when = $service->newWhen();
			$when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:{$tzOffset1}";
			$when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}:{$tzOffset1}";
			$event->when = array($when);
			
			// Create a new reminder object. It should be set to send an email
			// to the user 10 minutes beforehand.
			$reminder = $service->newReminder();
			$reminder->method = $rem;
			$reminder->minutes = $remmin;
			 
			// Apply the reminder to an existing event's when property
			$when = $event->when[0];
			$when->reminders = array($reminder);
			
			// Upload the event to the calendar server
			// A copy of the event as it is recorded on the server is returned
			$newEvent = $service->insertEvent($event);
			
			header('Location:singleevent.php?flag=1');
			}//try
			catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				echo "<h2>Internet Connection Error</h2>";
			}
		  }//button is pressed
		  else{
			  ?>
              <form name="singleeventform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
        <h3>Enter the information of event to insert single event in Google Calendar.</h3>
        <center>
        <table border="0" cellpadding="5" cellspacing="5">
        <tr>
    <th scope="col" align="left">Event Name<sup style="color:#F00">*</sup></th>
    <th scope="col"><input type="text" name="eventname" placeholder="Event Name" required="required" /></th>
    <th scope="col" rowspan="8" valign="top"><input id="reminder" name="reminder" type="checkbox" value="reminder"/> Reminder
    	<div id="divReminder" style="display:none">
    	<p>
              <div style="display: table;">
                <div style="display: table-row;">
                  <div style="display: table-cell;">
                      <input type="radio" name="rem" value="email" id="remMin"/>
                  </div>  
                  <div style="display: table-cell;">
                      Email
                  </div>
                 </div>  
                  <div style="display: table-row;">
                  <div style="display: table-cell;">
                      <input type="radio" name="rem" value="sms" id="remMin"/>
                  </div>  
                  <div style="display: table-cell;">
                      SMS<sup style="color:#F00">**</sup>
                  </div>
                 </div>  
                 <div style="display: table-row;">
                  <div style="display: table-cell;">
                      <input type="radio" name="rem" value="alert" id="remMin"/>
                  </div>  
                  <div style="display: table-cell;">
                      Pop-up
                  </div>
                 </div>  
                </div>  
         </p>
         <div id="divMin" style="display:none">
         		Minutes for Reminder<sup style="color:#F00">*</sup><br /><input type="text" name="remmin" placeholder="Enter minutes" pattern="[0-9]{2}"/>
         </div>
        </div>
    </th>
    	</tr>
        <tr>
    <th scope="col" align="left">Event Location</th>
    <th scope="col"><input type="text" name="eventloc" placeholder="Event Location" /></th>
    	</tr>
        <tr valign="top">
    <th scope="col" align="left">Event Description</th>
    <th scope="col"><textarea cols="17" rows="5" name="eventdesc" placeholder="Event Description"></textarea></th>
    	</tr>
        <tr>
    <th scope="col" align="left">Start Date<sup style="color:#F00">*</sup></th>
    <th scope="col"><input type="text" name="startdate" placeholder="Format : YYYY-MM-DD" required="required" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" oninvalid="setCustomValidity('Enter Date as format:YYYY-MM-DD')" onchange="try{setCustomValidity('')}catch(e){}" value="<?php echo $currentdate ?>" /></th>
    	</tr>
        <tr>
    <th scope="col" align="left">Start Time<sup style="color:#F00">*</sup></th>
    <th scope="col"><input type="text" name="starttime" placeholder="Format : HH:MM" required="required" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){1}" oninvalid="setCustomValidity('Enter Time as format:HH:MM')" onchange="try{setCustomValidity('')}catch(e){}" value="<?php echo $currenttime ?>"/></th>
    	</tr>
        <tr>
    <th scope="col" align="left">End Date<sup style="color:#F00">*</sup></th>
    <th scope="col"><input type="text" name="enddate" placeholder="Format : YYYY-MM-DD" required="required" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" oninvalid="setCustomValidity('Enter Date as format:YYYY-MM-DD')" onchange="try{setCustomValidity('')}catch(e){}" value="<?php echo $currentdate ?>"/></th>
    	</tr>
        <tr>
    <th scope="col" align="left">End Time<sup style="color:#F00">*</sup></th>
    <th scope="col"><input type="text" name="endtime" placeholder="Format : HH:MM" required="required" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){1}" oninvalid="setCustomValidity('Enter Time as format:HH:MM')" onchange="try{setCustomValidity('')}catch(e){}" value="<?php echo $advtime ?>"/></th>
    	</tr>
    	<tr>
    <th scope="col"></th>
    <th scope="col"><input type="submit" value="Submit" name="singleevent" /></th>
    	</tr></table>
            </center>
            <sup style="color:#F00">*</sup> Mandatory Fields<br />
            <sup style="color:#F00">**</sup> Phone number must be validated.
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