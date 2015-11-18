<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
include('connection.php');
if (isset($_GET['pageno'])) {
   $pageno = $_GET['pageno'];
} else {
   $pageno = 1;
} // if

$query = "SELECT count(*) FROM reg where not uid='$uid'";
$result = mysql_query($query, $con) or trigger_error("SQL", E_USER_ERROR);
$query_data = mysql_fetch_row($result);
$numrows = $query_data[0];

$rows_per_page = 3;
$lastpage = ceil($numrows/$rows_per_page);

$pageno = (int)$pageno;
if ($pageno > $lastpage) {
   $pageno = $lastpage;
} // if
if ($pageno < 1) {
   $pageno = 1;
} // if

$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;

$query = "SELECT * FROM reg $limit";
$result = mysql_query($query, $con) or trigger_error("SQL", E_USER_ERROR);

if(mysql_num_rows($result) >= 1)
	{
	?>
    <h2>Member Details</h2>
    <div id="table-data" style="clear:both; text-align:center;">
    <table width="50%" border="1" align="center">
      <tr>
        <td><strong>SR NO</strong></td>
        <td><strong>UID</strong></td>
        <td><strong>Username</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>Date of birth</strong></td>
       	<td><strong>Action</strong></td>
        <?php
	 }
	 ?>
     	</tr>
     <?php
	 $i = (($pageno-1)*3)+1;
  while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>&nbsp;"  . $i . "</td>";
  echo "<td>&nbsp;"  . $row['uid'] . "</td>";
  echo "<td>&nbsp;" . $row['uname'] . "</td>";
  echo "<td>&nbsp;" . $row['fname'] . " " . $row['lname'] . "</td>";
  echo "<td>&nbsp;" . $row['bday'] . "</td>";

	      echo "<td>&nbsp;<a href='viewrecords.php?uid=$row[uid]&view=details'><img src='images/view.png' width='32' height='32' /></a>
		   <a href='editrecords.php?uid=$row[uid]&view=details'>  <img src='images/edit.png' width='32' height='32' /></a>
		   <a href='admin.php?uid=$row[uid]&view=delete'><img src='images/delete.png' width='32' height='32' onclick='return confirm('Are you sure??')'/></a></td>";

  echo "</tr>&nbsp;";
 $i++;
  }//while records availabble 
 echo "</table><table border='0' align='center' width='52%'><tr height='20px'></tr><tr><td colspan='2'><a href='register.php'><img src='images/previous.png' alt='add_member' /></a></td>
 			<td colspan='2'><a href='register.php'><img src='images/add.png' alt='add_member' /></a></td>
			<td colspan='2'><a href='register.php'><img src='images/next.png' alt='add_member' /></a></td></tr>";
 echo "</table></div>";


if ($pageno == 1) {
   echo "PREV ";
} else {
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage'>PREV</a> ";
} // if

echo " ( Page $pageno of $lastpage ) ";

if ($pageno == $lastpage) {
   echo " NEXT";
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage'>NEXT</a> ";
} // if


?>
</head>

<body>
</body>
</html>