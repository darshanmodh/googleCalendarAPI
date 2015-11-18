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
<title>Recurring Event</title>
</head>

<body>
<?php
if($_GET['flag']==1){
	echo "<script>alert('Event is added Successfully in Google Calendar.')</script>";
}

$currentdate = date("Y-m-d");
$NewDate=Date('Y-m-d', strtotime("+2 years"));
$EndDate=Date('Y-m-d', strtotime("+1 days"));

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
		echo "<h1>Recurring Event</h1>";
		
		if(isset($_POST['recurevent'])){
			$eventname = $_POST['eventname'];
			$eventloc = $_POST['eventloc'];
			$eventdesc = $_POST['eventdesc'];
			$eventstartdate = $_POST['startdate'];
			$eventenddate = $_POST['enddate'];
			$eventuntilldate = $_POST['untilldate'];
			if(isset($_POST['repeat'])){
				$repeat = $_POST['repeat'];
			}
			if(isset($_POST['reminder'])){
				$rem = $_POST['rem'];
				$remmin = $_POST['remmin'];
			}
			$eventstartdate = str_replace('-', '', $eventstartdate);
			$eventenddate = str_replace('-', '', $eventenddate);
			$eventuntilldate = str_replace('-', '', $eventuntilldate);
			
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
			$event->content = $service->newContent($eventdesc);
			 
			// Set the duration and frequency by specifying a recurrence pattern.
			 
			$recurrence = "DTSTART;VALUE=DATE:$eventstartdate\r\n" .
					"DTEND;VALUE=DATE:$eventenddate\r\n" .
					"RRULE:FREQ=$repeat;UNTIL=$eventuntilldate\r\n";
			 
			$event->recurrence = $service->newRecurrence($recurrence);
			 
			// Upload the event to the calendar server
			// A copy of the event as it is recorded on the server is returned
			$newEvent = $service->insertEvent($event);
			
			header('Location:recurevent.php?flag=1');
			}//try
			catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				echo "<h2>Internet Connection Error</h2>";
			}
		  }//button is pressed
		  else{
			  ?>
              <form name="recureventform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
        <h3>Enter the information of event to insert recurring event in Google Calendar.</h3>
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
    <th scope="col" align="left">End Date<sup style="color:#F00">*</sup></th>
    <th scope="col"><input type="text" name="enddate" placeholder="Format : YYYY-MM-DD" required="required" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" oninvalid="setCustomValidity('Enter Date as format:YYYY-MM-DD')" onchange="try{setCustomValidity('')}catch(e){}" value="<?php echo $currentdate ?>"/></th>
    	</tr>
        <tr>
    <th scope="col" align="left">Untill Date<sup style="color:#F00">*</sup></th>
    <th scope="col"><input type="text" name="untilldate" placeholder="Format : YYYY-MM-DD" required="required" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" oninvalid="setCustomValidity('Enter Date as format:YYYY-MM-DD')" onchange="try{setCustomValidity('')}catch(e){}" value="<?php echo $NewDate ?>"/></th>
    	</tr>
        <tr>
    <th scope="col" align="left">Repeat<sup style="color:#F00">*</sup></th>
    <th scope="col"><input type="radio" name="repeat" value="DAILY" required="required"/> Daily
    				<input type="radio" name="repeat" value="WEEKLY" required="required"/> Weekly
                    <input type="radio" name="repeat" value="YEARLY" required="required"/> Yearly</th>
    	</tr>
    	<tr>
    <th scope="col"></th>
    <th scope="col"><input type="submit" value="Submit" name="recurevent" /></th>
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