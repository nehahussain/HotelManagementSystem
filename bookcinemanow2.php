<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
body {
  background-color: #f1f1f1;
}

input {
  padding: 10px;
  width: 90%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}
</style>
</head>
<body>

<?php    
session_start();

    if(isset($_POST['submit']))
    {
        if($_POST['submit'])
        {
            if(array_key_exists('cinematype',$_POST)  and array_key_exists('seats',$_POST))
            {
                if (!empty($_POST['cinematype']) )
                {
                    if (!empty($_POST['seats']) )
                    {

                        define("DB_SERVER", "localhost");
                        define("DB_USER", "root");
                        define("DB_PASSWORD", "");
                        define("DB_DATABASE", "hotel");
                        $connect = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
                        
                        if($connect->connect_error)
                        {
                            die( "there was an error connecting to the database ".mysqli_connect_error());
                        }

                        $_SESSION["cinematype"] = $_POST["cinematype"];

                        $id=0;
                        if ($_SESSION["cinematype"] =="silver" )
                        {
                            $_SESSION["cinematype"] ="silver";
                            $id=1;
                            $_SESSION['price']= 500;

                        }
                        else if ($_SESSION["cinematype"] =="gold" )
                        {
                            $_SESSION["cinematype"] ="gold";
                            $id=2;
                            $_SESSION['price']= 700;
                        }
                        else if ($_SESSION["cinematype"] =="platinum" )
                        {
                            $_SESSION["cinematype"] ="platinum";
                            $id=3;
                            $_SESSION['price']= 1000;
                        }
                        $start = $_SESSION["startdate"];

                        $sql =  "select r.seatno, t.type from `cinematype` t , `cinemaseats` r
                      where r.typeid = t.typeid 
                      AND r.typeid='$id'
                      AND r.seatno not IN
                      (
                          select seatno from cinemastatus b
                          where b.seatno = r.seatno
                          And
                          (
                              ('$start' = b.date )
                          )
                      );";

                        if($result = mysqli_query($connect,$sql))
                        {
                            $x=0;
                            $val;
                        while($row = mysqli_fetch_array($result))
                        {
                            // echo $row[0];
                            $val[$x]=$row[0];
                            $x++;
                        }
                        
                        }
                        else
                        {
                            echo "error found in sql ";
                        }
                        // echo $val[0];
                        $_SESSION['seatno']=$val[0];


                        $bid=uniqid();
                        $bill=uniqid();
                        $val=$_SESSION["seatno"];
                        $checkin=$_SESSION["startdate"];
                        $price=$_SESSION["price"];

                        $sql ="INSERT INTO `cinemabooking` (`bookid`, `seatno`, `date`, `price`) VALUES ('$bid', '$val', '$checkin', '$price');";

                        if($result = mysqli_query($connect,$sql))
                        {
                            // echo "room booking details added";
                        
                        }
                        else
                        {
                            echo "error found in sql ";
                        }
                        $sql ="INSERT INTO `cinemabills` (`bid`, `bookid`, `price`) VALUES ('$bill', '$bid', '$price');";

                        if($result = mysqli_query($connect,$sql))
                        {
                            // echo "Bill generated";
                        
                        }
                        else
                        {
                            echo "error found in sql ";
                        }
                        $sql ="INSERT INTO `cinemastatus` (`seatno`, `date`, `bookid`) VALUES ('$val', '$checkin','$bid');";

                        if($result = mysqli_query($connect,$sql))
                        {
                            // echo "room status updated";
                        
                        }
                        else
                        {
                            echo "error found in sql ";
                        }

                        $currdate=date("Y-m-d");
                        $sql ="INSERT INTO `revenue` (`billid`, `price`, `date`) VALUES ('$bill', '$price', '$currdate');";

                        if($result = mysqli_query($connect,$sql))
                        {
                            // echo "Bill generated";
                        
                        }
                        else
                        {
                            echo "error found in sql ";
                        }
                        $email=$_POST['email'];
                        $sql ="INSERT INTO `cinemaemail` (`email`) VALUES ('$email');";

                        if($result = mysqli_query($connect,$sql))
                        {
                            // echo "email generated";
                        
                        }
                        else
                        {
                            echo "error found in sql ";
                        }

                        require_once 'mailer/class.phpmailer.php'; 
                        $mail = new PHPMailer(true);
                        $email      = $email;
                        $subject    = "***Event Room Booked Successfully***";
                        $text_message    = "";      
                        $message  ="Booking ID: $bid <br/>
                        Bill Id : $bill <br/>
                        email : $email <br/>
                        Seat No:$val<br/>
                        Show Date: $checkin <br/>
                        Cost : $price <br/>" ;
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
                            print("<script>window.alert('Cinema booked SuccesFully .Check Mail for Booking Details');</script>");
    
                          // $msg = " ".$email." ";
                          
                          }
                        }
                        catch(phpmailerException $ex)
                        {
                          $msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";
                          print("<script>window.alert('$msg');</script>");
    
                          // echo $msg;
                        } 
                        echo '<script type="text/javascript">'; 
                        echo 'alert("Seat Booked Successfully");'; 
                        echo 'window.location.href = "bookcinemanow.php";';
                        echo '</script>';


                        mysqli_close($connect);
                    } 
                    else
                    {
                        echo "Input Error:RoomNo!";
                    }   
                }
                else
                {
                    echo "Input Error:Roomtype!";
                }

            }
            else
            {
                echo "Input Error!";
            }

        } 
    }
                        
?> 
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
