<html>
<head>
<style type="text/css">
table {font-family: Calibri; font-size: 12pt;font-weight:bold;}
</style>
</head>
<body>
<form action = "info.php"><input name="imagesubmit"type ="image" value="back" src="back.png"></form>
<?php

$user = "root";
$pwd = "";
$host = "localhost";
$dbname = "s2hdatabase";

$id = $_POST['view'];



$conn = mysql_connect($host,$user,$pwd) or ("<br>[en] ERROR on MySQL server connection");

mysql_select_db($dbname,$conn);

$query="SELECT * FROM Player WHERE ID= '$id'";
$result=mysql_query($query,$conn);

$num=mysql_numrows($result);

mysql_close($conn);

echo "<b><center><image src='playerinfo.jpg' /></center></b><br><br>";




$first=mysql_result($result,$i,"First_Name");
$last=mysql_result($result,$i,"Last_Name");
$img=mysql_result($result,$i,"img");

$line=0;
function bg($i)
{
if ($i % 2 ==0)
{
return '#CCFFCC';
}
else
{
return '#FFFFCC';
}
}


echo "<table width = 100% border = '0' cellspacing = '0' cellpadding = '0'>";
if ($first != ""){
echo "<tr bgcolor= '".bg($line++)."'> <td align='LEFT' ><div align='Left'><strong>First name:</strong></div></td>
<td align='LEFT'><div align='Left'><strong>$first</strong></div></td> </tr>";
}
if($last != ""){
echo "<tr bgcolor= '".bg($line++)."'><td align='RIGHT' ><div align='Left'><strong>Last name:</strong></div></td>
<td align='RIGHT'><div align='Left'><strong>$last</strong></div></td> </tr>";
}
if($date != "0000-00-00"){
echo "<tr bgcolor= '".bg($line++)."'><td align='RIGHT' ><div align='Left'><strong>Birth date:</strong></div></td>
<td align='RIGHT'><div align='Left'><strong>$date</strong></div></td> </tr>";
}

else
echo"$img";

echo "</table>";
?>
</body>
</html>