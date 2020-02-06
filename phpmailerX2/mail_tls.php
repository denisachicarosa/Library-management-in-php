<?php
session_start();
require_once('class.phpmailer.php');
require_once('mail_config.php');

// Mesajul
$random_code = uniqid();   
 
$_SESSION["correct_code"] = $random_code;
$message = "Go back and enter the following code : ".$random_code;

// În caz că vre-un rând depășește 70 de caractere, trebuie să utilizăm
// wordwrap()
$message = wordwrap($message, 70, "\r\n");


$mail = new PHPMailer(true); 
$mail -> SetLanguage("en",'language/');

$mail->IsSMTP();


try {
 
  $mail->SMTPDebug  = 0;                     

  $to=$_SESSION["mail"];
  $nume='10 minute email';

  $_SESSION["code"] = $random_code;

  $mail->SMTPSecure = "tls";                 
  $mail->Host       = "smtp.gmail.com";      
  $mail->Port       = 587; 
 
  $mail->SMTPAuth = true;
  $mail->Username   = $username;  			// GMAIL username
  $mail->Password   = $password;            // GMAIL password
  $mail->AddReplyTo('phpfmi2020@gmail.com', 'Optional PHP');
  $mail->AddAddress($to, $nume);
 
  $mail->SetFrom('phpfmi2020@gmail.com', 'Optional PHP');
  $mail->Subject = 'Form - Verification Email';
  $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
  $mail->MsgHTML($message);
  $mail->Send();
  header('refresh:0 URL=../verification.php');
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //error from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //error from anything else!
}

?>


