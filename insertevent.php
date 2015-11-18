<?php
include("connection.php");
session_start();
$uid = $_SESSION['uid'];
if($_GET['day']==null || $_GET['month']==null || $_GET['year']==null || !isset($_SESSION['type']))
	header('Location:index.php');
$day=$_GET['day'];
$month=$_GET['month'];
$year=$_GET['year'];
$time = $month."/".$day."/".$year;
$time = strtotime($time);
if($time=='' || $time==null){
	header('Location:index.php');
}else{
	$ymd = date('Y-m-d',$time);
	$dmy = date('d-m-Y',$time);
	$hour = date('G');
	$min = date('i');
	$timefrom = $hour.":".$min.":00";
	if($hour==23)
		$timeto = "00:".$min.":00";
	else
		$timeto = $hour+1 .":".$min.":00";
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
	  
$('#all_day').live("click", function() {
    if (this.checked) {
        $('#divCaption').fadeIn();
    }
    else {
        $('#divCaption').fadeOut();
    }
});

$('#repeat').live("click", function() {
    if (this.checked) {
        $('#divRepeat').fadeIn();
    }
    else {
        $('#divRepeat').fadeOut();
    }
});

$('#chk_share').live("click", function() {
    if (this.checked) {
        $('#divShare').fadeIn();
    }
    else {
        $('#divShare').fadeOut();
    }
});

$(function(){
    $('#color').change(function(){
       $(this).addClass('changed');
    })
})
</script>
</head>

<body>
<form action="success.php" method="post">
            <div class="midcontent">
            <fieldset class="box">
            <p>
            		<label>Event Name</label>
                    <input id="event_name" name="event_name" type="text" required="required" />    
            </p>
			<div id="name" style="color:#F00;display:none;" align="center">Please Enter Event name</div>

            <p>
		            <label>Event Description</label>
                    <textarea rows="5" cols="25" id="event_description" name="event_description"></textarea>
            		<br>
            </p>
            <div id="description" style="color:#F00;display:none" align="center">Please Enter Event Description</div>
            
            <p>
            		<label>Event Location</label>
                    <input id="event_location" name="event_location" type="text" />    
            </p>
            
            <p>
            		<label>Event Date</label>
                    <input id="event_date_from" name="event_date_from" type="text" readonly="readonly" value="<?php echo $ymd ?>" /> TO <input id="event_date_to" name="event_date_to" type="text" readonly="readonly" value="<?php echo $ymd ?>" />
              <div class="answer" id="divCaption" style="display:none ">
    		<p>
            		<label>Event Time (HH:MM:SS)</label>
            		<input id="event_time_from" name="event_time_from" type="text" value="<?php echo $timefrom ?>" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}"/> 
                    TO
                    <input id="event_time_to" name="event_time_to" type="text" value="<?php echo $timeto ?>" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}"/>
            </p>
              </div>
               <div id="divRepeat" style="display:none">
    				<p><label>Repeats</label>
                    <select name="repeatValue"/>
                        <option value="no_repeat" selected="selected">No Repeat</option>
                        <option value="daily">Daily</option>
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select></p>
                    <p><label>Starts on</label>
                     <input id="start_on" name="start_on" type="date" /></p>
                    <p><label>Ends on</label>
                     <input id="end_on" name="end_on" type="date" /></p>
              </div>
              <div id="name" style="color:#F00;display:none;" align="center">Please Enter Event Date</div>
            <p>
                    <input id="all_day" name="all_day" type="checkbox" value="all_day"/> Show Time
                    &nbsp;&nbsp;<input id="repeat" name="repeat" type="checkbox" value="repeat"/> Repeat...
            </p>
            <p>
            		<label>Event Color</label>
            		 <input type="color" name="color" id="color" value="#00FF00"/>
            </p>
            <p>
            		<label>Share</label>
                    <input id="chk_share" name="chk_share" type="checkbox" value="true"/> I want to share event with other users
            </p>
            <div id="divShare" style="display:none">
         	<p>
            	<label>Select Users</label>
                <select multiple="multiple" name="shareduser[]" style="width:70%;"/>
               	<?php 
					$sql1=mysql_query("select * from reg where not uid='$uid'");
          			
					while ($line = mysql_fetch_assoc($sql1))
					{
				?>
                			<option value="<?php echo $line['email']; ?>"><?php echo $line['fname']." ".$line['lname'];?></option> 
		  		<?php
					}?>
                </select>
            </p>
            </div>
           </fieldset>
           <p>
 <input id="Submit" type="submit"  value="Submit" name="submit" />
 <input type="button" value="Close" onClick="parent.emailwindow.hide()" />
 </p>
            </div>
            </form>

</body>
</html>