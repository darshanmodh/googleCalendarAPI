<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include("connection.php");
session_start();
$uid = $_SESSION['uid'];

$themere = mysql_query("SELECT adminpage, dropdown FROM theme WHERE current='1'");
while($row = mysql_fetch_array($themere))
  {
	  $homepage = $row['adminpage'];
	  $dropdown = $row['dropdown'];
  }

$result = mysql_query("SELECT * FROM reg WHERE uid='$uid'");
while($row = mysql_fetch_array($result))
  {
	  $fname = $row["fname"];
	  $lname = $row["lname"];
	  $uname = $row["uname"];
	  $email = $row["email"];
	  $bday = $row["bday"];
	  $usrpic = $row["pic"];
  }
$dayIcon = date("j");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "$fname $lname"; ?></title>
<link type="image/x-icon" href="images/ico/favicon_v2013_<?php echo $dayIcon.".ico" ?>" rel="icon"> 

<link rel="stylesheet" href="zzz/dhtmlwindow.css" type="text/css" />
<script type="text/javascript" src="zzz/dhtmlwindow.js"></script>
<link rel="stylesheet" href="zzz/modal.css" type="text/css" />
<script type="text/javascript" src="zzz/modal.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $dropdown ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo $homepage ?>"/>
<link rel="stylesheet" href="css/jquery-ui-1.10.2.custom.css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>

<script>
 $(function() {
                $( document ).tooltip({
                    track: true
                });
            });
</script>

</head>

<body>
<div id="menubar">
    	<ul id="nav">
		<li>
			<a href="admin.php">Home</a>

		</li>
		<li>
			<a href="#">Members</a>
			<ul>
				<li><a href="admin.php?view=members">View Members</a></li>
				<li><a href="searchprofile.php">Search Member</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Theme</a>
			<ul>
				<li><a href="changetheme.php">Change Theme</a></li>
				<li><a href="addtheme.php">Add Theme</a></li>
			</ul>
		</li>
        <li>
        	<a href="logout.php">Logout</a>
		</li>
	</ul>
    </div> 
<?php
include("connection.php");
session_start();

			if($_SESSION['type'] == "admin"){
			?>		
<div>
					<a href="#" onclick="opennewsletter('changepic.php','Change Picture');"><img src="img/<?php echo $usrpic; ?>" width="7%" height="10%" id="picture" title="Click to change picture"/></a>
			 
				<div style="height:5%;width:5%;padding:0px 5px 0px 15px;">
					<b><?php echo "$fname $lname"; ?></b></div>
						</div>
			<?php
			}
			else{
				header("Location: invalid.php");
			}

if($_GET["view"] == "delete")
{
mysql_query("DELETE FROM reg WHERE uid ='$_GET[uid]'");
header('Location:admin.php?view=members');
}

if($_GET["view"] == "members")
{
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

	$query = "SELECT * FROM reg where not uid='$uid' $limit";
	$result = mysql_query($query, $con) or trigger_error("SQL", E_USER_ERROR);

	if(mysql_num_rows($result) >= 1)
	{
	?>
    <h2>Member Details</h2>
    <div id="table-data" style="clear:both; text-align:center;">
    <table width="70%" border="1" align="center">
      <tr>
        <td><strong>SR NO</strong></td>
        <td><strong>UID</strong></td>
        <td><strong>Username</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>Date of birth</strong></td>
     <?php
	 if($_SESSION["type"]=="admin")
	 {
		?>
        	<td><strong>Action</strong></td>
        <?php
	 }
	 ?>
     	</tr>
     <?php
	 $i = (($pageno-1)*$rows_per_page)+1;
  while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>&nbsp;"  . $i . "</td>";
  echo "<td>&nbsp;"  . $row['uid'] . "</td>";
  echo "<td>&nbsp;" . $row['uname'] . "</td>";
  echo "<td>&nbsp;" . $row['fname'] . " " . $row['lname'] . "</td>";
  echo "<td>&nbsp;" . $row['bday'] . "</td>";
	 
  if($_SESSION["type"]=="admin")
  {
	  ?>
	      <td><a href="#" onclick="opennewsletter('viewprofile.php?uid=<?php echo $row['uid']; ?>','View Profile');"><img src='images/view.png' width='32' height='32' /></a>
		   <a href="#" onclick="opennewsletter('editprofile.php?uid=<?php echo $row['uid']; ?>','Edit Profile');"><img src='images/edit.png' width='32' height='32' /></a>
		   <a href='admin.php?uid=<?php echo $row['uid']; ?>&view=delete'><img src='images/delete.png' width='32' height='32' onclick='return confirm('Are you sure??')'/></a></td>
		<?php
  }
  echo "</tr>&nbsp;";
 $i++;
  }//while records availabble 
  
  echo "</table><table border='0' align='center' width='52%'>
  		<tr height='20px'><th colspan='3'>( Page $pageno of $lastpage )</th> </tr>";
  if ($pageno == 1) {
   echo "<tr><td><img src='images/previous.png' alt='previous_page' style='opacity:100'/></td>";
} else {
   $prevpage = $pageno-1;
   echo " <tr><td><a href='{$_SERVER['PHP_SELF']}?view=members&pageno=$prevpage'><img src='images/previous.png' alt='previous_page' /></a></td> ";
} // if

echo "<td><a href='register.php'><img src='images/add.png' alt='add_member' /></a></td>";

if ($pageno == $lastpage) {
   echo " <td><img src='images/next.png' alt='next_page' style='opacity:100'/></td>";
} else {
   $nextpage = $pageno+1;
   echo " <td><a href='{$_SERVER['PHP_SELF']}?view=members&pageno=$nextpage'><img src='images/next.png' alt='next_page' /></a></td> ";
} // if
echo "</tr></table>";
 }
}

?>
</body>
</html>

<script type="text/javascript">
function opennewsletter(n,title){
	emailwindow=dhtmlmodal.open('EmailBox', 'iframe', n, title,'width=600px,height=400px,center=1,resize=0,scrolling=1')
}
</script>
