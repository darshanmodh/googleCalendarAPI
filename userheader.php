<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
include("connection.php");
session_start();

if(!defined('ACCESS')) {
   //die('Direct access not permitted');
   header('location:invalid.php');
}

$result = mysql_query("SELECT dropdown,calendar FROM theme WHERE current='1'");
while($row = mysql_fetch_array($result))
  {
	  $dropdown = $row["dropdown"];
	  $homepage = $row["calendar"];
  }
  
if($_SESSION['type'] == "user"){
$uid = $_SESSION['uid'];

$result = mysql_query("SELECT * FROM reg WHERE uid='$uid'");
while($row = mysql_fetch_array($result))
  {
	  $fname = $row["fname"];
	  $lname = $row["lname"];
	  $uname = $row["uname"];
	  $email = $row["email"];
	  $bday = $row["bday"];
	  $usrpic = $row["pic"];
  }
$dayIcon = date("j");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "$fname $lname"; ?></title>
<link type="image/x-icon" href="images/ico/favicon_v2013_<?php echo $dayIcon.".ico" ?>" rel="icon">   
<link rel="stylesheet" type="text/css" href="<?php echo $homepage ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo $dropdown  ?>">
<link rel="stylesheet" href="css/jquery-ui-1.10.2.custom.css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>

<link rel="stylesheet" href="zzz/dhtmlwindow.css" type="text/css" />
<script type="text/javascript" src="zzz/dhtmlwindow.js"></script>
<link rel="stylesheet" href="zzz/modal.css" type="text/css" />
<script type="text/javascript" src="zzz/modal.js"></script>

<script>
 			$(function() {
                $( document ).tooltip({
                    track: true
                });
            });
</script>
<style>
img
{
opacity:1.0;
filter:alpha(opacity=40); /* For IE8 and earlier */
}
img:hover
{
opacity:0.4;
filter:alpha(opacity=100); /* For IE8 and earlier */
}
#middlebar{
	height:70px;
}
</style>
</head>

<body>
<div id="middlebar">
	<div id="pic" style="width:5%;float:left;">
		<a href="#" onclick="opennewsletter('changepic.php','Change Picture');"><img src="img/<?php echo $usrpic; ?>" width="100%" height="10%" id="picture" title="Click to change picture"/></a>
	</div>

	<div id="content" style="height:5%;width:5%;float:left;padding:0px 5px 0px 15px;">
		<h3 id="cal"><?php echo "$fname $lname"; ?></h3>
	</div>
    
    <div id="menubar">
    	<ul id="nav">
		<li>
			<a href="index.php">Home</a>
		</li>
		<li>
			<a href="#">Profile</a>
			<ul>
				<li><a href="#" onclick="opennewsletter('viewprofile.php?uid=<?php echo $uid; ?>','View Profile');">View Profile</a></li>
				<li><a href="#" onclick="opennewsletter('editprofile.php?uid=<?php echo $uid; ?>','Edit Profile');">Edit Profile</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Google</a>
			<ul>
				<li><a href="google.php">Google Account</a></li>
				<li><a class='login' href='acc_info.php'>Account Information</a></li>
                <li><a href="calendarlist.php">Calendar List</a></li>
				<li><a href="holidays.php">National Holidays</a></li>
				<li><a href="event_range.php">Events in Range</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Google Calendar</a>
			<ul>
				<li><a href="quickevent.php">Quick Event</a></li>
				<li><a href="singleevent.php">Single Event</a></li>
                <li><a href="recurevent.php">Recurring Event</a></li>
                <li><a href="deleteevent.php">Delete Event</a></li>
                <li><a href="modifyevent.php">Modify Event</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Hangman</a>
			<ul>
				<li><a href="hangman/">Play Hangman</a></li>
                <li><a href="about.php">About Us</a></li>
			</ul>
		</li>
		<li>
			<a href="logout.php">Logout</a>
		</li>
	</ul>
    </div>
<?php
}
else{
	header("Location: invalid.php");
}
?>
</div>
</body>
</html>

<script type="text/javascript">
function opennewsletter(n,title){
	emailwindow=dhtmlmodal.open('EmailBox', 'iframe', n, title,'width=600px,height=400px,center=1,resize=0,scrolling=1')
}
</script>