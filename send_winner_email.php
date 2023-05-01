<?php
include("dbconfig.php");
error_reporting(E_ALL|E_STRICT);
// Retrieve the car ID from the POST data
$car_id = $_POST["car_id"];

$con = mysqli_connect($host,$username, $password, $dbname)
        or die("Cannot connect to DB");


// Retrieve the highest bid and the user who placed that bid
$sql = "SELECT MAX(amount) AS highest_bid, user_id FROM BidNDriveDB.Bids WHERE car_id = $car_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$highest_bid = $row["highest_bid"];
$winning_user_id = $row["user_id"];

// Retrieve the name and email address of the winning user
$sql = "SELECT name_, email FROM BidNDriveDB.Users WHERE user_id = $winning_user_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$winning_user_name = $row["name_"];
$winning_user_email = $row["email"];

// Send an email notification to the winning user
$to = $winning_user_email;
$subject = "Congratulations! You've won the auction for car #$car_id";
$message = "Dear $winning_user_name,\n\nCongratulations! You've won the auction for car #$car_id with a bid of $highest_bid. Please contact us to arrange payment and pickup/delivery of the car.\n\nBest regards,\nThe Car Auction Team";
$headers = "From: auctions@bidndrive.com\r\n";
$headers = "Reply-To: auctions@bidndrive.com\r\n";
$headers = "Content-Type: text/plain; charset=UTF-8\r\n";

mail($to, $subject, $message, $headers); //Sends Email

mysqli_close($con);

?>