<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
session_start();
include('connection.php');
include('header.php');

$themere = mysql_query("SELECT themename FROM theme WHERE current='1'");
while($row = mysql_fetch_array($themere))
  {
	  $current = $row['themename'];
  }

if(isset($_POST['submit'])){
	$htmltheme = $_POST['theme'];
	$sql = "UPDATE theme SET current='0'";
	mysql_query($sql,$con);
	$sql1 = "UPDATE theme SET current='1' WHERE themename='$_POST[theme]'";
	mysql_query($sql1,$con);
	header('Location:index.php');
}
?>
</head>

<body>
<p>
  <br> 
  <br>
  <table width="428" border="0" align="center">
  <form action="#" method="post">
  <tr>
    <th width="150" height="35" scope="col"><label>Theme </label></th>
    <th width="262" scope="col"><div align="left"><select id="theme" name="theme">
    <?php
	$result = mysql_query("SELECT themename FROM theme");
	while($row = mysql_fetch_array($result))
  {
	  $themename = $row['themename'];
	  if($current==$themename){
		  echo "<option value='$themename' selected='selected'>$themename</option>";
	  }else{
	  echo "<option value='$themename'>$themename</option>";
	  }
  }
    ?>
    </select></div></th>
    </tr>
    <tr width="262"><th colspan="2">
    <input id="submit" type="submit"  value="Change Theme" name="submit" /></th>
    </tr>
  </form>
  </table>
</body>
</html>