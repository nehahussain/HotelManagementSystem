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
            if(array_key_exists('roomtype',$_POST)  and array_key_exists('rooms',$_POST))
            {
                if (!empty($_POST['roomtype']) )
                {
                    if (!empty($_POST['rooms']) )
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

                        $_SESSION["roomtype"] = $_POST["roomtype"];
                        $_SESSION["rooms"] = $_POST["rooms"];

                        echo "<form method ='post'>
                                <fieldset>
                                <legend><strong>Guest Details</strong></legend>";
                        echo 
                                '
                                <p>Enter Name </p>
                                <input type="Text" id="name" name="name" placeholder="john Doe">
                                <p>Enter Phone Number </p>
                                <input type="Number" id="number" name="number" placeholder="3001234567">
                                <p>Enter Email </p>
                                <input type="email" id="email" name="email" placeholder="john@yahoo.com" >
                                <br/>
                                <br/>
                                <input  type ="submit" name="booknow" value="Book Now">';
                        echo " </fieldset> </form>";
                        $id=0;
                        if ($_SESSION["roomtype"] =="Single" )
                        {
                            $_SESSION["roomtype"] ="Single";
                            $id=10001;
                            $_SESSION['price']= 5000;

                        }
                        else if ($_SESSION["roomtype"] =="Family" )
                        {
                            $_SESSION["roomtype"] ="Family";
                            $id=10002;
                            $_SESSION['price']= 8000;
                        }
                        else if ($_SESSION["roomtype"] =="Presidential" )
                        {
                            $_SESSION["roomtype"] ="Presidential";
                            $id=10003;
                            $_SESSION['price']= 12000;
                        }
                        $start = $_SESSION["startdate"];
                        $end = $_SESSION["enddate"] ;

                        $sql ="select r.roomno, t.type from `room_type` t , `roomdetails` r
                            where r.type_id = t.type_id 
                            And r.type_id = '$id'
                            AND r.roomno not IN
                            (
                                select roomno from roomstatus b
                                where b.roomno = r.roomno
                                And
                                (
                                    ('$start' BETWEEN b.checkin AND b.checkout) OR
                                    ('$end' BETWEEN b.checkin AND b.checkout) OR 
                                    ('$start' <= b.checkin AND '$end' >= b.checkout)
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
                        $_SESSION['roomno']=$val[0];
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

    else 
    if(isset($_POST['booknow']))
    {
        if($_POST['booknow'])
        {
            if(array_key_exists('name',$_POST)  and array_key_exists('number',$_POST) and array_key_exists('email',$_POST))
            {
                if (!empty($_POST['name']) )
                {
                    if (!empty($_POST['number']) )
                    {
                        if (!empty($_POST['email']) )
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

                            $_SESSION["name"] = $_POST["name"];
                            $_SESSION["number"] = $_POST["number"];
                            $_SESSION["email"] = $_POST["email"];
                            $name=$_SESSION["name"] ;
                            $number=$_SESSION["number"];
                            $email=$_SESSION["email"];
                            $gid=uniqid();
                            $bid=uniqid();
                            $bill=uniqid();
                            $val=$_SESSION["roomno"];
                            $checkin=strtotime($_SESSION["startdate"]);
                            $checkout=strtotime($_SESSION["enddate"]);
                            $days=$checkout-$checkin;
                            $totaldays= round($days / (60 * 60 * 24));
                            $checkin=$_SESSION["startdate"];
                            $checkout=$_SESSION["enddate"];
                            $price=$_SESSION["price"];
                            $totalprice=$price*$totaldays;
                            $roomtype=$_SESSION["roomtype"];


                            $sql ="INSERT INTO `guestdetails` (`gid`, `name`, `email`, `phoneno`) VALUES ('$gid', '$name', '$email', '$number');";
                            
                            if($result = mysqli_query($connect,$sql))
                            {
                                // echo "Guest Details Added";
                            }
                            else
                            {
                                echo "error found in sql ";
                            }

                            $sql ="INSERT INTO `roombooking` (`bookid`, `guestid`, `roomno`, `checkin`, `checkout`, `totaldays`, `totalPrice`) VALUES ('$bid', '$gid', '$val', '$checkin', '$checkout', '$totaldays', '$totalprice');";

                            if($result = mysqli_query($connect,$sql))
                            {
                                // echo "room booking details added";
                            
                            }
                            else
                            {
                                echo "error found in sql ";
                            }
                            $sql ="INSERT INTO `roombills` (`bid`, `bookid`, `facilities`, `price`, `totalprice`) VALUES ('$bill', '$bid', ' $roomtype * $totaldays days', '$price', '$totalprice');";

                            if($result = mysqli_query($connect,$sql))
                            {
                                // echo "Bill generated";
                            
                            }
                            else
                            {
                                echo "error found in sql ";
                            }
                            $sql ="INSERT INTO `roomstatus` (`roomno`, `checkin`, `checkout`, `bookid`) VALUES ('$val', '$checkin', '$checkout', '$bid');";

                            if($result = mysqli_query($connect,$sql))
                            {
                                // echo "room status updated";
                            
                            }
                            else
                            {
                                echo "error found in sql ";
                            }

                            $currdate=date("Y-m-d");
                            $sql ="INSERT INTO `revenue` (`billid`, `price`, `date`) VALUES ('$bill', '$totalprice', '$currdate');";

                            if($result = mysqli_query($connect,$sql))
                            {
                                // echo "Bill generated";
                            
                            }
                            else
                            {
                                echo "error found in sql ";
                            }

                            require_once 'mailer/class.phpmailer.php'; 
                            $mail = new PHPMailer(true);
                            $email      = $email;
                            $subject    = "***Room Booked Successfully***";
                            $text_message    = "";      
                            $message  ="Booking ID: $id <br/>
                            Guest Id : $gid <br/>
                            Bill Id : $bill <br/>
                            email : $email <br/>
                            phone no: $number <br/>
                            Room No:$val <br/>
                            Checkin Date: $checkin <br/>
                            CheckOut Date: $checkout <br/>
                            Total Days of stay :$totaldays <br/>
                            Total Cost : $totalprice <br/>" ;
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
                                print("<script>window.alert('Room booked SuccesFully .Check Mail for Booking Details');</script>");
        
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
                            // echo 'alert("Room Booked Successfully");'; 
                            echo 'window.location.href = "booknow.php";';
                            echo '</script>';
                             
                            // echo $val[0];
                            mysqli_close($connect);
                        } 
                        else
                        {
                            echo "Input Error:Email!";
                        }  
                    } 
                    else
                    {
                        echo "Input Error:Number!";
                    }   
                }
                else
                {
                    echo "Input Error:Name!";
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
