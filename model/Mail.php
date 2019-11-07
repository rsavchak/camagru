<?php

class Mail{

	public static function sendMail($email, $token){
		if ($email)
		{
			$mail_to = $email;
			$mail_subject = "Confirmation";
			$link = '<a href="http://camagru.com/confirm/' . $token . '">' . $token . '</a>'; 
			$mail_message = "Hello!<br/> You need to confirm your email, please follow this link<br/> $link";

			$encoding = "utf-8";

			$from_mail = "daemon@camagru.com";
			// Set preferences for Subject field
			$subject_preferences = array(
			"input-charset" => $encoding,
			"output-charset" => $encoding,
			"line-length" => 76,
			"line-break-chars" => "\r\n"
			);

			$header = "Content-type: text/html; charset=".$encoding." \r\n";
			$header .= "From: " . $from_mail . " \r\n";
			$header .= "MIME-Version: 1.0 \r\n";
			$header .= "Content-Transfer-Encoding: 8bit \r\n";
			$header .= "Date: ".date("r (T)")." \r\n";
			$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
			return mail($mail_to, $mail_subject, $mail_message, $header);
		}
		return false;
	}

	public static function sendPass($email, $pass){
		if ($email)
		{
			$mail_to = $email;
			$mail_subject = "Reset password";
			$mail_message = "Hello!<br/> You forgot your password? We sent you new password. Please, change this password for your own. This is your password:<br/> <strong>" . $pass . "</strong>";

			$encoding = "utf-8";

			$from_mail = "daemon@camagru.com";
			// Set preferences for Subject field
			$subject_preferences = array(
			"input-charset" => $encoding,
			"output-charset" => $encoding,
			"line-length" => 76,
			"line-break-chars" => "\r\n"
			);

			$header = "Content-type: text/html; charset=".$encoding." \r\n";
			$header .= "From: " . $from_mail . " \r\n";
			$header .= "MIME-Version: 1.0 \r\n";
			$header .= "Content-Transfer-Encoding: 8bit \r\n";
			$header .= "Date: ".date("r (T)")." \r\n";
			$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
			return mail($mail_to, $mail_subject, $mail_message, $header);
		}
		return false;
	}

	public static function sendCommentMail($user_image){
		if ($user_image['email'])
		{
			$mail_to = $user_image['email'];
			$mail_subject = "Comment";
			$mail_message = "Hello, " .$user_image['login'] . "<br/> Your photo was commented by user <strong>" . $_SESSION['login'] . "</strong> at " . date('M d, Y, H:i');

			$encoding = "utf-8";

			$from_mail = "daemon@camagru.com";
			// Set preferences for Subject field
			$subject_preferences = array(
			"input-charset" => $encoding,
			"output-charset" => $encoding,
			"line-length" => 76,
			"line-break-chars" => "\r\n"
			);
	
			$header = "Content-type: text/html; charset=".$encoding." \r\n";
			$header .= "From: " . $from_mail . " \r\n";
			$header .= "MIME-Version: 1.0 \r\n";
			$header .= "Content-Transfer-Encoding: 8bit \r\n";
			$header .= "Date: ".date("r (T)")." \r\n";
			$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
			return mail($mail_to, $mail_subject, $mail_message, $header);
		}
		return false;
	}
}