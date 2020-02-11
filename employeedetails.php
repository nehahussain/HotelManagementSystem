<?php
session_start();
if (isset($_SESSION['user'])) {
?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Sogo Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/fancybox.min.css">
    
    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">

  <style>
  .collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
.prog {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333333;
}

.progresss{
    float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 16px;
  text-decoration: none;
}

img {
  float: left;
}
</style>

  </head>
  <body>
    
    <header class="site-header js-site-header">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="index.html">Sogo Hotel</a>
          </div>
          <div class="col-6 col-lg-8 site-logo"  data-aos="fade" style="text-align:right;" ><a href="logout.php">Logout</a></div>

          <div class="col-6 col-lg-8">
            <!-- END menu-toggle -->
          </div>
        </div>
      </div>
    </header>
    <!-- END head -->

    <section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Admin Portal</h1>
          </div>
        </div>
      </div>

      <a class="mouse smoothscroll" href="#next">
        <div class="mouse-icon">
          <span class="mouse-wheel"></span>
        </div>
      </a>
    </section>  
    <!-- END section -->
  <div id ="error">
  </div>
    <section class="section contact-section" id="next">
          
    <div class="col-sm-3" style="background-color:lavender;">
      <nav class="navbar navbar-inverse">
          <div class="container-fluid">
              <ol class="nav navbar-nav">
                  <li style="font-size:25px;"><a href="loggedin.php">Home</a></li>
                  <li style="font-size:25px;"><a href="adduser.php">Add Authorized Users</a></li>
                  <li style="font-size:25px;"><a href="roommanagement.php">Room Management</a></li>
                  <li style="font-size:25px;" ><a href="reserveroom.php">Room Reservations</a></li>
                  <li  style="font-size:25px;" ><a href="customerdetails.php">Customer Details</a></li>
                  <li  style="font-size:25px;"><a href="eventmanagement.php">Event Management</a></li>
                  <li  style="font-size:25px;"><a href="reserveevent.php">Event Reservations</a></li>
                  <li  style="font-size:25px;"><a href="cinemamanagement.php">Cinema Management</a></li>
                  <li  style="font-size:25px;"><a href="cinemareservation.php">Cinema Reservations</a></li>
                  <li  style="font-size:25px;"><a href="bills.php">Customer invoice</a></li>
                  <li  style="font-size:25px;" class ="active"><a href="employeedetails.php">Employee Details</a></li>
                  <li style="font-size:25px;"><a href="signupcustomers.php">Signed Up Customers</a></li>
                  <li style="font-size:25px;"><a href="messages.php">Contact Us</a></li>
                  <li style="font-size:25px;"><a href="revenuemanagement.php">Revenue Management</a></li>
              </ol>
          </div>
      </nav>
    </div>

    <div class="col-sm-9" style="background-color:lavenderblush;">
    <button type="button" class="collapsible">Check Employee Details </button>
    <div class="content">
        <form method ="post">
            <h1>Employee Details</h1>
            <br>
            <h3>Enter Employee ID</h3>
            <input  type ="text" name="name"  placeholder= "Enter name" required data-value-missing="This field is required!">
            <br/>
            <br/>
            <input  type ="submit" name="submit" value="check" >
            <br/>
            <br/>
          </form> 

          <?php
if(isset($_POST['submit']))
{
    if(isset($_POST['name']))
    {
        if(array_key_exists('name',$_POST))
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
            $check=0;
            $Empid=$_POST['name'];
            $sql ="SELECT * FROM `employeedetails` where Empid = '$Empid';";

            if($result = mysqli_query($connect,$sql))
            {
            
            while($row = mysqli_fetch_array($result))
            {
              if ($row[8]=="0000-00-00")
              {
                $row[8]="Currently Employed";
              }
               
            echo 
            '
            <tr><td> ID         : '.$row[0].'</td></tr>
            <br/>
            <tr><td> Name       : '.$row[1].'</td></tr>
            <br/>
            <tr><td> Age        : '.$row[2].'</td></tr>
            <br/>
            <tr><td> Address    : '.$row[3].'</td></tr>
            <br/>
            <tr><td> Phone      : '.$row[4].'</td></tr>
            <br/>
            <tr><td> Email      : '.$row[5].'</td></tr>
            <br/>
            <tr><td> Salary     : '.$row[6].'</td></tr>
            <br/>
            <tr><td> Start Date : '.$row[7].'</td></tr>
            <br/>
            <tr><td> End date   : '.$row[8].'</td></tr>';
            }
            echo "</table>";
            $check=1;
            }
            if ($check==0)
            {
                echo "Employee Id is incorrect";
            }
            mysqli_close($connect);  
        }
        else
            {
                echo "Input Error:Employee Id Incorrect!";
            }
    }
    else
        {
            echo "Error 1!";
        }
}
?>
    </div>

    <button type="button" class="collapsible">Enter a new Employee in the database</button>
    <div class="content">
        <form method ="post">
            <h1>Employee Details</h1>
            <br>
            <h3>Name</h3>
            <input  type ="text" name="name"  placeholder= "Enter name" required data-value-missing="This field is required!">
            <br/>
            <br/>
            <h3>Age</h3>
            <input  type ="number" name="age"  placeholder= "Enter age" required data-value-missing="This field is required!">
            <br/>
            <br/>
            <h3>Address</h3>
            <input  type ="text" name="address"  placeholder= "Enter address" required data-value-missing="This field is required!">
            <br/>
            <br/>
            <h3>Phone</h3>
            <input  type ="number" name="phone"  placeholder= "Enter phone number" required data-value-missing="This field is required!">
            <br/>
            <br/>
            <h3>Email</h3>
            <input  type ="email" name="email"  placeholder= "Enter email" required data-value-missing="This field is required!">
            <br/>
            <br/>
            <h3>salary</h3>
            <input  type ="number" name="salary"  placeholder= "Enter salary" required data-value-missing="This field is required!">
            <br/>
            <br/>
            <h3>Start Date</h3>
            <input  type ="date" name="sdate" min="01-01-2000" max="<?php echo date("Y-m-d");?>"  placeholder= "Enter start date" required data-value-missing="This field is required!">
            <br/>
            <br/>
            <h3>End Date (leave it blank if the employee is still working in the firm )</h3>
            <input  type ="date" name="edate" max="<?php echo date("Y-m-d");?>"  placeholder= "Enter end date">
            <br/>
            <br/>
            <input  type ="submit" name="enter" value="submit" >
            <br/>
            <br/>
          </form> 

          <?php
            if(isset($_POST['enter']))
            {
            if(isset($_POST['name'], $_POST['age'],$_POST['address'],$_POST['phone'],$_POST['email'],$_POST['salary'], $_POST['sdate']))
            {
                if(array_key_exists('name',$_POST) && array_key_exists('age',$_POST) && array_key_exists('address',$_POST) && array_key_exists('phone',$_POST) && array_key_exists('email',$_POST) && array_key_exists('salary',$_POST) && array_key_exists('sdate',$_POST)  )
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
                    $empid = uniqid();
                    $ename =$_POST['name'];
                    $age = $_POST['age'];
                    $address = $_POST['address'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    $salary = $_POST['salary'];
                    $sdate = $_POST['sdate'];
                    If (empty($_POST['edate']))
                    {
                      $edate = "";
                    }
                    else {
                      $edate = $_POST['edate'];
                    }
                    

                    $check=0;
                    $sql ="INSERT INTO `employeedetails` (`empid`, `ename`, `age`, `address`, `phone`, `email`, `salary`, `startdate`, `enddate`) VALUES ('$empid', '$ename', '$age', '$address', '$phone', '$email', '$salary', '$sdate', '$edate');";

                    if($result = mysqli_query($connect,$sql))
                    {  
                      print("<script>window.alert('employe is added in the database');</script>");
                      $check=1;
                    }
                    if ($check==0)
                    {
                      print("<script>window.alert('employe is not added in the database');</script>");
                    }
                    mysqli_close($connect);  
                }
                else
                {
                    echo "Error:array key exists error";
                }
              }
              else
                {
                    echo "Error 1!";
                }
              }
            ?>
    </div>
          
    </div>

    </section>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    
    
    <script src="js/aos.js"></script>
    
    <script src="js/bootstrap-datepicker.js"></script> 
    <script src="js/jquery.timepicker.min.js"></script> 
    <script src="js/main.js"></script>
    <script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
  </body>
</html>

<?php
}else header('Location: login.php');
?>
