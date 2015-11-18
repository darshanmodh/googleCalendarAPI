<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
require_once dirname(__FILE__).'/GoogleClientApi/src/Google_Client.php';
require_once dirname(__FILE__).'/GoogleClientApi/src/contrib/Google_PlusService.php';
require_once dirname(__FILE__).'/GoogleClientApi/src/contrib/Google_Oauth2Service.php';
session_start();

$client = new Google_Client();
$client->setApplicationName("Get Profile pic"); // Set your applicatio name
$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me')); // set scope during user login
$client->setClientId('600636044445-9q0pa97th98nvaulvctg8i7t9tu08v05.apps.googleusercontent.com'); // paste the client id which you get from google API Console
$client->setClientSecret('VN4sTudqx8yBr_Q8J9QiMHMg'); // set the client secret
$client->setRedirectUri('http://localhost:8081/gopi1/acc_info.php'); // paste the redirect URI where you given in APi Console. You will get the Access Token here during login success
$client->setDeveloperKey('600636044445-9q0pa97th98nvaulvctg8i7t9tu08v05'); // Developer key
$plus       = new Google_PlusService($client);
$oauth2     = new Google_Oauth2Service($client); // Call the OAuth2 class for get email address

if(isset($_GET['code'])) {
    $client->authenticate(); // Authenticate
    $_SESSION['access_token'] = $client->getAccessToken(); // get the access token here
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}
 
if(isset($_SESSION['access_token'])) {
    $client->setAccessToken($_SESSION['access_token']);
}
 
if ($client->getAccessToken()) {
  $user         = $oauth2->userinfo->get();
  $me           = $plus->people->get('me');
  $optParams    = array('maxResults' => 100);
  $activities   = $plus->activities->listActivities('me', 'public',$optParams);
  // The access token may have been updated lazily.
  $_SESSION['access_token']         = $client->getAccessToken();
  $email                            = filter_var($user['email'], FILTER_SANITIZE_EMAIL); // get the USER EMAIL ADDRESS using OAuth2
} else {
    $authUrl = $client->createAuthUrl();
}
 
if(isset($me)){ 
    $_SESSION['gplusuer'] = $me; // start the session
}
 
if(isset($_GET['logout'])) {
  unset($_SESSION['access_token']);
  unset($_SESSION['gplusuer']);
  session_destroy();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']); // it will simply destroy the current seesion which you started before
  #header('Location: https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
   
  /*NOTE: for logout and clear all the session direct goole jus un comment the above line an comment the first header function */
}
?>


<link href="css/calendarlist.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" href="images/ico/favicon_v2013_<?php $dayIcon = date("j"); echo $dayIcon.".ico"; ?>" rel="icon"> 
<title>Account Information</title>

<?php
include("connection.php");
session_start();
define('ACCESS', TRUE);
require_once('userheader.php');

if($_SESSION['type'] == "user"){
	if(isset($_SESSION['uid'])){
	}//uid is set
}//type is user
else{
	header("Location: invalid.php");
}
?>

<style>
h1 a{
    color:#2C2C2C;
    text-decoration:none;
}
h1 a:hover{
    text-decoration:underline;
}
a{
    color: #069FDF;
}
.wrapper{
    margin: 0 auto;
    width: 1000px;
}
.mytable{
    width: 700px;
    margin: 0 auto;
    border:2px dashed #17A3F7;
    padding: 20px;
}
</style>

</head>

<body>
<h1>Account Information</h1>
<div class="wrapper">
<?php 
if(isset($authUrl)) {
	echo "<center>";
    echo "<a class='login' href='$authUrl'><img src=\"images/stop.gif\" alt=\"Google login using php api for your website\" title=\"login with google\" /></a>";
    }
if(isset($_SESSION['gplusuer'])){ ?>
<br/><br/>
<table class="mytable">
<tr>
    <td>Name:</td>
    <td><?php print $me['displayName']; ?></td>
    <td rowspan="5" valign="top"><img src="https://plus.google.com/s2/photos/profile/<?php print $me['id']; ?>?sz=100" /></td><!-- user profile photo,it vary sizes you can set custom size here -->
</tr>
<tr>
    <td>Email</td>
    <td><span style="background:#FFFF00;"><?php print $user['email']; ?></span></td>
</tr>
<tr>
    <td>Gplus Id</td>
    <td><?php print $me['id']; ?></td>
</tr>
<tr>
    <td>Gender</td>
    <td><?php print $me['gender']; ?></td>
</tr>
<tr>
    <td>Relationship</td>
    <td><?php print $me['relationshipStatus']; ?></td>
</tr>
<tr>
    <td>Location</td>
    <td><?php print $me['placesLived'][0]['value']; ?></td>
</tr>
<tr>
    <td>Tagline</td>
    <td><?php print $me['tagline']; ?></td>
</tr>
</table>
<?php } ?>
</div>
</body>
</html>