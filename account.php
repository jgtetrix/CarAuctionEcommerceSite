<?php
include 'dbconfig.php';

$con = mysqli_connect($host,$username, $password,$dbname)
        or die('Cannot connect to DB');

if(!isset($_COOKIE['login_cookie'])) {
            echo "Please Login First!";
            echo "<br><a href= 'index.html'>Login Page</a>";
            die();
    
}else{
    $cookie = $_COOKIE['login_cookie'];
    echo "
    <html lang='en'>

    <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Account</title>
            <script src='https://kit.fontawesome.com/dac92d3981.js' crossorigin='anonymous'></script>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
            <link rel='stylesheet' href='style.css'>

    </head>

    <body>
        <section id='header'>
            
            <a href='index.html'><img src='img/BidNDrive.png' class='logo' alt='BidNDrive Logo' height='150'></a>
            <div>
                <ul id='navbar'>
                    <li><a href='index.html'>Auctions</a></li>
                    <li><a href='about.html'>About</a></li>
                    <li><a href='contact.html'>Contact</a></li>
                    <li><a href='login.html'>Login</a></li>
                    <li><a class='active' href='account.php'><img src='img/accounticon.png' class='logo' alt='Account Logo' height='30'></a></li>
                </ul>
            </div>
        </section> 
        ";
        
        $sql = 'SELECT * FROM Users WHERE user_id = $cookie';
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $username = $row['username'];

        echo "
        <section>
            <h2 id='about-middle-header'>Welcome, $username</h2>
            <div id='log_out'>
                <a href='index.html' onclick ='unset($_COOKIE[login_cookie])' ><img src='img/accounticon.png' class='logo' alt='Account Logo' height='20' >Log Out</a>
            </div>
        </section>
        ";

        $sql = 'SELECT b.bid_id, b.bid_amount, c.car_year, c.make, c.model 
                FROM Bids AS b 
                INNER JOIN Cars AS c ON b.car_id = c.car_id 
                WHERE b.user_id = $cookie';
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $bid = $row['bid_id'];
        $make = $row['make'];
        $model = $row['model'];
        $year = $row['car_year'];
        $amount = $row['bid_amount'];

    if (mysqli_num_rows($result) > 0){

        echo"
        <section id='bid-details'>
            
            <div>
            
                <table id='bid-table' class='table-responsive-md'>
                    <h2 id='bid-history-header'>Bid History</h2>
                    <thead>
                        <tr>
                        <th>Bid </th>
                        <th>Car Title</th>
                        <th>Bid Amount</th>
                        </tr>
        ";
        while($row = mysqli_fetch_array($result)){
            echo "
                        <tbody>
                            <tr>
                            <td>$bid</td>
                            <td>$year $make $model</td>
                            <td>$amount</td>
                            </tr>
                            
                        </tbody>
                ";
        }
        echo "
                    </thead>
                </table>

            </div>
            ";
    }else{
        echo "<p>No Bids Placed</p>" ;
    }
            $sql ='SELECT * FROM Users WHERE user_id = $cookie';
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $name = $row['name'];
            $username = $row['username'];
            $email = $row['email'];
            $number =$row['phone_number'];

            echo"
            <div id='account-details '> 
                <h2 id='account-details-header'>Account details</h2>
                <div>
                    <p class='account-details'><strong>Name:</strong> $name</p>
                    <p class='account-details'><strong>Username:</strong> $username</p>
                    <p class='account-details'><strong>Email:</strong> $email</p>
                    <p class='account-details'><strong>Phone Number:</strong> $number</p> 
                </div>
            </div>

        </section>

        



        <footer class='section-p1'>
            <div class='details'>
                <img src='img/BidNDrive.png' height='300'>
                <h4>Contact:</h4>
                <p><Strong>Address:</Strong> 1000 Morris Ave, Union, New Jersey, 07083</p>
                <p><Strong>Phone:</Strong> +1 888 888 8888</p>
                <p><Strong>Hours:</Strong> 08:00 - 16:00 EST Monday - Friday</p>
            </div>
            <div id='copyright'>
                <p>BidNDrive.com © 2022 BidNDrive </p>
            </div>
        </footer>
    </body>
    </html>
    
    
    
    ";







}
mysqli_free_result($result);
mysqli_close($con);
    



?>