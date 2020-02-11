<?php
if(isset($_POST['submit']))
{   
    define("DB_SERVER","localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD","");
    define("DB_DATABASE","admin");
    $connect = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);   
    if($connect->connect_error)
    {
        die ("Connection failed: " . $conn->connect_error);
    }
    
    $user_id = $_POST['id'];
    $check=0;

    $query =  "select * from adminlogininfo";
    mysqli_query($connect, $query);
    if($result = mysqli_query ($connect ,$query))
    {
        while($row = mysqli_fetch_array($result))
        {
                $id = $row[0];    
                $email=$row[1];      
                $password = $row[3];
                if($_POST['id'] == $id)
                {
                    $check=1;
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
                            echo '<script type="text/javascript">'; 
                            echo 'alert("Password successfully sent to '.$email.'");'; 
                            echo 'window.location.href = "login.php";';
                            echo '</script>';
                        }
                    }
                    catch(phpmailerException $ex)
                    {
                        $msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";
                        print("<script>window.alert('$msg');</script>");
                        
                    }

                    // break;
                }
        }

        if($check == 0)
        {
            print("<script>window.alert('invalid username or password');</script>");
        }
            
    }
mysqli_close($connect);
}
?>
<!DOCTYPE HTML>
<html>

<head>
<style type="text/css">
 input{
 border:1px solid olive;
 border-radius:5px;
 }
 h1{
  color:darkgreen;
  font-size:22px;
  text-align:center;
 }

</style>
</head>
<body>
<h1>Forgot Password<h1>
<form method='post'>
user id:<input type='text' name='id'/>
<input type='submit' name='submit' value='Submit'/>
</form>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>