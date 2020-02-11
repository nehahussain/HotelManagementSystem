<?php 
if(isset($_POST['submit']))
{
    if(isset($_POST['email']))
    {
        if(array_key_exists('email',$_POST))
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
            $email = $_POST['email'];
            $query =  "INSERT INTO signupcustomers (`email`) VALUES ('$email');";
            if ($connect->query($query) == TRUE)
            {
                echo "customer successfully signed up";
            }
            else
            {
                echo "Error:customer not signed up";
            }

        mysqli_close($connect);
        }
    }
}
header( "refresh:3;url=index.html" );
?>
