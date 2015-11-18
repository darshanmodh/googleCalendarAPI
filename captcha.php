<?php
$captchaText = $_GET['text'];
if($captchaText == null)
	$captchaText = "Hello";
session_start();
$_SESSION['captcha'] = $captchaText;

header("Content-Type: image/png");
$im = @imagecreate(100, 30)
    or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 192, 192, 192);
$text_color = imagecolorallocate($im, 0, 0, 0);
imagestring($im, 5, 30, 5,  $captchaText, $text_color);
imagepng($im);
imagedestroy($im);

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