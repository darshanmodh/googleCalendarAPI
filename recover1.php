<!DOCTYPE html>
<html>
    <head>
        <title>Recover Password</title>
        <link rel="stylesheet" type="text/css" href="css/recover.css" />
        <link rel="stylesheet" href="css/jquery-ui-1.10.2.custom.css" /> 

        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script>
            $(document).ready(function() {
                $( "#datepicker" ).datepicker();
                $( "#datepicker" ).datepicker( "option", "showAnim", "slideDown" );
            });
        </script>


<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if(isset($_POST["change"])){
		$uname = $_POST["uname"];
		$bday=$_POST["bday"];
		$unamechk="select uname from reg where uname='".$uname."' AND bday='".$bday."';";
		$sql=mysql_query($unamechk);
		$res=mysql_fetch_assoc($sql);
		$uname=$res['uname'];
		if($uname!=''){
		session_start();
		$_SESSION["uname"] = $uname;
		$_SESSION["token"] = 1;
		header('Location:gopi_fake.php');
		}else{
			?>
			<script type="text/javascript">
				/*$(document).ready(function(){
				$("#err1").show().fadeIn('slow').delay(2000).fadeOut('slow');
				});*/
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
	else if(isset($_POST["recover"]))
	{
		function gen_md5_password($len = 6)
		{       
			return substr(md5(rand().rand()), 0, $len);
		}
		$pass = gen_md5_password();
		
		$uname=$_POST["uname"];
		$bday=$_POST["bday"];
		$unamechk="select * from reg where uname='".$uname."' AND bday='".$bday."';";
		$sql=mysql_query($unamechk);
		//echo $emlval;
		$res=mysql_fetch_assoc($sql);
		$uid=$res['uid'];
		$email=$res['email'];
		$fname=$res['fname'];
		$lname=$res['lname'];
		
		if($uid!='')
		{
			$pwdmd5 = md5($pass);
			$sql1 = "update reg set password = '$pwdmd5' where uid ='$uid'";
			mysql_query($sql1);	
			
		require_once "Mail.php";

        $from = "darshan.project123@gmail.com";
        $to = $email;
        $subject = "Your Password";
        $body = "Hi ".$fname." ".$lname.",\n\n Your Password is ".$pass."\n\n Kindly requested to you to change the password first using this temporary password before login.";
		//$body = "Hi How are you?";

        $host = "ssl://smtp.gmail.com";
        $port = "465";//"587";
        $username = "darshan.project123";
        $password = "pass123word";
        $headers = array ('From' => $from,
          'To' => $to,
          'Subject' => $subject);
        $smtp =@ Mail::factory('smtp',
          array ('host' => $host,
            'port' => $port,
            'auth' => true,
            'username' => $username,
            'password' => $password));
        $mail = @$smtp->send($to, $headers, $body);
		
        if (@PEAR::isError($mail)) {
			//error_reporting(0);
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
         } else {
          ?>
			<script type="text/javascript">
				$(function() {
    				$( "#err3" ).dialog({
      				height: 140,
     				 modal: true
    				});
  				});
			</script>
			<?php
		   }
		}//uid is not null
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
	}//uname and bday is set
}//method is post

?>
	</head>
    <body> 
        <form id="register" name="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1 id="h1reg">Forgot Password</h1>
            <fieldset id="inputsreg">   
                <input name="uname" id="uname" type="text" placeholder="Username" required>   
                <input name="bday" id="datepicker" type="text" placeholder="Birthday (MM/DD/YYYY)" required> 
            </fieldset>
            <div id="err1" title="Wrong Information" style="color:#F00;display:none;">Given information is wrong.</div>
            <div id="err2" title="Mail not sent" style="color:#F00;display:none;">Mail cannot be sent.</div>
            <div id="err3" title="Mail Sent" style="color:#F00;display:none;">Mail sent successfully on registered email ID.</div>
            <br><br>
            <center>
                <table width="100%" border="0" cellpadding="5">
                    <tr><td align="right"><input type="submit" id="submit" value="Get Password" name="recover" /></td><td>
                    <input type="submit" id="submit" value="Change Password" name="change" />
                    </td></tr>
                </table>
            </center>
        </form>
    </body>
</html>
