<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" 
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title></title>
<script type="text/javascript" src="city_state.js"></script>
</head>
<body>
<div id="widget">
<form>
Region <select onchange="set_country(this,country,city_state)" name="region">
<option value="" selected="selected">SELECT REGION</option>
<script type="text/javascript">
setRegions(this);
</script>
</select>
Country <select name="country" disabled="disabled" onchange="set_city_state(this,city_state)">
	<option value="" selected="selected">SELECT COUNTRY</option>
</select>
State <select name="city_state" disabled="disabled" onchange="print_city_state(country,this)">
	<option value="" selected="selected">SELECT STATE</option>
</select>
</form>
<div id="txtregion"></div>
<div id="txtplacename"></div>
</div>
</body>
</html>