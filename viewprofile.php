<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include("connection.php");
session_start();
$uid = $_SESSION['uid'];
if(!isset($_SESSION['type']) || !isset($_GET['uid']))
	header('Location:index.php');
	
$result = mysql_query("SELECT * FROM reg WHERE uid=$_GET[uid]");

while($row = mysql_fetch_array($result))
  {
	  $fname = $row["fname"];
	  $lname = $row["lname"];
	  $uname = $row["uname"];
	  $email = $row["email"];
	  $bday = $row["bday"];
	  $mname = $row['mname'];
	  $gender = $row['gender'];
	  $mobile = $row['mobile'];
	  $address = $row['address'];
	  $city = $row['city'];
	  $state = $row['state'];
	  $country = $row['country'];
	  $region = $row['region'];
  }
  ?>
<h2>Member</h2>
<table width="428" border="1">
  <tr>
    <th width="150" height="35" scope="col">Username</th>
    <th width="262" scope="col"><div align="left"> &nbsp; <?php echo  $uname; ?></div></th>
    </tr>
  
   <tr>
    <th height="35" scope="col">First name</th>
    <th scope="col"><div align="left">&nbsp; <?php echo  $fname; ?> </div></th>
    </tr>
  <tr>
    <th height="35" scope="col">Last Name</th>
    <th scope="col"><div align="left">&nbsp; <?php echo  $lname; ?> </div></th>
    </tr>
  <tr>
    <th height="35" scope="col">Middle Name</th>
    <th scope="col"><div align="left">&nbsp;  <?php echo  $mname; ?> </div></th>
    </tr>
    <tr>
    <th height="35" scope="col">Email</th>
    <th scope="col"><div align="left">&nbsp;  <?php echo  $email; ?> </div></th>
    </tr>
     <tr>
    <th height="35" scope="col">Birthday</th>
    <th scope="col"><div align="left">&nbsp;  <?php echo  $bday; ?> </div></th>
    </tr>
     <tr>
    <th height="35" scope="col">Gender</th>
    <th scope="col"><div align="left">&nbsp;  <?php echo  $gender; ?> </div></th>
    </tr>
     <tr>
    <th height="35" scope="col">Mobile</th>
    <th scope="col"><div align="left">&nbsp;  <?php echo  $mobile; ?> </div></th>
    </tr>
     <tr>
    <th height="35" scope="col">Address</th>
    <th scope="col"><div align="left">&nbsp;  <?php echo  $address; ?> </div></th>
    </tr>
     <tr>
    <th height="35" scope="col">City</th>
    <th scope="col"><div align="left">&nbsp;  <?php echo  $city; ?> </div></th>
    </tr>
    <tr>
    <th height="35" scope="col">State</th>
    <th scope="col"><div align="left">&nbsp;  <?php echo  $state; ?> </div></th>
    </tr>
    <tr>
    <th height="35" scope="col">Country</th>
    <th scope="col"><div align="left">&nbsp;  <?php echo  $country; ?> </div></th>
    </tr>
    <tr>
    <th height="35" scope="col">Region</th>
    <th scope="col"><div align="left">&nbsp;  <?php echo  $region; ?> </div></th>
    </tr>
  <tr>
    <th height="35" colspan="2"><img src="images/close_window.png" alt="close" title="close" height="30" width="30" onClick="parent.emailwindow.hide()"/></th>
    </tr>
  </table>
  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
</head>

<body>
</body>
</html>