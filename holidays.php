<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/calendarlist.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" href="images/ico/favicon_v2013_<?php $dayIcon = date("j"); echo $dayIcon.".ico"; ?>" rel="icon"> 
<link href="css/calendarlist.css" rel="stylesheet" type="text/css" />
<title>Untitled Document</title>
</head>

<body>
<?php
include("connection.php");
session_start();
define('ACCESS', TRUE);
require_once('userheader.php');

if($_SESSION['type'] == "user"){
	if(isset($_SESSION['uid'])){
		echo "<h1>National Holidays</h1>";
		if(!isset($_POST['getholidays'])){
		?>
        <form name="holidayForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
        <h3>Select a country to get information of national holidays</h3>
        <center>
        <table border="0" cellpadding="5" cellspacing="5">
 	 	<tr>
    <th scope="col" style="height:24px;"><font size="+2">Country</font><sup>*</sup></th>
    <th scope="col">
            <div style="border:solid 1px gray;padding-left:5px;padding:2px 5px 2px 5px; width:275px;height:25px">
            <select style="width: 274px;height:24px; border-color: gray; border: none" id="CountryList" class="CountryList" name="link">
                <option value="en_gb.australian%23holiday%40group.v.calendar.google.com">AUSTRALIA</option>
                <option value="en.brazilian%23holiday%40group.v.calendar.google.com">BRAZIL</option>
                <option value="en_gb.canadian%23holiday%40group.v.calendar.google.com">CANADA</option>
                <option value="en_gb.china%23holiday%40group.v.calendar.google.com">CHINA</option>
                <option value="en_gb.dutch%23holiday%40group.v.calendar.google.com">DUTCH</option>
                <option value="en_gb.french%23holiday%40group.v.calendar.google.com">FRANCE</option>
                <option value="en_gb.german%23holiday%40group.v.calendar.google.com">GERMANY</option>
                <option value="en_gb.greek%23holiday%40group.v.calendar.google.com">GREECE</option>
                <option value="en_gb.islamic%23holiday%40group.v.calendar.google.com">PAKISTAN (ISLAMIC)</option>
                <option value="en_gb.italian%23holiday%40group.v.calendar.google.com">ITALY</option>
                <option value="en_gb.japanese%23holiday%40group.v.calendar.google.com">JAPAN</option>
                <option value="en_gb.mexican%23holiday%40group.v.calendar.google.com">MEXICO</option>
                <option value="en_gb.portuguese%23holiday%40group.v.calendar.google.com">PORTUGAL</option>
                <option value="en_gb.russian%23holiday%40group.v.calendar.google.com">RUSSIA</option>
                <option value="en_gb.singapore%23holiday%40group.v.calendar.google.com">SINGAPORE</option>
                <option value="en_gb.sa%23holiday%40group.v.calendar.google.com">SOUTH AFRICA</option>
                <option value="en_gb.spain%23holiday%40group.v.calendar.google.com">SPAIN</option>
                <option value="en_gb.taiwan%23holiday%40group.v.calendar.google.com">TAIWAN</option>
                <option value="en_gb.uk%23holiday%40group.v.calendar.google.com">UNITED KINGDOM</option>
                <option value="en_gb.usa%23holiday%40group.v.calendar.google.com">UNITED STATE OF AMERICA</option>
                <option value="en.indian%23holiday%40group.v.calendar.google.com" selected="selected">INDIA</option>
            </select>
   			</div>
            </th>
    		</tr>
            <tr>
    		<th scope="col" style="height:24px;"></th>
            <th scope="col" style="height:24px;">
            <input type="submit" value="Submit" name="getholidays" /></th></tr></table>
            </center>
            * Region and Religious holidays are not included
            </fieldset>
        </form>
        <?php
		}//button is not pressed
		else{
			$link = $_POST['link'];
			echo "<center>";
			echo "<iframe src='https://www.google.com/calendar/embed?src=".$link."&ctz=Asia/Calcutta' style='border: 0' width='1100' height='600' frameborder='0' scrolling='no'></iframe> </center>";
		}
	}//uid is set
}//type is user
else{
	header("Location: invalid.php");
}
?>
</body>
</html>