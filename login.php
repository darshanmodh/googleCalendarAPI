<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="css/login_style.css">
        <link rel="stylesheet" href="css/jquery-ui.css" />
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>

<?php
include("connection.php");
session_start();
if($_SESSION['type'] == "user")
	header("Location: user.php");
if($_SESSION['type'] == "admin")
	header("Location: admin.php");
	
$hour = time() + 3600;
if($_POST['remember']) {
setcookie('remember_me', $_POST['uname'], $hour);
setcookie('remember_me_pass', $_POST['pass'], $hour);
}
elseif(!$_POST['remember']) {
	if(isset($_COOKIE['remember_me']) && isset($_COOKIE['remember_me'])) {
		$past = time() - 100;
		setcookie('remember_me', 'gone', $past);
		setcookie('remember_me_pass', 'gone', $past);
	}
}


if(isset($_POST["uname"]) && isset($_POST["pass"]) )
{
$result = mysql_query("SELECT * FROM reg WHERE uname='$_POST[uname]'");
while($row = mysql_fetch_array($result))
  {
	$pwdmd5 = $row["password"];
	$uid = $row["uid"];
  }
if(md5($_POST["pass"])==$pwdmd5)
{
	$_SESSION["uname"] = $_POST["uname"];
	$_SESSION["uid"] = $uid;
	$result1 = mysql_query("SELECT * FROM role WHERE uid='$uid'");
	while($row = mysql_fetch_array($result1))
  	{
		$isAdmin = $row["isAdmin"];
  	}
	if($isAdmin == 1)
	{
		$_SESSION["type"]="admin";
		header("Location: admin.php");
	}
	if($isAdmin == 0)
	{
		$_SESSION["type"]="user";
		header("Location: user.php");
	}
}
else
{
	?>
    <script type="text/javascript">
				/*$(document).ready(function(){
				$("#err").show().fadeIn('slow').delay(2000).fadeOut('slow');
				});*/
				$(function() {
    $( "#dialog" ).dialog({
      height: 140,
      modal: true
    });
  });
	</script>
    <?php
}
}

?>
    </head>

    <body>
    <div id="dialog" title="Invalid Login" style="display:none;">
  <p>Invalid Login...Re-enter username and password.</p>
</div>
        <form id="login" name="loginForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>LogIn</h1>
            <fieldset id="inputs">
                <input name="uname" id="username" type="text" placeholder="Username" value="<?php
echo $_COOKIE['remember_me']; ?>" required>   
                <input name="pass" id="password" type="password" placeholder="Password" value="<?php
echo $_COOKIE['remember_me_pass']; ?>" required>
            </fieldset>
            <fieldset id="check">
            	<input type="checkbox" name="remember" <?php if(isset($_COOKIE['remember_me'])) {
		echo 'checked="checked"';
	}
	else {
		echo '';
	}
	?> >Remember Me
            </fieldset>
             <div id="err" style="color:#F00;display:none;">Invalid Login...Re-enter username and password.</div>
            <fieldset id="actions">
                <input type="submit" id="submit" value="Log in">
            </fieldset>
        </form>
    </body>
</html>