<?php
	if(isset($_POST["subject"] ,$_POST["message"] ,$_POST["headers"])) {
		
		// subject
		$sub = $_POST["subject"];
		$subject = filter_var($sub, FILTER_SANITIZE_STRING);
		
		// message:
		$mes = $_POST["message"];
		$message = filter_var($mes, FILTER_SANITIZE_STRING);
		
		// headers ("From:".$from):
		$mail = $_POST["headers"];
		// Remove all illegal characters from email
		$email = filter_var($mail, FILTER_SANITIZE_EMAIL);
		
		/* Prints out contents
		echo '<p>sub: '.$sub.' = '.$subject.
			' mes: '.$mes.' = '.$message.
			' from: '.$mail.' = '.$email.'
			</p>';
		*/
		
		// Validate e-mail
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			// making html header
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: ".$email;
			
			// standard values
			$std_subject = "Inquery from ".$email." on blanke.one";
			$res_period = "24 hours";
			$to= "support@blanke.one";
			
			// wrap message and subject
			$wrap_message = '<html><body>
							<p>Someone with the mail: '.$email.' has sent you an email with the subject:</p>
							<p>"'.$subject.'" and the message:</p>
							<p>"'.$message.'"</p>
							<p>Remember to respond within '.$res_period.' as promised on website.</p></body>
							';
			
			// send mail to support@blanke
			mail($to,$std_subject, $wrap_message, $headers);
			
			// making response header
			$response_head = "MIME-Version: 1.0" . "\r\n";
			$response_head .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$response_head .= 'From: '.$to."\r\n";
			
			// send copy of message to sender
			$response_sub = 'Message recieved';
			$response_mes = '<html><body>
							<h3>Message recieved</h3>
							<p>You sent the following message on <a href="http://blanke.one">blanke.one</a>:</p>
							<p>'.$message.'</p>
							<p>I will send an answer to your inquery within '.$res_period.'.</p>
							<p>Have a nice day, Andreas Blanke</p></body>
							';
			mail($email,$response_sub,$response_mes,$response_head);
			
			$_SESSION["mail_sent"] = true;
			echo '<p>Your message has been sent. You can now close this page.
			</p>';
			echo "<script>window.close();</script>";
		} else {
			echo '<p>You entered an incorrect email. Your message was not sent.
			</p>';
		}
	} else {
		$_SESSION["mail_sent"] = false;
		echo '<p>Some fields was not filled out. Please go back and try again.
			</p>';
	} 
?>