<?php 
session_start();
    if(isset($_POST['name'],$_POST['password'] ))
    {
        if(array_key_exists('name',$_POST)  and array_key_exists('password',$_POST))
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

            $check = 0;
            $query =  "select * from adminlogininfo";
            mysqli_query($connect, $query);
            if($result = mysqli_query ($connect ,$query))
            {
                while($row = mysqli_fetch_array($result))
                {
                        $id = $row[0];          
                        $password = $row[3];
                        if($_POST['name'] == $id)
                        {
                          if ($_POST['password'] == $password)
                          {
                              $_SESSION['name'] = $_POST['name'];
                              $_SESSION['user']=$id;
                              $check=1;
                              header("Location: loggedin.php");
                              break;
                          }
                        }
                }
                if($check == 0)
                {
                    print("<script>window.alert('invalid username or password');</script>");
                }
                    
            }
        mysqli_close($connect);
            
        }
    }
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

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/fancybox.min.css">
    
    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
    <header class="site-header js-site-header">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="index.html">Sogo Hotel</a>
          </div>
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
            <h1 class="heading mb-3">Admin</h1>
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
      <div class="container">
        <div class="row">
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
            
            <form action="#" method="post" class="bg-white p-md-5 p-4 mb-5 border">
              <div class="row">
                <div class="col-md-12 form-group">
                  <label class="text-black font-weight-bold" for="name">ID</label>
                  <input type="Int" id="name" name="name" class="form-control " required data-value-missing="This field is required!" >
                </div> 
              </div>
              
              <div class="row">
                <div class="col-md-12 form-group">
                  <label class="text-black font-weight-bold" for="password">Password</label>
                  <input type="password" id="password" name="password" class="form-control "  required data-value-missing="This field is required!">
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="submit" value="Submit" id="submit"class="btn btn-primary text-white py-3 px-5 font-weight-bold">
                </div>
              </div>
              <a href="forgotpassword.php" >Forgot Password</a>
            </form>

          </div>
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
  </body>
</html>