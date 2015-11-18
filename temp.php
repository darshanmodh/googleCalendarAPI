<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
function temp(){
var mykey = 'AIzaSyDjU-y-u5EfiC0QcwRi94NXXaN4UhSD0Ug'; // typically like Gtg-rtZdsreUr_fLfhgPfgff
var calendarid = '3ruy234vodf6hf4sdf5sd84f@group.calendar.google.com'; // will look somewhat like 3ruy234vodf6hf4sdf5sd84f@group.calendar.google.com

$.ajax({
    type: 'GET',
    url: encodeURI('https://www.googleapis.com/calendar/v3/calendars/' + calendarid+ '/events?key=' + mykey),
    dataType: 'json',
    success: function (response) {
        //do whatever you want with each
    },
    error: function (response) {
        //tell that an error has occurred
    }
});

}
</script>
</head>

<body onload="temp()">
<iframe src="https://www.google.com/calendar/embed?src=en_gb.australian%23holiday%40group.v.calendar.google.com&ctz=Asia/Calcutta" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
</body>
</html>