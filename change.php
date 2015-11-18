<html>
    <head>
        <title>Change Password</title>
        <link rel="stylesheet" type="text/css" href="css/recover.css" />
        <link rel="stylesheet" href="css/jquery-ui-1.10.2.custom.css" /> 
        <link rel="stylesheet" href="css/pwd_strength.css" type="text/css"/>
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="js/jquery.pwstrength.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script>
		jQuery(function($) { $('#pass').pwstrength(); });
		function goBack(){
			window.location.replace("gopi.php");
		}
           
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
        </script>
        
<?php
session_start();
if(isset($_SESSION["uname"]))
{
	include("connection.php");
	$uname = $_SESSION['uname'];
	$opass = $_POST['opass'];
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];
	$pwdmd5 = md5($opass);
	
	if(isset($pass)){
	if($pass == $cpass)
	{
		$unamechk="select * from reg where uname='".$uname."' AND password='".$pwdmd5."';";
		$sql=mysql_query($unamechk);
		$res=mysql_fetch_assoc($sql);
		$uid=$res['uid'];
		if($uid!='')
		{
			$pass = md5($pass);
			$sql1 = "update reg set password = '$pass' where uid ='$uid'";
			mysql_query($sql1);	
			unset($_SESSION['uname']);
			?>
				<script type="text/javascript">
                    $(function() {
    				$( "#msg1" ).dialog({
      				height: 140,
     				 modal: true
    				});
  				});
                </script>
			<?php
		}
		else{
			?>
				<script type="text/javascript">
                   $(function() {
    				$( "#err2" ).dialog({
      				height: 140,
     				 modal: true
    				});
  				});
                </script>
			<?php
		}
	}
	else{
		?>
			<script type="text/javascript">
				$(function() {
    				$( "#err1" ).dialog({
      				height: 140,
     				 modal: true
    				});
  				});
			</script>
		<?php
	}
}
}
else{
	header('Location:gopi.php');
}
?>
    </head>
    <body>
        <form id="register" name="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1 id="h1reg">Change Password</h1>
            <fieldset id="inputsreg">   
                <input name="opass" id="opass" type="password" placeholder="Old Password" required />
                <input type="password" class="password" name="pass" id="pass" placeholder="New Password" onBlur="pass_match(this.value, $(this).attr('id'))" data-indicator="pwindicator" required/>  <span id="pass" style="color:#F00"></span>
                <div id="pwindicator">
                    <div class="bar" align="right"></div><br>
                    <div class="label" align="right"></div>
                </div>

                <input type="password" class="password" name="cpass" id="cpass"  placeholder="Confirm Password" onBlur="pass_match(this.value, $(this).attr('id'))" required /> <span id="cpass" style="color:#F00"></span>
            </fieldset>
            <div id="err1" title="Wrong Password" style="color:#F00;display:none;">Password and Confirm Password are not matched.</div>
            <div id="err2" title="Wrong Information" style="color:#F00;display:none;">Given information is wrong.</div>
            <div id="msg1" title="Successfully Changed" style="color:#F00;display:none;">Password is changed successfully.</div>
            <fieldset id="actions">
                <table width="100%" border="0" cellpadding="5">
                    <tr><td align="right"><input type="submit" id="submit" value="Change Password" name="recover" /></td><td>
                    <input type="button" id="submit" value="Home" name="submit1" onClick="goBack();" />
                    </td></tr>
                </table>
            </fieldset>
        </form>
    </body>
</html>
