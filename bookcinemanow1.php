<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
  font-size: 20px
}
tr{
  background-color: #eee;
}
th {
  background-color: black;
  color: white;
}
td{
    font-size: 25px
}
</style>
</head>
<body>

<?php
    session_start();
    $startdate = date('Y-m-d',strtotime($_POST['startdate']));
    $_SESSION["startdate"] = $startdate;
?>
    
<?php    

    if(isset($_POST['submit']))
    {
        if($_POST['submit'])
        {
            if(array_key_exists('startdate',$_POST))
            {
                if (!empty($_POST['startdate']) )
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
                    $sql="Select * from showtime where date= '$startdate';";
                    if($result = mysqli_query($connect,$sql))
                    {
                
                        while($row = mysqli_fetch_array($result))
                        {
                            echo 
                                '<br/><h3><strong>Movie  :'.$row[0].'
                                <strong></h3><br/><h3><strong>Time   :'.$row[1].'
                                <strong></h3><br/><h3><strong>Date  :'.$row[2].'
                                <strong></h3><br/>';
                        }
                    }
                    else
                    {
                        echo "error found in sql ";
                    }


                    $sql =   "select count(*), t.type from `cinematype` t , `cinemaseats` r
                    where r.typeid = t.typeid 
                    AND  r.seatno not IN
                    (
                        select seatno from cinemastatus b
                        where b.seatno = r.seatno
                        And
                        (
                            ('$startdate' = b.date )
                        )
                    )
                    Group by r.typeid;";

                    if($result = mysqli_query($connect,$sql))
                    {
                        echo "
                            <table class ='table'>
                            <tr><h1><strong>No. of Available Seat(s)</strong></h1></tr>
                            <tr>
                            <th>Seat No </th>
                            <th>Type ID</th>
                            </tr>";
                
                    while($row = mysqli_fetch_array($result))
                    {
                        echo 
                            '<tr>
                            <td>'.$row[0].'</td>
                            <td>'.$row[1].'</td>
                            </tr>';
                    }
                    echo "</table>";
                    }
                    else
                    {
                        echo "error found in sql ";
                    }
                    mysqli_close($connect);
                    
                    echo "
                    <h1><strong>Select seats</strong><h1>
                    <form  action = 'bookcinemanow2.php' method ='post'>
                    <select name='cinematype'>
                            <option value='silver'>Silver</option>
                            <option value='gold'>Gold</option>
                            <option value='platinum'>Platinum</option>
                    </select>
                    <input type='Number' id='seats' name='seats' min=0 max=1>
                    <input type='email' id='email' name='email'>
                    <input  type ='submit' name='submit' value='Book Now'>
                    </form>";   
                }
                else
                {
                    echo "Error in date!";
                }

            }
            else
                {
                    echo "Error in date!";
                }

        } 
        else
            {
                echo "Error exist!";
            } 
    }
    else
        {
            echo "Error exist!";
        }
?> 
          
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
                
</body>
</html>
