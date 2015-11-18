<?php
/*if(isset($_POST["change"])){
	$uname = $_POST["uname"];
	session_start();
	$_SESSION["uname"] = $uname;
	header('Location:change.php');
}
if(isset($_POST["submit"])){*/
include("connection.php");

function decode_md5($hash)
{
  //simple check for md5 hash
  if(!preg_match('/^[a-f0-9]{32}$/i',$hash))return '';

  //make request to service
  $pass=file_get_contents('http://md5.darkbyte.ru/api.php?q='.$hash);

  //not found
  if(!$pass)return '';

  //found, but not valid
  if(md5($pass)!=strtolower($hash))return '';

  //found :)
  return $pass;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if(isset($_POST["uname"]) && isset($_POST["bday"]))
	{
		$result = mysql_query("SELECT * FROM reg WHERE uname='$_POST[uname]' AND bday='$_POST[bday]'");
		while($row = mysql_fetch_array($result))
  		{
			$pwdmd5 = $row["password"];
			$uid = $row["uid"];
			$fname = $row["fname"];
			$lname = $row["lname"];
			$email = $row["email"];
  		}
		$pwd = decode_md5($pwdmd5);
		if($pwd=="" || $pwd==" " || $pwd==NULL)
		{
			$msg1 = "Given information is wrong......";
		}
		else{
			if(isset($_POST["change"])){
	$uname = $_POST["uname"];
	session_start();
	$_SESSION["uname"] = $uname;
	header('Location:change.php');
}
if(isset($_POST["recover"])){
		///////////////////////////
		require_once "Mail.php";

        $from = "darshan.project123@gmail.com";
        $to = $email;
        $subject = "Your Password";
        $body = "Hi ".$fname." ".$lname.",\n\n Your Password is ".$pwd;
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
          $msg3 = "Mail cannot be sent.";
         } else {
          $msg3 = "Mail sent successfully on registered email ID.";
		   }
		}///////////////////////////clicked on submit
		}//else part pwd is not null
	}//uname and bday is set
	else
	{
		$msg2 = "Given information is wrong.";
	}
}//method is post
?>


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
    </head>

    <body>
        <form id="register" name="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1 id="h1reg">Forgot Password</h1>
            <fieldset id="inputsreg">   
                <input name="uname" id="uname" type="text" placeholder="Username" required>   
                <input name="bday" id="datepicker" type="text" placeholder="Birthday (MM/DD/YYYY)" required> 
                <label style="text-decoration: blink; color: red" />
				<?php 
				echo "$msg1";
				echo "$msg2";
				echo "$msg3";
				?>
            </fieldset>
            <center>
            <div id="btn">
                <table border="0" cellpadding="5">
                    <tr><td align="right"><input type="submit" id="submit" value="Get Password" name="recover" /></td><td>
                    <input type="submit" id="submit" value="Change Password" name="change" />
                    </td></tr>
                </table>
            </div>
           </center>
        </form>
    </body>
</html>
