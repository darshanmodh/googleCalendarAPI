<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type="image/x-icon" href="images/ico/favicon_v2013_<?php $dayIcon = date("j"); echo $dayIcon.".ico"; ?>" rel="icon"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Google Authentication</title>
</head>

<body>
<?php
include("connection.php");
session_start();
define('ACCESS', TRUE);
require_once('userheader.php');

if($_SESSION['type'] == "user"){
	require_once('google1.php');
}
else{
	header("Location: invalid.php");
}

if($_GET["view"] == "delete")
{
mysql_query("DELETE FROM google WHERE uid ='$_GET[uid]'");
header('Location:google.php');
}

if($_GET["view"] == "update")
{
	echo "<script>alert('yup');</script>";
/*mysql_query("DELETE FROM google WHERE uid ='$_GET[uid]'");
header('Location:google.php');*/
}
?>
</body>
</html>