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

  $to="florinachicarosa22@gmail.com";
  $nume='Message';


  $mail->SMTPSecure = "tls";                 
  $mail->Host       = "smtp.gmail.com";      
  $mail->Port       = 587; 
 
  $mail->SMTPAuth = true;
  $mail->Username   = $username;  			// GMAIL username
  $mail->Password   = $password;            // GMAIL password
  $mail->AddReplyTo('florinachicarosa22@gmail.com', 'Optional PHP');
  $mail->AddAddress($to, $nume);
 
  $mail->SetFrom('phpfmi2020@gmail.com', 'Optional PHP');
  $mail->Subject = 'New message from : '.$_POST['mail'];
  $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
  $text = htmlspecialchars($_POST["message"])." \n Message sent by ".$_POST["name"]." \n E-mail address: ".$_POST["mail"];
  $mail->MsgHTML($text);
  $mail->Send();
  $_SESSION["returntext"] ="Message sent";
  header('refresh:0 URL=../contact.php');
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //error from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //error from anything else!
}

?>


