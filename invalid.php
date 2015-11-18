<?php
session_start();
if(isset($_SESSION['type']))
	header('Location:index.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Refresh" content="2;url=index.php">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Error Page</title>
    </head>

    <body>
        <h1>Access Denied
        </h1>
        <img src="css/images/rotating_globe.gif">
    </body>
</html>