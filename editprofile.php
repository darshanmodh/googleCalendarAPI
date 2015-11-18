<?php
include("connection.php");
session_start();
$uid = $_SESSION['uid'];
if(!isset($_SESSION['type']) || !isset($_GET['uid']))
	header('Location:index.php');

$result = mysql_query("SELECT * FROM reg WHERE uid='$_GET[uid]'");

while($row = mysql_fetch_array($result))
  {
	  $fname = $row["fname"];
	  $lname = $row["lname"];
	  $uname = $row["uname"];
	  $email = $row["email"];
	  $bday = $row["bday"];
	  $mname = $row['mname'];
	  $gender = $row['gender'];
	  $mobile = $row['mobile'];
	  $address = $row['address'];
	  $city = $row['city'];
	  $state = $row['state'];
	  $country = $row['country'];
  }
  
if(isset($_POST['submit'])){
	$uname=$_POST['uname'];
	$fname=$_POST['fname'];
	$mname=$_POST['mname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$bday=$_POST['bday'];
	$gender=$_POST['gender'];
	$mobile=$_POST['mobile'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$state=$_POST['city_state'];
	$country=$_POST['country'];
	$region=$_POST['region'];
	
	$sql = "UPDATE reg SET fname='$fname',lname='$lname',uname='$uname',email='$email',bday='$bday',mname='$mname',gender='$gender',mobile='$mobile',address='$address',city='$city',state='$state',country='$country',region='$region' WHERE uid=$_GET[uid]";
}
	mysql_query($sql,$con);	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<link rel="stylesheet" href="css/jquery-ui-1.10.2.custom.css" />
<script type="text/javascript" src="js/city_state.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script>
	function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
      }	//onlyAlphabets() is finished
	  
	$(document).ready(function() {
    $( "#datepicker" ).datepicker({ maxDate: new Date, minDate: new Date(1950, 1, 1), changeYear: true, changeMonth:true });
    $( "#datepicker" ).datepicker( "option", "showAnim", "slideDown" );
});	// datepicker finished


</script>
</head>

<body>

<form action="#" method="post">
            <div class="midcontent">
            <fieldset class="box">
            <p>
            		<label>Username</label>
                    <input id="uname" name="uname" type="text" value="<?php echo $uname ?>" readonly="readonly" />    
            </p>
            <p>
		            <label>First Name</label>
                    <input id="fname" name="fname" type="text" value="<?php echo $fname ?>" onkeypress="return onlyAlphabets(event,this);" required="required" /> 
            </p>            
            <p>
            		<label>Middle Name</label>
                    <input id="mname" name="mname" type="text" value="<?php echo $mname ?>" onkeypress="return onlyAlphabets(event,this);" /> 
            </p>
            <p>
            		<label>Last Name</label>
                    <input id="lname" name="lname" type="text" value="<?php echo $lname ?>" onkeypress="return onlyAlphabets(event,this);" required="required"/> 
    		<p>
            		<label>Email</label>
                    <input id="email" name="email" type="email" value="<?php echo $email ?>" required="required"/> 
            </p>
            <p>
                    <label>Birthday</label>
                    <input id="datepicker" name="bday" type="text" value="<?php echo $bday ?>" required="required" pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d"/> 
            </p>
            <p>
            		<label>Gender</label>
                    <?php
                        if ($gender == male)
                        {
                            echo "<input type='radio' name='gender' value='male' id='gender' checked='checked'> Male <input type='radio' name='gender' value='female' id='gender'> Female";
                        }
                        else
                        {
                            echo "<input type='radio' name='gender' value='male' id='gender'> Male <input type='radio' name='gender' value='female' id='gender' checked='checked'> Female";
                        }
                    ?>
            </p>
            <p>
                    <label>Mobile No.</label>
                    <input id="mobile" name="mobile" type="text" value="<?php echo $mobile ?>" maxlength="13" pattern="[\+]\d{2}\d{10}" placeholder="+911234567890"/> 
            </p>
             <p>
		            <label>Address</label>
                    <textarea rows="5" cols="25" id="address" name="address" ><?php echo $address ?></textarea>
            </p>
            <p>
            		<label>City</label>
                    <input id="city" name="city" type="text" value="<?php echo $city ?>" /> 
            </p>
            <p>
            		<label>Region</label>
                    <select onchange="set_country(this,country,city_state)" name="region">
                        <option value="" >Select Region</option>
							<script type="text/javascript">
                            setRegions(this);
                            </script>
                    </select>
            </p>
            <p>
            		<label>Country</label>
                    <select name="country" disabled="disabled" onchange="set_city_state(this,city_state)">
						<option value="" selected="selected">Select Country</option>
					</select>
            </p>
            <p>
            		<label>State</label>
                    <select name="city_state" disabled="disabled" onchange="print_city_state(country,this)">
						<option value="" selected="selected">Select State</option>
					</select>
            </p>
           </fieldset>
           <p>
 <input id="Submit" type="submit"  value="Update" name="submit" onClick="parent.emailwindow.hide()" />
 <input type="button" value="Close" onClick="parent.emailwindow.hide()" />
 </p>
            </div>
            </form>
</body>
</html>