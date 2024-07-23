<?php
require_once('PHPMailer/class.phpmailer.php'); 
include("PHPMailer/class.smtp.php");

$mail = new PHPMailer();

		$mail->IsSMTP();

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = "tls";

		$mail->Host = $smtp_server;

		$mail->Port = $port;  

		$mail->Username = $email;

		$mail->Password = $password; 

		$mail->From = $email;

		$mail->FromName = $from_name;

		$mail->Subject = $subject;

		$mail->AltBody = "";

		$mail->MsgHTML($description); 

		$mail->AddAddress($to, "");

		$mail->IsHTML(true);

		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		$mail->Send();
		
		
?>