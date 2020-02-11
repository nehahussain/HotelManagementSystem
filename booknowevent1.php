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
    $enddate = date('Y-m-d',strtotime($_POST['enddate']));
    $_SESSION["startdate"] = $startdate;
    $_SESSION["enddate"] = $enddate;
    echo "<h1>Check In <strong>".$startdate."
    </strong>Check Out <strong>".$enddate."</strong></h1>";
?>
    
<?php    

    if(isset($_POST['submit']))
    {
        if($_POST['submit'])
        {
            if(array_key_exists('startdate',$_POST)  and array_key_exists('enddate',$_POST))
            {
                if (!empty($_POST['startdate']) )
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
                        
                        $sql =  "select count(*), t.type from `eventroomtype` t , `eventrooms` r
                        where r.typeid = t.typeid 
                        AND  r.roomno not IN
                        (
                            select roomno from eventroomstatus b
                            where b.roomno = r.roomno
                            And
                            (
                                ('$startdate' BETWEEN b.checkin AND b.checkout) OR
                                ('$enddate' BETWEEN b.checkin AND b.checkout) OR 
                                ('$startdate' <= b.checkin AND '$enddate' >= b.checkout)
                            )
                        )
                        Group by r.typeid;";

                        if($result = mysqli_query($connect,$sql))
                        {
                            echo "
                                <table class ='table' style='width:100%''>
                                <tr><h1><strong>No. of Available Event Rooms</strong></h1></tr>
                                <tr>
                                <th><h3><strong>Room No</strong></h3></th>
                                <th><h3><strong>Room Types</strong></h3></th>
                                </tr>";
                            // $x=0;
                            // $values;
                        while($row = mysqli_fetch_array($result))
                        {
                            echo 
                                "<tr>
                                <td><h4><strong>".$row[0]."</strong></h4></td> 
                                <td><h4><strong>".$row[1]."</strong></h4></td>
                                </tr>";

                                // $values[$x]=$row[0];
                                // $x++;
                                // $values[$x]=$row[1];
                                // $x++;
                        }
                        echo "</table>";
                        
                        }
                        else
                        {
                            echo "error found in sql ";
                        }
                        mysqli_close($connect);
                        
                        echo "
                        <h1><strong>Select Event Room</strong><h1>
                        <form  action = 'booknowevent2.php' method ='post'>
                        <select name='roomtype'>
                                <option value='Ballroom'>Ballroom</option>
                                <option value='Conference Room'>Conference Room</option>
                        </select>
                        <input type='Number' id='rooms' name='rooms' min=0 max=1>
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
