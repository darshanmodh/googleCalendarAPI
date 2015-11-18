<?php
 require_once "Mail.php";

        $from = "darshan.project123@gmail.com";
        $to = "aaa@aa.com";
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
          echo("<p>" . $mail->getMessage() . "</p>");
         } else {
          echo("<p>Message successfully sent!</p>");
         }
?>