<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include('connection.php');
$result = mysql_query("SELECT homepage FROM theme WHERE current='1'");
while($row = mysql_fetch_array($result))
  {
	  $homepage = $row["homepage"];
  }

$dayIcon = date("j");

if(isset($_POST['hiddenmsg'])){
	echo "<script type='text/javascript'>alert('Registered Successfully.')</script>";
}
?>
<title>Inspire Calendar</title>

	<link type="image/x-icon" href="images/ico/favicon_v2013_<?php echo $dayIcon.".ico" ?>" rel="icon"> 
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
        	<ul id="templatemo_menu">
            	<li class="menu_item"><a href="#about" class="text">Login</a></li>
                <li class="menu_item"><a href="#about" class="about icon"><span>About</span></a></li>
                <li class="blank">Blank</li>
                <li class="menu_item"><a href="register.php" class="social icon"><span>Social</span></a></li>
                <li class="menu_item no_margin_right"><a href="register.php" class="text">Register</a></li>
                
				<li class="blank">Blank</li>
                <li class="menu_item"><a href="#" title="Flash Templates" class="text">Home</a></li>
                <li class="menu_item"><a href="#services" class="portfolio icon"></a></li>
                <li class="menu_item"><a href="#services" class="text">Gallery</a></li>
                <li class="blank no_margin_right">Blank</li>

                <li class="menu_item"><a href="#portfolio" class="text">Forget Password</a></li>
                <li class="menu_item"><a href="#portfolio" class="services icon"></a></li>
                <li class="blank">Blank</li>
                <li class="menu_item"><a href="#contact" class="contact icon"><span>Contact</span></a></li>
                <li class="menu_item no_margin_right"><a href="#contact" class="text">Contact</a></li>
			</ul>
		
        <div class="section" id="about"> 
            <?php
		   require_once('login.php');
		   ?>
            <a href="#home" class="home_btn">home</a> 
            <a href="#home" class="page_nav_btn previous">Previous</a>
            <a href="#social" class="page_nav_btn next">Next</a>
        </div> 
        
        <div class="section" id="social"> 
        <center>
        <a href="register.php"><img src="images/reg_now.jpg" /></a></center>
            <a href="#home" class="home_btn">home</a> 
            <a href="#about" class="page_nav_btn previous">Previous</a>
            <a href="#services" class="page_nav_btn next">Next</a> 
		</div> 
        
        <div class="section" id="services"> 
			<?php
		   require_once('slide.php');
		   ?>
            <a href="#home" class="home_btn">home</a> 
            <a href="#social" class="page_nav_btn previous">Previous</a>
            <a href="#portfolio" class="page_nav_btn next">Next</a>		
		</div> 
        
        <div class="section" id="portfolio"> 
            <?php
		   require_once('recover1.php');
		   ?>
            <a href="#home" class="home_btn">home</a> 
            <a href="#services" class="page_nav_btn previous">Previous</a>
            <a href="#contact" class="page_nav_btn next">Next</a>
		</div> 
        
        <div class="section" id="contact"> 
            <h1>Contact</h1> 
            <div class="half left">
                <h4>Quick Contact</h4>
                <div id="contact_form">
                    <form method="post" name="contact" action="#contact">
                        <div class="col_175 left">
                            <label for="author">Name:</label> 
                            <input type="text" id="author" name="author" class="input_field" />
                        </div>
                        <div class="col_175 right">                           
                            <label for="email">Email:</label> 
                            <input type="text" id="email" name="email" class="input_field" />
                        </div>
                        <label for="text">Message:</label> 
                        <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                        <input type="submit" class="submit_btn float_l" name="submit" id="submit" value="Send" />
                    </form>
                </div>
			</div>
            
            <div class="half right">
                <h5><strong>Mailing Address</strong></h5>
          		Computer Engineering Department,<br />
            	U.V.Patel College of Enginnering,<br />
      			Ganpat University<br />
                Kherva.<br /><br />
				
				<strong>Phone:</strong> 9876543210 <br> <br>
                <strong>Email:</strong> <a href="mailto:darshan.project123@gmail.com">darshan.project123@gmail.com</a>  
               
            <a href="#home" class="home_btn">home</a> 
            <a href="#portfolio" class="page_nav_btn previous">Previous</a>
            <a href="#home" class="page_nav_btn next">Next</a>
		</div> 
	</div>
</div>
</body> 
</html>