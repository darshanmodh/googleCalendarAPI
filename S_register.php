<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];
	$email = $_POST['email'];
	$bday = $_POST['bday'];
	$txtInput = $_POST['txtInput'];
	
	session_start();
	$captcha = $_SESSION['captcha'];
	
	if($txtInput==$captcha && $pass==$cpass)
	{
		echo "Thank You for register ".$fname." ".$lname;
	}
	else
	{
		header('Location:register.php?msg=1');
	}
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
	header('Location:register.php');
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>