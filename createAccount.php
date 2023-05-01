<?php
include("dbconfig.php");
error_reporting(E_ALL|E_STRICT);

$name=$_POST["name"];
$email=$_POST["email"];
$number=$_POST["number"];
$login=$_POST["username"];
$bpassword=$_POST["password"];

$con = mysqli_connect($host,$username, $password, $dbname)
        or die("Cannot connect to DB");
       

if ($login =="" || $bpassword == "" || $email == ""|| $number == "") {
        die(" Fields Are Empty\n");
}
else{
        $sql= "SELECT * FROM Users WHERE username='$login'";  
}

$result = mysqli_query($con, $sql);
if (mysqli_fetch_array($result) == True){
    echo "taken";
}
else{
    $sql = "INSERT INTO Users (name_, username, password_, email, phone_number) VALUES ('$name','$login', '$bpassword', '$email', '$number')";
    if (mysqli_query($con, $sql)){          
        echo "success";
        $sql= "SELECT * FROM BidNDriveDB.Users WHERE username='$login'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        setcookie("login_cookie",$row["user_id"], time()+ 3600);
    }  else{
        echo "failed";
    }

}
mysqli_close($con);

?>