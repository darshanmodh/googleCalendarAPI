<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
		<link rel="stylesheet" href="css/jquery-ui.css" />
        <link rel="stylesheet" href="css/stylesheet.css">
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>
</head>
<?php
include("connection.php");
session_start();
if(isset($_SESSION['uid']) && $_POST['submit']){
	$uid = $_SESSION['uid'];
	$eventname = $_POST['event_name'];
	$eventdesc = $_POST['event_description'];
	$eventloc = $_POST['event_location'];
	$eventdate1 = $_POST['event_date_from'];
	$eventdate2 = $_POST['event_date_to'];
	$eventtime1 = $_POST['event_time_from'];
	$eventtime2 = $_POST['event_time_to'];
	$repeat = $_POST['repeat'];
	$repeats = $_POST['repeatValue'];
	$starton = $_POST['start_on'];
	$endon = $_POST['end_on'];
	$eventcolor = $_POST['color'];
	$chk_share = $_POST['chk_share'];
	$eventshare = $_POST['shareduser'];
	$friendid = array();
	if($chk_share)
		$chk_share=true;

	/*echo "Selected Users : ";
	for($i=0;$i<count($eventshare);$i++)
	{
		if($eventshare[$i] != "")
		{
			echo $eventshare[$i].", ";
		}
	}
	
	echo "<br>$uid";
	echo "<br>$eventname";
	echo "<br>$eventdesc";
	echo "<br>$eventloc";
	echo "<br>$eventdate1";
	echo "<br>$eventdate2";
	echo "<br>$eventtime1";
	echo "<br>$eventtime2";
	echo "<br>$repeats";
	echo "<br>$starton";
	echo "<br>$endon";
	echo "<br>$eventcolor";*/
	
		$sql = "INSERT INTO event  VALUES ('', '$uid', '$eventname', '$eventdesc', '$eventloc', '$eventdate1', '$eventdate2', '$eventtime1', '$eventtime2', '$repeats', '$starton', '$endon', '$eventcolor', '$chk_share');";

		if(mysql_query($sql)){
			echo "<h1>Event inserted successfully.</h1>";
			echo "<a href='index.php' target='_parent'>Back</a>";
		}
		else
			echo "Error in insert";
			
	if($chk_share==true){
		$result = mysql_query("SELECT * FROM event ORDER BY eventid DESC LIMIT 1");
		while($row = mysql_fetch_array($result))
		  {
			$eventid = $row["eventid"];
			$eventname = $row["eventname"];
		  }
		  for($i=0;$i<count($eventshare);$i++)
		  {
				if($eventshare[$i] != "")
				{
					$result1 = mysql_query("SELECT * FROM reg where email='$eventshare[$i]'");
					while($row = mysql_fetch_array($result1))
					  {
						$friendid[i] = $row["uid"];
					  }
				}
				$sql1 = "INSERT INTO event_share VALUES ('', '$eventid', '$eventname', '$uid', '$friendid[i]', '$eventshare[$i]');";
				if(mysql_query($sql1)){
					
				}else{
					?>
						<script type="text/javascript">
                        $(function() {
                            $( "#err1" ).dialog({
                              height: 140,
                              modal: true
                            });
                        });
                        </script>
   				 <?php
				}
		  }
	}
}//submit btn is not clicked
else{
	header('Location:index.php');
}
?>
<body>
<div id="dialog" title="Event Added" style="display:none;">
	<p>Event inserted successfully</p>
</div>

<div id="err1" title="Event Added" style="display:none;">
	<p>Event not shared with friends.</p>
</div>

<?php 
	echo "<div id='sharedmsg' >Event is shared with<br>";
		for($i=0;$i<count($eventshare);$i++){
				if($eventshare[$i] != ""){
					echo "<img src='images/person.png'>".$eventshare[$i]."<br>";
				}
		  }
?></div>
</body>
</html>