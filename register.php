<?php
include("connection.php");
$themere = mysql_query("SELECT register FROM theme WHERE current='1'");
while($row = mysql_fetch_array($themere))
  {
	  $homepage = $row["register"];
  }
  
session_start();
if($_SESSION['type']=="user"){
	header('Location:index.php');
}
if(isset($_POST[uname]))
{ 
	include("check.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];
	$email = $_POST['email'];
	$bday = $_POST['bday'];
	$txtInput = $_POST['txtInput'];
	$prflpic="user.png";
	
	$captcha = $_SESSION['captcha'];
	
	if($txtInput==$captcha && $pass==$cpass)
	{
		$escapeduname = mysql_real_escape_string($uname); 
		$escapedPW = mysql_real_escape_string($pass);

		//$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

		//$saltedPW =  $escapedPW . $salt;

		//$hashedPW = hash('sha256', $saltedPW);
		
		$hashedPW = md5($pass);

		$sql = "insert into reg values ('','$fname', '', '$lname', '$escapeduname','$hashedPW','$email','$bday','','','','','','','$prflpic')";
		mysql_query($sql,$con);
		
		echo "<script type='text/javascript'>alert(LAST_INSERT_ID())</script>";
		$rolesql = "insert into role values ('',LAST_INSERT_ID(),'0')";
		mysql_query($rolesql,$con);
		/*echo "<script type='text/javascript'>alert('Successfully Registered')</script>";*/
		
		mysql_close($con);
		
		echo "<script type='text/javascript'>alert('Registered Successfully.')</script>";
		echo "<script>setTimeout(\"location.href = 'gopi.php';\",1);</script>";
	}
	else
	{
		$msg = "Register Unsuccessful";
		echo "<script type='text/javascript'>alert('Registered Unsuccessfully.')</script>";
	}
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="image/x-icon" href="images/ico/favicon_v2013_<?php $dayIcon = date("j"); echo $dayIcon.".ico"; ?>" rel="icon"> 
        <title>Registration Page</title>
        <link rel="stylesheet" type="text/css" href="css/screen.css" media="all" />
        <link href='<?php echo $homepage; ?>' type='text/css' rel='stylesheet' />  
        <link rel="stylesheet" type="text/css" href="css/reg1.css" />
        <link rel="stylesheet" href="css/jquery-ui-1.10.2.custom.css" /> 
        <link rel="stylesheet" href="css/pwd_strength.css" type="text/css"/>

        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/jquery.pwstrength.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>

        <script type="text/javascript">
            jQuery(function($) { $('#pass').pwstrength(); });
            
        function refreshIt(){
            
            console.log($("#cpass").val());
            $("#capId").attr("src","captcha.php?text=" + rndText());
        }
    
        function rndText()
        {
            str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
            rndStr = new String();
        
            for(i=1;i<=5;i++){
                var m = Math.ceil(Math.random()* (str.length-1));
                rndStr += str[m];            
            }
            return rndStr;
        }
 
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
        }
 
function msg(p1)
{
    if(p1=="OK")
        alert(p1);
    else
        alert(p1);
}
$("#capId").attr("src","captcha.php?text=" + rndText());
        </script>
        <script>
$(document).ready(function() {
    $( "#datepicker" ).datepicker({ maxDate: new Date, minDate: new Date(1950, 1, 1), changeYear: true, changeMonth:true });
    $( "#datepicker" ).datepicker( "option", "showAnim", "slideDown" );
});
             
function pass_match(pass, id){ 
    if(id=='pass'){
        other_id = "cpass"; 
        other_pass = $('input#cpass').val();
    } else {
        if(id=='cpass'){
            other_id = "pass"; 
            other_pass = $("input#pass").val(); 
        }
    }
   
    if(pass&&other_pass){
        if(pass!=other_pass){
            $("span#"+id).html("Passwords not match");
            $("span#"+other_id).html("");
        } else {
            $("span#"+id).html("");
        }
    }
    else
    {
    $("span#"+id).html("");
    }
}

//	FOR USERNAME EXIST OR NOT
$(document).ready(function(){
$('#uname').keyup(username_check);
});
	
function username_check(){	
var username = $('#uname').val();
if(username == "" || username.length < 2){
$('#uname').css('border', '3px #CCC solid');
$('#tick').hide();
}else{

jQuery.ajax({
   type: "POST",
   url: "check.php",
   data: 'username='+ username,
   cache: false,
   success: function(response){
if(response == 1){
	$('#submit').hide();
	$('#uname').css('border', '3px #C33 solid');	
	$('#tick').hide();
	$('#cross').fadeIn();
	var avai = "Username NOT available...Try Another";
	$('#avai').text(avai);
	$('#avai').show();
	}else{
	$('#submit').show();
	$('#uname').css('border', '3px #090 solid');
	$('#cross').hide();
	$('#tick').fadeIn();
	var avai = "Username available";
	$('#avai').text(avai);
	$('#avai').show();
	     }

}
});
}
}
//	USERNAME CHECKING COMPLETE
        </script>
<style>
#username{
	padding:3px;
	border:3px #CCC solid;
}

