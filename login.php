<?php
include("dbconfig.php");
error_reporting(E_ALL|E_STRICT);

$login=$_POST["username"];
$bpassword=$_POST["password"];


$con = mysqli_connect($host,$username, $password, $dbname)
        or die("Cannot connect to DB");
       

if ($login =="" || $bpassword == "" ) {
        die(" Login Fields Are Empty\n");
}
else{
        $sql= "SELECT * FROM BidNDriveDB.Users WHERE login='$login'";
  
        
}


$result = mysqli_query($con, $sql);
$num = mysqli_num_rows($result);

$row = mysqli_fetch_array($result);

if ($row == 0){  
        echo "<br>Login failed either your username or password is invaild\n";
        
}       
else if ($row["login"] == $login && $row["password_"] == $bpassword){
        session_start();
        $_SESSION['username'] = $username;

        echo"Successfully Logged in"

}

mysqli_free_result($result);
mysqli_close($con);

?>