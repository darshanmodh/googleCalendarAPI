<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php
require_once '../../src/Google_Client.php';
session_start();

$client = new Google_Client();
$client->setApplicationName('Google Contacts PHP Sample');
$client->setScopes("http://www.google.com/m8/feeds/");

$consumer_key='600636044445-kf2pbf20a92em32v7t4v10t2s4iofait.apps.googleusercontent.com';
$consumer_secret='x4b2K9u7Cg42Y_KZtSg3XYV1';
$callback='http://localhost:8081/GoogleClientApi/examples/contacts/simple1.php';
$emails_count='50'; // max-results 
?>


<body>
</body>
</html>