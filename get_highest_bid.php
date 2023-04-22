<?php
include("dbconfig.php");
error_reporting(E_ALL|E_STRICT);

$car_id = $_GET("car_id");

$con = mysqli_connect($host,$username, $password, $dbname)
        or die("Cannot connect to DB");


$sql = "SELECT MAX(amount) AS highest_bid, user_id FROM BidNDriveDB.Bids WHERE car_id = $car_id";
$result = mysqli_query($con, $sql);


mysqli_close($con);
?>