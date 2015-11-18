<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <link href="css/calendarlist.css" rel="stylesheet" type="text/css" />
        <link rel="canonical" href="https://plus.google.com/109040912844613890796" />
        <!--        <link rel="stylesheet" type="text/css" href="css/calendar1.css"></link>-->
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css"></link>
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui-1.10.2.custom.js"></script>
        <script>
            $(function() {
                $( "#tabs" ).tabs({
                    collapsible: true
                    //event: "mouseover"
                });
            });
        </script>
        <script>
            $(function() {
                $( "#accordion" ).accordion({
                    heightStyle: "content"
                });
            });
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>About Us</title>
    </head>
    <?php
	
include("connection.php");
session_start();
define('ACCESS', TRUE);
require_once('userheader.php');

if($_SESSION['type'] == "user"){
	if(isset($_SESSION['uid'])){
		echo "<h1>About Us</h1>";
	?>
    <body>
        <!--        start-->
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">About Project</a></li>
                <li><a href="#tabs-2">Web Administrators</a></li>
                <li><a href="#tabs-3">Social Media</a></li>
                <li><a href="#tabs-4">Feedback</a></li>
            </ul>
            <div id="tabs-1">
                <p><table width="100%" border="0">
                        <tr>
                            <th align="left" scope="row" colspan="3" style="font-family: cursive; font-size: x-large; text-align: center">B.Tech Project - 1</th>
                            <td rowspan="3" width="25%"><img src="images/logo.jpg" width="300" height="150" alt="logo" align="right" /></td>
                        </tr>
                        <tr>
                            <th><h1>Calendar and Event Management</h1></th>
                        </tr>
                        <tr>
                            <th>B.Tech Semester VII Computer Engineering Nov-Dec 2013</th>
                        </tr>
                    </table>
                    <br>
                        <table width="50%" border="0" cellpadding="5" cellspacing="5">
                        <tr><td width="25%">Internal Guide</td>
                            <td>:</td>
                            <td>Prof. Komal R. Patel</td></tr>
                            <tr><td width="25%"></td>
                            <td></td>
                            <td>Prof. Hiteshri N. Modi</td></tr>
                        <tr><td>Made By</td>
                            <td>:</td>
                            <td>Darshan Modh</td></tr>
                        <tr><td></td>
                            <td></td>
                            <td>Dhruvi Brahmbhatt</td></tr>
                        <tr><td>Technology</td>
                            <td>:</td>
                            <td>PHP</td></tr>
                        <tr><td>Database</td>
                            <td>:</td>
                            <td>MySQL</td></tr>
                        <tr><td>Designing</td>
                            <td>:</td>
                            <td>HTML 5,CSS3</td></tr>
                            <tr><th colspan="3" style="font-size: small;">Click <a href="PREFACE.pdf">here</a> to download project report</th></tr>
                    </table>
                </p>
            </div>
            <div id="tabs-2">
                <div><table width="100%" border="0" cellspacing="5" cellpadding="5">
                        <tr>
                            <th align="left" scope="row" width="15%">Name</th>
                            <th>: </th>
                            <td width="20%"> Darshan Modh</td>
                            <td rowspan="4"><img src="images/DSCN0010~1.jpg" width="150" height="150" alt="darshan" /></td>
                        </tr>
                        <tr>
                            <th align="left" scope="row">Enrollment No.</th>
                            <th>: </th>
                            <td>10012011046</td>
                        </tr>
                        <tr>
                            <th height="33" align="left" scope="row">Email ID</th>
                            <th>: </th>
                            <td> <a href="mailto:darshanmodh@gmail.com">darshanmodh@gmail.com</a></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                            <th align="left" scope="row">Name</th>
                            <th>: </th>
                            <td> Dhruvi Brahmbhatt</td>
                            <td rowspan="4"><img src="images/3b85150.jpg" width="150" height="150" alt="dhruvi" /></td>
                        </tr>
                        <tr>
                            <th height="30" align="left" scope="row">Enrollment No.</th>
                            <th>: </th>
                            <td>10012011011</td>
                        </tr>
                        <tr>
                            <th height="33" align="left" scope="row">Email ID</th>
                            <th>: </th>
                            <td> <a href="mailto:dhruviibrahmbhatt210@gmail.com">dhruviibrahmbhatt210@gmail.com</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="tabs-3">
                <div id="accordion">
                    <h3>Facebook</h3>
                    <div>
                        <p> You can like my profile by clicking on Like button and send messages to your Facebook Friends with Login ID. If you are not logged in click Like Button.</p>
                        <p><div id="fb-root"></div>
                            <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=584541344897666";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>

                            <div class="fb-like" data-href="https://www.facebook.com/darshanmodh" data-send="true" data-width="450" data-show-faces="true"></div></p>
                    </div>
                    <h3>Linkedin</h3>
                    <div>
                        <p> You can share an update on Linkedin by clicking the share button. You can view my Linkedin profile by log in with your account.</p>
                        <p> <script src="//platform.linkedin.com/in.js" type="text/javascript">
                        lang: en_US
                            </script>
                            <script type="IN/Share" data-url="http://www.linkedin.com/in/darshanmodh" data-counter="top"></script></p>
                    </div>
                    <h3>Google +</h3>
                    <div>
                        <p>Share your ideas on Google Plus with your friends, circles and groups. Login with your google account and +1 to my profile.</p>
                        <p> <div class="g-plusone" data-annotation="inline" data-width="300"></div>

                            <script type="text/javascript">
                            (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                            })();
                            </script></p>
                    </div>
                    <h3>Twitter</h3>
                    <div>
                        <p>You can follow me on Twitter by clicking the Follow button. Open Tweeter with your account and compose new tweets.</p>
                        <p><a href="https://twitter.com/darshan_modh" class="twitter-follow-button" data-dnt="true">Follow @darshan_modh</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>
                        <p><a href="https://twitter.com/share" class="twitter-share-button" data-related="jasoncosta" data-lang="en" data-size="large" data-count="none">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>
                    </div>
                </div>
            </div>
            <div id="tabs-4">
                <p>We Would love to here from you - any comments or suggestions or any questions you may have. We will endevour to get back to you as soon as possible. Use the form below and drop us an email!</p>
                <p>
                    <form action="about" method="post">
                        <table border="0">
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td><input size="49" type="text" name="name" required/></td>
                            </tr>
                            <tr>
                                <td>Email ID</td>
                                <td>:</td>
                                <td><input size="49" type="text" name="email"  required /></td>
                            </tr>
                            <tr>
                                <td>Mobile No.</td>
                                <td>:</td>
                                <td><input size="49" type="tel" name="number" maxlength="10" pattern="[0-9]{10}" required/></td>
                            </tr>
                            <tr>
                                <td valign="top">Message</td>
                                <td valign="top">:</td>
                                <td><textarea name="message" cols="50" rows="10" required ></textarea></td>
                            </tr>
                            <tr>
                                <td valign="top"></td>
                                <td valign="top"></td>
                                <td><input type="submit" value="Send" name="submit" /></td>
                            </tr>
                        </table>
                    </form>
                </p>
            </div>
        </div>
        <!--        end-->
        <?php
	}
}
?>
    </body>
</html>
