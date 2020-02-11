<?php
require_once 'mailer/class.phpmailer.php'; 
$mail = new PHPMailer(true); 
$email      = strip_tags($email);
$subject    = "Password";
$text_message    = "";      
$message  = "Your password is : $password";
try
{
  $mail->IsSMTP(); 
  $mail->isHTML(true);
  $mail->SMTPDebug  = 0;                     
  $mail->SMTPAuth   = true;                  
  $mail->SMTPSecure = "ssl";                 
  $mail->Host       = "smtp.gmail.com";      
  $mail->Port        = '465';             
  $mail->AddAddress($email);
  $mail->Username   ="s0g0hotelmanagement@gmail.com";  
  $mail->Password   ="sogo-password";            
  $mail->SetFrom('s0g0hotelmanagement@gmail.com','Sogo Hotel');
  $mail->AddReplyTo("s0g0hotelmanagement@gmail.com","Sogo Hotel");
  $mail->Subject    = $subject;
  $mail->Body    = $message;
  $mail->AltBody    = $message;
  
  if($mail->Send())
  {
    print("<script>window.alert('Password successfully sent to $email');</script>");

  // $msg = " ".$email." ";
  
  }
}
catch(phpmailerException $ex)
{
  $msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";
  print("<script>window.alert('$msg');</script>");

  // echo $msg;
}

?>