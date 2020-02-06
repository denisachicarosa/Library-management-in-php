 <html>
    <head>
    <title>PHPMailer - SMTP (Gmail) basic test</title>
    </head>
    <body>
    <?php
    error_reporting(E_STRICT);
    date_default_timezone_set('America/Toronto');
 
    require_once('class.phpmailer.php');
    require_once('mail_config.php');
   
    $mail = new PHPMailer();
    $body = "this is <strong>testing</strong> mail ". date('Y-m-d H:i:s');
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                               // 1 = errors and messages
                                               // 2 = messages only
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
    $mail->Username   = $username;  // GMAIL username
    $mail->Password   = $password;            // GMAIL password
    $mail->SetFrom('name@yourdomain.com', 'First Last');
    $mail->AddReplyTo("name@yourdomain.com","First Last");
    $mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    $mail->MsgHTML($body);
    $address = "d1308329@urhen.com"; // add your address here
    $mail->AddAddress($address, "Gmail Test");
    if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
      echo "Message sent!";
    }
    ?>
    </body>
    </html>