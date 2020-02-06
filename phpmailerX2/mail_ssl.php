<?php

require_once('class.phpmailer.php');
require_once('mail_config.php');
require ('class.smtp.php');

// Mesajul
$message = "Mesaj 1\r\nSSL 2\r\nGmail 3";

// În caz că vre-un rând depășește 70 de caractere, trebuie să utilizăm
// wordwrap()
$message = wordwrap($message, 70, "\r\n");


$mail = new PHPMailer(true); 
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->IsSMTP();

try {
 
  $mail->SMTPDebug  = 2;                     
  $mail->SMTPAuth   = true; 
  
  $mail->SMTPAutoTLS = false;

  $to='florinachicarosa22@gmail.com';
  $nume='10 minute email';

  $mail->SMTPSecure = "ssl";                 
  

 $mail->Host = gethostbyname("smtp.gmail.com");

     
  $mail->Port       = 465;                   
  $mail->Username   = $username;  			// GMAIL username
  $mail->Password   = $password;            // GMAIL password
  $mail->AddReplyTo('phpfmi2020@gmail.com', 'Optional PHP');
  $mail->AddAddress($to, $nume);
 
  $mail->SetFrom('phpfmi2020@gmail.com', 'Optional PHP');
  $mail->Subject = 'Form - Contact';
  $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
  $mail->MsgHTML($message);
  $mail->Send();
  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //error from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //error from anything else!
}
?>
