<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include('connection.php');
$themere = mysql_query("SELECT * FROM theme WHERE current='1'");
while($row = mysql_fetch_array($themere))
  {
	  $homepage = $row["adminpage"];
	  $dropdown = $row["dropdown"];
  }
session_start();
$uid = $_SESSION['uid'];

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
<link href='<?php echo $dropdown; ?>' rel='stylesheet' type='text/css' />
<link href='<?php echo $homepage; ?>' rel='stylesheet' type='text/css' />
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
			if($_SESSION['type'] == "admin"){
			?>		
<div>
					<a href="#" onclick="opennewsletter('changepic.php','Change Picture');"><img src="img/<?php echo $usrpic; ?>" width="7%" height="19%" id="picture" title="Click to change picture"/></a>
			 
				<div style="height:5%;width:5%;padding:0px 5px 0px 15px;">
					<b><?php echo "$fname $lname"; ?></b></div>
						</div>			
			<?php
			}
			else{
				header("Location: invalid.php");
			}
?>

<script type="text/javascript">
function opennewsletter(n,title){
	emailwindow=dhtmlmodal.open('EmailBox', 'iframe', n, title,'width=600px,height=400px,center=1,resize=0,scrolling=1')
}
</script>
</body>
</html>