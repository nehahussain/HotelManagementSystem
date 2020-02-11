<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";
// $dbname ="admin";
$conn = new mysqli ($servername , $username, $password, $dbname);

if($conn->connect_error)
{
    die ("Connection failed: " . $conn->connect_error);
}

// $sql ="CREATE table ROOM_TYPE(
// type_id INT(5) Not Null,
// type Varchar(15) Not Null,
// Adults INT (1) Not Null,
// children INT (1) Not Null,
// Price INT (5) Not Null);";

// $sql = "Alter table ROOM_TYPE add primary key(type_id);";

// $sql ="CREATE table Eventrooms(
//     roomno INT(5) Not Null,
//     typeid INT(5) Not Null);";

// $sql = "Alter table Eventrooms add primary key(roomno);";

// $sql = "Alter table  Eventrooms ADD  FOREIGN KEY (typeid) REFERENCES eventroomtype(typeid);";

// $sql = "CREATE table eventroomstatus(
//         roomno INT(5) Not Null,
//         checkin Date Not NULL,
//         checkout Date Not Null,
//         bookid varchar(30)Not NULL);";

// $sql = "Alter table eventroomstatus add primary key(roomno,checkin);";

// $sql = "Alter table roomavailability add roomno INT(5) Not Null";
// $sql = "Alter table  roomavailability ADD  FOREIGN KEY(roomno) REFERENCES ROOMDETAILS(roomno);";

// $sql ="CREATE table eventroombooking(
// bookid Varchar(30) Not Null,
// guestid Varchar(30) Not Null,
// roomno INT(5) Not Null,
// checkin Date Not NULL,
// checkout Date Not Null,
// totaldays INT(2) Not Null,
// totalPrice INT (9) Not Null);";

// $sql = "create table guestdetails(
//     gid Varchar(30) Not Null,
//     name Varchar(30) Not Null,
//     email Varchar(30) Not Null,
//     phoneno INT(13) Not Null)";

// $sql = "alter table eventroombooking Add primary key (bookid)";
// $sql = "alter table guestdetails Add primary key (gid)";
// $sql = "Alter table  eventroombooking ADD  FOREIGN KEY (guestid) REFERENCES guestdetails(gid);";

// $sql = "create table Bills (
//     bid Varchar(30) Not Null,
//     bookid Varchar(30),
//     facilities varchar (50),
//     price varchar(50),
//     totalprice int (20) Not Null)";

 $sql = "alter table Bills Add primary key (bid)";

// $sql = "create table contact (
//     cid INT(5) Not Null ,
//     name varchar(15) Not Null,
//     phone varchar (11) Not Null ,
//     email varchar(20),
//     message varchar(200) 
// )";

// $sql = "alter table contact Add primary key (cid)";

// $sql = "create table adminlogininfo(
//     id INt(5) Not Null,
//     password varchar(15) Not Null
// )";

// $sql = "alter table adminlogininfo add primary key (id)";
// $sql = "Alter table roomstatus add bookid varchar(30);";
// $sql = "Alter table  roomstatus ADD  FOREIGN KEY (bookid) REFERENCES roombooking(bookid);";

if ($conn->query($sql) == TRUE)
{
    echo "done";
}
else
{
    echo "ff ". $conn->error;
}

$conn->close();
?>