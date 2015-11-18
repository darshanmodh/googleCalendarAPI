<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/jquery-ui.css" />

<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>

<title>Untitled Document</title>

<?php
include("connection.php");

$result = mysql_query("SELECT changepic FROM theme WHERE current='1'");
while($row = mysql_fetch_array($result))
  {
	  $homepage = $row["changepic"];
  }
  
session_start();
if(!isset($_SESSION['uid']))
{
	header('Location:invalid.php');
}

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

if(isset($_POST["upload"]) && $_POST['upload']!='')
{
	$s=$_FILES["file"]["size"];
	$t=$_FILES["file"]["type"];
	$f=$_FILES["file"]["name"];
	$tmp=$_FILES["file"]["tmp_name"];
	$cm=strrchr($f,".");
	$cm=strtolower($cm);
	
	if (isset($_FILES["file"]["error"]) != '')
    {
		if($cm==".jpg"||$cm==".jpeg"||$cm==".bmp"||$cm==".png")
		{
			if($s < 2048000 )
		   {
				$filepath=$_FILES["file"]["name"];
				  
				move_uploaded_file($_FILES["file"]["tmp_name"],"img/" . $uname.$cm);
			
				$updtpic="UPDATE reg SET pic='".$uname.$cm."' where uname='".$uname."';";
				mysql_query($updtpic);
		   }
		  else
		   {
			   ?>
				 <script type="text/javascript">
                        alert("Your uploaded picture is larger than 2MB.");
                </script>
		<?php
		   }
		}
		else
		{
			?>
			 <script type="text/javascript">
                   alert("Your uploaded picture has wrong File format. Please upload .jpg, .jpeg, .png or .bmp picture");
            </script>
		<?php
		} 	
	}
	else{
		?>
		 <script type="text/javascript">
				alert("Your picture is not uploaded.");
		</script>
		<?php
	}
		?>
		
<?php
$result = mysql_query("SELECT pic FROM reg WHERE uid='$uid'");
while($row = mysql_fetch_array($result))
  {
	  $usrpic = $row["pic"];
  }
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo $homepage ?>" />
</head>

<body background="css/3.jpg">
Your current picture is : 
<br />
<div id="currentpic" style="float:left">
<img src="img/<?php echo $usrpic; ?>" width="250" height="300" />
</div>

<div id="changebtn" style="float:left">
<form action="" method="post" enctype="multipart/form-data">
         &nbsp;&nbsp;
         <label for="path">Choose picture : </label>
         <input type="file" name="file" id="file" /> <br />
         &nbsp;&nbsp;<input type="submit" name="upload" id="upload" value="Upload photo" />
</form>
</div>

</body>
</html>
