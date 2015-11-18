<?php
echo date("W", mktime(0,0,0,12,31,2010)); // To find number of weeks in a year
echo "<br />";
echo date("w", mktime(0,0,0,12,31,2010)); // To find number of weeks in a month
echo "<br /> <hr>";


$str = date('Y-m-d');
  $iStr = strtotime($str);
  $n = date('N', $iStr);#Mon = 1, Sun = 7
  $d1 = $n - 1; $d2 = 7 - $n;
  # monday in week
  $mon = date('Y-m-d', strtotime("-$d1 days", $iStr));
  echo $mon."<br>";
  # sunday in week
  $sun = date('Y-m-d', strtotime("+$d2 days", $iStr));
  echo $sun;
  var_dump($mon, $sun);
  echo "<hr>";
  
  	$first = date('Y-m-d', mktime(0, 0, 0, 8, 1, 2013));
	$last = date('Y-m-t', mktime(0, 0, 0, 8, 1, 2013));
	echo "$first<br>$last<br>";
	
	
	
$timestamp = strtotime($first);
$l = date("D", $timestamp);
echo $l;

$day=array("Sun"=>1,
			"Mon"=>2,
			"Tue"=>3,
			"Wed"=>4,
			"Thu"=>5,
			"Fri"=>6,
			"Sat"=>7);
echo $day[$l]."<hr>";


?>