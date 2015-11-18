<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
include('connection.php');
include('header.php');

if(isset($_POST["upload"]))
{
	$result = mysql_query("SELECT count(*) FROM theme");
	while($row = mysql_fetch_array($result))
	{
		$i = $row['count(*)'];
	}
	$a=$i+1;
	
	$s1=$_FILES["homepage"]["size"];
	$t1=$_FILES["homepage"]["type"];
	$f1=$_FILES["homepage"]["name"];
	$tmp1=$_FILES["homepage"]["tmp_name"];
	$cm1=strrchr($f1,".");
	$cm1=strtolower($cm1);
	
	$s2=$_FILES["dropdown"]["size"];
	$t2=$_FILES["dropdown"]["type"];
	$f2=$_FILES["dropdown"]["name"];
	$tmp2=$_FILES["dropdown"]["tmp_name"];
	$cm2=strrchr($f2,".");
	$cm2=strtolower($cm2);
	
	$s3=$_FILES["admin"]["size"];
	$t3=$_FILES["admin"]["type"];
	$f3=$_FILES["admin"]["name"];
	$tmp3=$_FILES["admin"]["tmp_name"];
	$cm3=strrchr($f3,".");
	$cm3=strtolower($cm3);
	
	$s4=$_FILES["calendar"]["size"];
	$t4=$_FILES["calendar"]["type"];
	$f4=$_FILES["calendar"]["name"];
	$tmp4=$_FILES["calendar"]["tmp_name"];
	$cm4=strrchr($f4,".");
	$cm4=strtolower($cm4);
	
	$s5=$_FILES["changepic"]["size"];
	$t5=$_FILES["changepic"]["type"];
	$f5=$_FILES["changepic"]["name"];
	$tmp5=$_FILES["changepic"]["tmp_name"];
	$cm5=strrchr($f5,".");
	$cm5=strtolower($cm5);
	
	if ((isset($_FILES["homepage"]["error"]) != '')
		&& (isset($_FILES["dropdown"]["error"]) != '')
		&& (isset($_FILES["admin"]["error"]) != '')
		&& (isset($_FILES["calendar"]["error"]) != '')
		&& (isset($_FILES["changepic"]["error"]) != ''))
    {
		if($cm1==".css" && $cm2==".css" && $cm3==".css" && $cm4==".css" && $cm5==".css")
		{
			if(($s1 < 2048000) && ($s2 < 2048000) && ($s3 < 2048000) && ($s4 < 2048000) && ($s5 < 2048000) )
		   {	  
				move_uploaded_file($_FILES["homepage"]["tmp_name"],"" . "templatemo_style".$a.$cm1);
				move_uploaded_file($_FILES["dropdown"]["tmp_name"],"css/" . "dropdownmenu".$a.$cm2);
				move_uploaded_file($_FILES["admin"]["tmp_name"],"css/" . "admin".$a.$cm3);
				move_uploaded_file($_FILES["calendar"]["tmp_name"],"css/" . "calendar".$a.$cm4);
				move_uploaded_file($_FILES["changepic"]["tmp_name"],"css/" . "changepic".$a.$cm5);
				
				$insertcss="insert into theme values ('','$_POST[themename]','templatemo_style$a$cm1','templatemo_style$a$cm1','css/dropdownmenu$a$cm2','css/admin$a$cm3','templatemo_style$a$cm1','css/calendar$a$cm4','css/changepic$a$cm5','0')";
				mysql_query($insertcss);
		   }
		  else
		   {
			   ?>
				 <script type="text/javascript">
                        alert("Your uploaded css file(s) is larger than 2MB.");
                </script>
		<?php
		   }
		}
		else
		{
			?>
			 <script type="text/javascript">
                   alert("Your uploaded css file(s) has wrong File format. Please upload .css file");
            </script>
		<?php
		} 	
	}
	else{
		?>
		 <script type="text/javascript">
				alert("Your Files are not uploaded.");
		</script>
		<?php
	}
}
		?>

</head>

<body>
  <br> 
  <br>
  <table width="428" border="0" align="center">
  <form action="#" method="post"  enctype="multipart/form-data">
  <tr>
    <th width="150" height="35" scope="col"><label>Theme Name </label></th>
    <th width="262" scope="col"><div align="left"><input type="text" name="themename" required="required" /></div></th>
    </tr>
  <tr>
    <th width="150" height="35" scope="col"><label>Homepage CSS </label></th>
    <th width="262" scope="col"><div align="left"><input type="file" name="homepage" required="required"/></div></th>
    </tr>
     <tr>
    <th width="150" height="35" scope="col"><label>Dropdown CSS</label></th>
    <th width="262" scope="col"><div align="left"><input type="file" name="dropdown" /> </div></th>
    </tr>
    <tr>
<th width="150" height="35" scope="col"><label>Admin CSS</label></th>
    <th width="262" scope="col"><div align="left"><input type="file" name="admin" /> </div></th>
    </tr>
    <tr>
<th width="150" height="35" scope="col"><label>Calendar CSS</label></th>
    <th width="262" scope="col"><div align="left"> <input type="file" name="calendar" /></div></th>
    </tr>
    <tr>
<th width="150" height="35" scope="col"><label>Changepic CSS</label></th>
    <th width="262" scope="col"><div align="left"> <input type="file" name="changepic" /></div></th>
    </tr>
		   <tr width="262"><th colspan="2">
    <input id="Submit" type="submit"  value="Upload CSS" name="upload" /></th>
    </tr>
  </form>
  </table>
</body>
</html>