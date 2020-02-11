<?php
$weather="";
$error="";
if (isset($_GET['city']))
{
  if($_GET['city'])
  {
    $cityname= str_replace(' ', '', $_GET['city']);

    $file = 'http://www.domain.com/somefile.jpg';
    $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$cityname."/forecasts/latest");
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
    {
        $error = "That city could not be found.";
    }
    else 
    {
        $forecastPage=file_get_contents("https://www.weather-forecast.com/locations/".$cityname."/forecasts/latest");

        $pageArray= explode('<table class="b-forecast__table js-forecast-table"><thead><tr class="b-forecast__table-description b-forecast__hide-for-small days-summaries"><th></th><td class="b-forecast__table-description-cell--js" colspan="9"><span class="b-forecast__table-description-title">',$forecastPage) ;
        
        $secondPageArray = explode ('</span></p></td></tr><tr class="b-forecast__table-days js-forecast-header js-daynames"><th class="b-forecast__table-units"><div class="b-forecast__table-units-container"><button class="b-forecast__table-units-button b-forecast__table-float b-forecast__table-units-button--active" data-units="Metric">',$pageArray[1]);
    
        $weather= $secondPageArray[0];
    }

    //echo $secondPageArray[0];
  }
}

  

?>


<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sogo Hotel by Colorlib.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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

<style type="text/css">

body{
  background : none;
  
}
.form-group{
  text-align:center;
  margin-top:200px;
  width:auto;
}
#weather {
  margin-top: 15px;
}

</style>




  </head>
  <body>
    
  <header class="site-header js-site-header">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="index.html">Sogo Hotel</a></div>
          <div class="col-6 col-lg-8">


            <div class="site-menu-toggle js-site-menu-toggle"  data-aos="fade">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <!-- END menu-toggle -->

            <div class="site-navbar js-site-navbar">
              <nav role="navigation">
                <div class="container">
                  <div class="row full-height align-items-center">
                    <div class="col-md-6 mx-auto">
                      <ul class="list-unstyled menu">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="rooms.html">Rooms</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="events.html">Events</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="reservation.php">Room Reservation</a></li>
                        <li><a href="eventbooking.php">Event Reservation</a></li>
                        <li><a href="restaurant.html">Restaurant</a></li>
                        <li><a href="cinema.php">Cinema</a></li>
                        <li  class="active"><a href="weather.php">Weather</a></li>
                        <li><a href="location.php">Location</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- END head -->

    <section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">weather</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="index.html">Home</a></li>
              <li>&bullet;</li>
              <li>weather</li>
            </ul>
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

    <section class="section blog-post-entry bg-light" id="next">
      <div class="container">
        <div class="row" data-aos="fade">
          <div class="col-12">
            <div class="custom-pagination">
            <div class="col-md-6 form-group">

            <form method="GET">

            <fieldset class="form-group">
            <label class="text-black font-weight-bold" for="city">Enter the name of a city.</label>
            <input type="text" id="city" name="city" class="form-control " required data-value-missing="This field is required!" placeholder="Eg. London , Tokyo"  value="<?php 
            if(array_key_exists('city',$_GET))
            {
              echo $_GET['city'];
            }
             ?> ">
            </fieldset>
            <button type="submit" class="btn btn-primary">Submit</button>
            
            </form>
              <div id="weather">
                <?php
                
                  if($weather)
                  {
                    echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                  }
                  else if($error)
                  {
                    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                  }
            
              ?>                 
              </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    
    <section class="section bg-image overlay" style="background-image: url('images/hero_4.jpg');">
        <div class="container" >
          <div class="row align-items-center">
            <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left" data-aos="fade-up">
              <h2 class="text-white font-weight-bold">A Best Place To Stay. Reserve Now!</h2>
            </div>
            <div class="col-12 col-md-6 text-center text-md-right" data-aos="fade-up" data-aos-delay="200">
              <a href="reservation.php" class="btn btn-outline-white-primary py-3 text-white px-5">Reserve Now</a>
            </div>
          </div>
        </div>
      </section>

    <footer class="section footer-section">
      <div class="container">
        <div class="row mb-4">
          <div class="col-md-3 mb-5">
            <ul class="list-unstyled link">
              <li><a href="about.html">About Us</a></li>
              <li><a href="about.html">Terms &amp; Conditions</a></li>
              <li><a href="about.html">Privacy Policy</a></li>
             <li><a href="rooms.html">Rooms</a></li>
            </ul>
          </div>
          <div class="col-md-3 mb-5">
            <ul class="list-unstyled link">
              <li><a href="rooms.html">The Rooms &amp; Suites</a></li>
              <li><a href="about.html">About Us</a></li>
              <li><a href="contact.php">Contact Us</a></li>
              <li><a href="restaurant.html">Restaurant</a></li>
            </ul>
          </div>
          <div class="col-md-3 mb-5 pr-md-5 contact-info">
            <!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
            <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> 198 West 21th Street, <br> Suite 721 New York NY 10016</span></p>
            <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> (+1) 435 3533</span></p>
            <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span> info@domain.com</span></p>
          </div>
          <div class="col-md-3 mb-5">
            <p>Sign up for our newsletter</p>
            <form action="signup.php" method ="post" class="footer-newsletter">
              <div class="form-group">
                <input type="email" name ="email" class="form-control" placeholder="Email...">
                <input  type="submit" name ="submit"></input>
              </div>
            </form>
          </div>
        </div>
        <div class="row pt-5">
          <p class="col-md-6 text-left">
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | 
          </p>
            
          <p class="col-md-6 text-right social">
            <a href="#"><span class="fa fa-tripadvisor"></span></a>
            <a href="#"><span class="fa fa-facebook"></span></a>
            <a href="#"><span class="fa fa-twitter"></span></a>
            <a href="#"><span class="fa fa-linkedin"></span></a>
            <a href="#"><span class="fa fa-vimeo"></span></a>
          </p>
        </div>
      </div>
    </footer>
    
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>