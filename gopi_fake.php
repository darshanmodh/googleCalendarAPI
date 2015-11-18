<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include('connection.php');
$result = mysql_query("SELECT gopifake FROM theme WHERE current='1'");
while($row = mysql_fetch_array($result))
  {
	  $homepage = $row["gopifake"];
  }
?>
<title>Inspire Calendar</title>

	<link rel="stylesheet" type="text/css" href="css/screen.css" media="all" />
	<script src="js/script.js"></script>
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/execute.js"></script>
    <link href='<?php echo $homepage; ?>' type='text/css' rel='stylesheet' />  
	<script type='text/javascript' src="js/jquery.min.js"></script> 
	<script type='text/javascript' src='js/jquery.scrollTo-min.js'></script> 
	<script type='text/javascript' src='js/jquery.localscroll-min.js'></script> 
	<script type='text/javascript' src='js/init.js'></script> 
    <!-- templatemo_370_focus -->
    <link rel="stylesheet" href="css/slimbox2.css" type="text/css" media="screen" /> 
    <script type="text/JavaScript" src="js/slimbox2.js"></script> 
	
</head> 
<body> 
<div>
<img title="logo" src="images/logo1.png" align="left" height="150" width="150" onmouseover="this.src='images/logo2.png'" onmouseout="this.src='images/logo1.png'" />
<ul id="nav-reflection">
		<li class="button-color-1"><a href="http://www.facebook.com" title="facebook"></a></li>
		<li class="button-color-2"><a href="http://www.Twitter.com" title="Twitter"></a></li>
		<li class="button-color-3"><a href="http://www.plus.google.com" title="GooglePlus"></a></li>
		<li class="button-color-4"><a href="http://in.linkedin.com" title="Linkedin"></a></li>
	</ul>
</div>
<div id="templatemo_wrapper">											
	<div id="content"> 
    	<div id="home">
        	
		
          <div class="section" id="about"> 
            <?php
		   require_once('change.php');
		   ?>
            <a href="gopi.php" class="home_btn">home</a> 
            </div>
       </div>
	</div>
</div>
</body> 
</html>