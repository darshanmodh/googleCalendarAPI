<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("test", $con);

$escapedName = mysql_real_escape_string($_POST['name']); 
$escapedPW = mysql_real_escape_string($_POST['password']);

//$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

//$saltedPW =  $escapedPW . $salt;

//$hashedPW = hash('sha256', $saltedPW);

$hashedPW = md5($escapedPW);

$query = "insert into test (name, password, salt) values ('$escapedName', '$hashedPW', ''); ";

mysql_query($query);
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form name="myform" method="post" action="test.php">
Name : <input type="text" name="name" />
<br />
Password : <input type="password" name="password" />
<br />
<input type="submit" name="submit" value="submit"  />
</form>
</body>
</html>