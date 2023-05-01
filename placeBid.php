<?php
include("dbconfig.php");
error_reporting(E_ALL|E_STRICT);
// Retrieve the car ID from the POST data
$bid_amount = $_POST['bid_amount'];
$car_id = $_POST['car_id'];
$user_id = $_POST['user_id'];

$con = mysqli_connect($host,$username, $password, $dbname)
        or die("Cannot connect to DB");

$sql = "SELECT MAX(bid_amount) AS highest_bid FROM Bids WHERE car_id = '$car_id'";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$highest_bid = $row['highest_bid'];


if ($bid_amount <= $highest_bid){
    header('Location: index.html?alert=failed');
}
else{
    $sql = "INSERT INTO Bids (user_id, car_id, bid_amount) VALUES ('$user_id', '$car_id', '$bid_amount')";
    $result = mysqli_query($con, $sql);
    header('Location: index.html?alert=success');
}


mysqli_free_result($result);
mysqli_close($con);
?>