#tick{display:none}
#cross{display:none}
#avai{display:none}
</style>
    </head>
    <body onload="refreshIt()">
    <img title="logo" src="images/logo2.png" align="left" height="150" width="150" onmouseover="this.src='images/logo1.png'" onmouseout="this.src='images/logo2.png'" />
    <ul id="nav-reflection">
		<li class="button-color-1"><a href="http://www.facebook.com" title="facebook"></a></li>
		<li class="button-color-2"><a href="http://www.Twitter.com" title="Twitter"></a></li>
		<li class="button-color-3"><a href="http://www.plus.google.com" title="GooglePlus"></a></li>
		<li class="button-color-4"><a href="http://in.linkedin.com" title="Linkedin"></a></li>
	</ul> 
        <form id="register" name="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1 id="h1reg">Registration</h1>
            <fieldset id="inputsreg">
                <input name="fname" id="fname" type="text" placeholder="First Name" onkeypress="return onlyAlphabets(event,this);"required >   
                <input name="lname" id="lname" type="text" placeholder="Last Name" onkeypress="return onlyAlphabets(event,this);" required>
                <input name="uname" id="uname" type="text" placeholder="Username" required> <img id="tick" src="css/images/tick.png" width="16" height="16"/><img id="cross" src="css/images/cross.png" width="16" height="16"/>  
<span id="avai"></span>
                <input type="password" class="password" name="pass" id="pass" placeholder="Password" onBlur="pass_match(this.value, $(this).attr('id'))" data-indicator="pwindicator" required/>  <span id="pass" style="color:#F00"></span>
                <div id="pwindicator">
                    <div class="bar" align="right"></div><br>
                    <div class="label" align="right"></div>
                </div>

                <input type="password" class="password" name="cpass" id="cpass"  placeholder="Confirm Password" onBlur="pass_match(this.value, $(this).attr('id'))" required /> <span id="cpass" style="color:#F00"></span>
                <input name="email" id="email" type="email" placeholder="Email ID" required > 
                <input name="bday" id="datepicker" type="text" placeholder="Birthday (MM/DD/YYYY)" pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d" required> 
            </fieldset>
            <fieldset>
                <table>
                    <tr>
                        <th>
                            <img draggable="false" id="capId" src="captcha.php?text=" />
                        </th>
                        <th>
                            <a href="#" onclick="refreshIt()" style="text-decoration: none">Refresh</a>
                        </th>
                        <td>
                            <input type="text" name="txtInput" size="15" id="txtInput" placeholder="Enter code here" />    
                        </td>
                        <td></td>
                    </tr>
                    <tr><td colspan="3"><label style="text-decoration: blink; color: red" /> 
                        <?php
						echo $msg;
						?></td></tr>
                </table>
            </fieldset>

            <fieldset id="actions">
                <table border="0" width="100%" c cellpadding="1">
                    <tr><td><input type="submit" id="submit" value="Register" name="submit" /></td>
                        <td><input type="reset" id="reset" value="Reset" name="reset" /></td>
                        <td><a href="gopi.php"><input type="button" id="submit" value="Home" name="button1" /></a></td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </body>
</html>