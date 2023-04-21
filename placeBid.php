<?php
include("dbconfig.php");
error_reporting(E_ALL|E_STRICT);
// Retrieve the car ID from the POST data
$bid_amount = $_POST['bid_amount'];
$car_id = $_POST['car_id'];
$user_id = $_POST['user_id'];

$con = mysqli_connect($host,$username, $password, $dbname)
        or die("Cannot connect to DB");

$sql = "SELECT MAX(amount) AS highest_bid FROM BidNDriveDB.Bids WHERE car_id = $car_id";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$highest_bid = $row['highest_bid'];


if ($bid_amount <= $highest_bid){
    echo "<script>alert('Your bid is too low, please place a bid that is greater than the current highest bid.');</script>";
}
else{
    $sql = "INSERT INTO Bid (user_id, car_id, amount) VALUES ('$user_id', '$car_id', '$bid_amount')";
}


mysqli_free_result($result);
mysqli_close($con);
?>