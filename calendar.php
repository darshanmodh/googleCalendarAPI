<?php 
include("connection.php");
$themere = mysql_query("SELECT calendar FROM theme WHERE current='1'");
while($row = mysql_fetch_array($themere))
  {
	  $homepage = $row["calendar"];
  }
session_start();

if($_SESSION['type'] == "user"){
	$uid = $_SESSION['uid'];

$result = mysql_query("SELECT * FROM reg WHERE uid='$uid'");
while($row = mysql_fetch_array($result))
  {
	  $fname = $row["fname"];
	  $lname = $row["lname"];
	  $uname = $row["uname"];
	  $email = $row["email"];
	  $bday = $row["bday"];
	  $usrpic = $row["pic"];
  }
}
else{
	header('Location:invalid.php');
}
	//date_default_timezone_set('Asia/Calcutta');
    $iYear = $_POST['iYear'];
    $iMonth = $_POST['iMonth'];

    $iTDay = date("j");
    $iTYear = date("Y");
    $iTMonth = date("m");

    if ($iYear == 0) {
        $iYear = $iTYear;
        $iMonth = $iTMonth;
    }

	$days = cal_days_in_month(CAL_GREGORIAN, $iMonth, $iYear);
    //int weekStartDay = cal.get(Calendar.DAY_OF_WEEK);
	$first = date('Y-m-d', mktime(0, 0, 0, $iMonth, 1, $iYear));
	$timestamp = strtotime($first);
	$l = date("D", $timestamp);
	$day=array("Sun"=>1,
			"Mon"=>2,
			"Tue"=>3,
			"Wed"=>4,
			"Thu"=>5,
			"Fri"=>6,
			"Sat"=>7);
	$weekStartDay=$day[$l];

    $iTotalweeks = date("w", mktime(0,0,0,12,31,2010));

    if ($iMonth == $iTMonth && $iYear == $iTYear) {?>
<style>
    #day_<?php echo($iTDay); ?>
    {
        background-image:url(images/texture.jpg);
        border-style: double;
        border-width: thick;
    }
</style>
<?php }
?>
<html>
    <head>
    
