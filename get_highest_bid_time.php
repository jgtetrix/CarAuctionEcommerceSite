<?php
include("dbconfig.php");
error_reporting(E_ALL|E_STRICT);

$car_id = $_POST["car_id"];

$con = mysqli_connect($host,$username, $password, $dbname)
        or die("Cannot connect to DB");


$sql = "SELECT MAX(bid_amount) AS highest_bid, user_id FROM Bids WHERE car_id = '$car_id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$highest_bid = $row["highest_bid"];
echo"$highest_bid";


mysqli_close($con);
?>