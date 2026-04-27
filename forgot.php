<?php
    session_start();
    $con = mysqli_connect("localhost","root","","website");
    if ($con) {
        echo "Connected to database";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Site</title>
    <link rel="stylesheet" href="style.css">
    <script src="angular.min.js"></script>
    <style>
        .b {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            margin-top: 3%;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .al:link,
        .al:visited,
        .al:active {
            text-decoration: none;
        }

        .al:hover{
            color: #4487c9;
        }

        p{
            text-align: center;
            margin-top: 2%;
        }
    </style>
</head>
<body>
<header>
        <nav class="navbar">
          <h2 class="logo"><a href="index.html"><img src="images/sou2.png" alt="SOU"></a></h2>
          <input type="checkbox" id="menu-toggler">
          <label for="menu-toggler" id="hamburger-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
              <path d="M0 0h24v24H0z" fill="none"/>
              <path d="M3 18h18v-2H3v2zm0-5h18V11H3v2zm0-7v2h18V6H3z"/>
            </svg>
          </label>
          <ul class="all-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="place.php">Places & Shows</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="signin.php">Sign in/Log in</a></li>
          </ul>
        </nav>
    </header>

<div class="b">
        <div class="form-container">
            <h2>Forgot Password</h2>
            <form method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="ang" placeholder="Enter registered email" required>                

                <button type="submit" name="send">Send OTP</button>

                <?php
                    if (isset($_POST['send'])) {
                        $email = $_POST['email'];
                        $random = rand(000000,999999);
                        $sql = "SELECT email FROM `user` WHERE email = '$email'";
                        $data =mysqli_query($con,$sql);
                        $row = mysqli_fetch_array($data);
                        if ($email == $row[0]) {
                            $to = $email;
                            $subject = "OTP for password recovery";
                            $message = "Dear User,\n\nWe received a request to reset your password. Your One-Time Password (OTP) is: $random.\n\nPlease use this OTP within the next 15 minutes to proceed with your request. If you did not initiate this request, please contact our support team immediately.\n\nBest regards,\nSupport Team";
                            $headers = "From: princepatel300970@gmail.com\r\n";
                            if (mail($to,$subject,$message,$headers)) {
                                $_SESSION['otp'] = $random;
                                $_SESSION['femail'] = $email;
                                header('location:otp.php');
                            }
                            else {
                                echo "OTP not sent";
                            }
                        }
                        else {
                            echo "Email does not exist";
                        }
                    }
                ?>

            </form>
        </div>
    </div>

    <footer style="background:black;margin-top:5%;">
        <p style="color:white;">Copyright © 2024 All Rights Reserved</p>
    </footer>
</body>
</html>