<link rel="stylesheet" href="zzz/dhtmlwindow.css" type="text/css" />
<script type="text/javascript" src="zzz/dhtmlwindow.js"></script>
<link rel="stylesheet" href="zzz/modal.css" type="text/css" />
<script type="text/javascript" src="zzz/modal.js"></script>
  
        <title>Calendar Page</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $homepage  ?>">
        <script>
            function big(x)
            {
                x.style.backgroundimage="url(images/texture.jpg)";
                //x.style.height="50";
                x.style.width="100%";
                x.style.color="#FFCBA4";
            }

            function normal(x)
            {
                x.style.backgroundimage="url(images/texture.jpg)";
                //x.style.height="35";
                x.style.width="14.28%";
                x.style.color="black";
                
            }
            function goTo()
            {
                document.frm.submit()
            }
	    function formSubmit(iM,iY){
		document.forms[0].iMonth.value = iM;
		document.forms[0].iYear.value = iY;
		document.forms[0].submit();
	}
        </script>
    </head>

    <body alink="#660033" vlink="#660033" link="#660033">
        <form name="frm" method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
                <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="t1">
                                <td width="6%">Year</td>
                                <td width="7%">
                                    <select name="iYear" onChange="goTo()">
                                        <?php
                                            // start year and end year in combo box to change year in calendar
                                            for ($iy = $iTYear - 70; $iy <= $iTYear + 70; $iy++) {
                                                if ($iy == $iYear) {
                                       ?>
                                        <option value="<?php echo($iy); ?>" selected="selected"><?php echo($iy) ?></option>
                                        <?php
                                        } else {
                                        ?>
                                        <option value="<?php echo($iy) ?>"><?php echo($iy) ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select></td>
                                <td width="73%" align="center">
					<input type="image" id="myimage" src="images/previous.png" onClick="formSubmit(<?php echo "$iMonth != 1 ? $iMonth - 1 : 12,$iMonth != 1 ? $iYear : $iYear - 1" ?>);" />
					<a href="<?php echo $_SERVER['PHP_SELF'];?>" style="text-decoration:none;">
					<b id="cal">
						<?php
							$date = new DateTime('2011/'.$iMonth.'/14');
							echo $date->format('F');
							echo(" ".$iYear);
						?>
					</b>
					</a>
					<input type="image" id="myimage" src="images/next.png" onClick="formSubmit(<?php echo "$iMonth != 12 ? $iMonth + 1 : 1,$iMonth != 12 ? $iYear : $iYear + 1" ?>);" />
				</td>
                                <td width="6%">Month</td>
                                <td  width="8%">
                                    <select name="iMonth" onChange="goTo()">
                                        <?php
                                            // print month in combo box to change month in calendar
                                            for ($im = 1; $im <= 12; $im++) {
                                                if ($im == $iMonth) {
                                        ?>
                                        <option value="<?php echo($im) ?>" selected="selected"><?php 
										$date = new DateTime('2011/'.$im.'/14');
										echo $date->format('F'); ?></option>
                                        <?php
                                        } else {
                                        ?>
                                        <option value="<?php echo($im) ?>"><?php 
										$date = new DateTime('2011/'.$im.'/14');
										echo $date->format('F'); ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
				</td>
                            </tr>
                        </table><br></td>
                </tr>
                <tr>
                    <td><table align="center" border="1" cellpadding="3" cellspacing="0" width="100%" style="table-layout:fixed">
                            <tbody>
                                <tr class="d1">
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </tr>
                                <?php
                                    $cnt = 1;
                                    for ($i = 1; $i <= $iTotalweeks; $i++) {
                                ?>
                                <tr class="d2">
                                    <?php
                                        for ($j = 1; $j <= 7; $j++) {
                                            if ($cnt < $weekStartDay || ($cnt - $weekStartDay + 1) > $days) {
                                    ?>
                                    <td  align="center" width="14.28%">&nbsp;</td>
                                    <?php               } else {
										$chkEvent_sql = "SELECT eventname FROM event WHERE month(eventdate1) = '".$iMonth."' AND dayofmonth(eventdate1) = '".($cnt - $weekStartDay + 1)."' AND year(eventdate1) = '".$iYear."' AND uid='$uid' ORDER BY eventdate1 LIMIT 3";
										$chkEvent_res = mysql_query($chkEvent_sql, $con) or die(mysql_error($con));
										
		if (mysql_num_rows($chkEvent_res) > 0) {
			$event_title = "<br/>";
			while ($ev = mysql_fetch_array($chkEvent_res)) {
				$event_title .= stripslashes($ev["eventname"])."<br/>";
			}
			mysql_free_result($chkEvent_res); 
		} else {
			$event_title = "";
		}
                                    ?>
                                    <td align="center" width="14.28%" id="day_<?php echo($cnt - $weekStartDay + 1) ?>" >
                                    <div style="min-height:100px; max-height:110px;">
                                    <a class="a1" style="text-decoration: none" href="#"  onClick="insertevent('insertevent.php?day=<?php echo($cnt - $weekStartDay + 1)?>&month=<?php $date = new DateTime('2011/'.$iMonth.'/14'); echo $date->format('n'); ?>&year=<?php echo($iYear)?>');">
                                    	<div class="l1" onMouseOver="big(this)" onMouseOut="normal(this)"><?php echo($cnt - $weekStartDay + 1)?></div></a>
                                        <div id="event_content" style="position:relative; max-height:110px;">
                                           <div>
                                           <?php echo "<a href='#'>".$event_title."</a>"; unset($event_title); ?>
                                           </div>
                                       </div>
                                    </div>
                                    </td>
                                    <?php
                                            }
                                            $cnt++;
                                        }
                                    ?>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table></td>
                </tr>
            </table>
        </form>
</body>
</html>

<script type="text/javascript">
function insertevent(n){
	emailwindow=dhtmlmodal.open('EmailBox', 'iframe', n, 'Insert Event','width=600px,height=400px,center=1,resize=0,scrolling=1')
}
</script>
