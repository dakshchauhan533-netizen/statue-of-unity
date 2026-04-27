<?php
    $con = mysqli_connect("localhost","root","","website");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $m1 = "";

    if (isset($_POST['register'])){
        $name = $_POST['uname'];
        $email = $_POST['email'];
        $phone = $_POST['uphone'];
        $age = $_POST['age'];
        $pass = $_POST['password'];
    
        // Fetching existing records with the same email or phone
        $check_sql = "SELECT `email`, `phone` FROM `user` WHERE `email`='$email' OR `phone`='$phone'";
        $find_data = mysqli_query($con, $check_sql);
    
        if ($find_data) {
            $result = mysqli_fetch_assoc($find_data);
    
            if ($result) {
                if ($email == $result['email'] || $phone == $result['phone']) {
                    $m1 = "Email or Phone already exists";
                    echo "<script>alert('$m1')</script>";
                }
            } else {
                $sql = "INSERT INTO `user`(`name`, `email`, `phone`, `age`, `password`) VALUES ('$name','$email','$phone','$age','$pass')";
                $data = mysqli_query($con, $sql);
    
                if ($data) {
                    echo "<script>alert('$name, You have registered successfully')</script>";
                } else {
                    echo "<script>alert('Registration failed, please try again.')</script>";
                }
            }
        } else {
            echo "<script>alert('Database query failed.')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Site</title>
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
            margin-top: 5%;
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

        input[type="text"],
        input[type="number"],
        input[type="tel"],
        input[type="password"],
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
            width: 30%;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        button[type="submit"]:disabled{
            background-color: #c5c2c2;
        }

        button[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 20%;
        }

        button[type="reset"]:hover {
            background-color: #45a049;
        }

        .ar:link,
        .ar:visited,
        .ar:active {
            text-decoration: none;
        }

        .ar:hover{
            color: #4487c9;
        }

        p{
            text-align: center;
            margin-top: 2%;
        }
    </style>
</head>
<body ng-app="">

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
            <h2>Registration Form</h2>
            <form onsubmit="return data()" action="" method="POST" name="myForm" >
                <label for="uname">Name:</label>
                <input type="text" id="uname" name="uname" ng-model="uname" class="ang" required>
                <span ng-show="myForm.uname.$touched && myForm.uname.$invalid" style="color:red;margin-bottom: 10px;">
                The name is required.
            </span>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" ng-model="email" class="ang" required>
                <span ng-show="myForm.email.$touched && myForm.email.$invalid" style="color:red;margin-bottom: 10px;">
                Enter a valid email.
            </span>

                <label for="uphone">Phone:</label>
                <input type="tel" id="uphone" name="uphone" ng-model="uphone" class="ang" maxlength="10" minlength="10" required>
                <span id="msg2" style="color:red"> </span>
                <span ng-show="myForm.uphone.$touched && myForm.uphone.$invalid" style="color:red;margin-bottom: 10px;">
                The phone no is required.
            </span>

                <label for="age">Age:</label>
                <input type="number" name="age" id="age" ng-model="age" class="ang" required>
                <span id="msg4" style="color:red"> </span>
                <span ng-show="myForm.age.$touched && myForm.age.$invalid" style="color:red;margin-bottom: 10px;">
                The age is required.
            </span>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" ng-model="password" class="ang" required>
                <span id="msg3" style="color:red"> </span> 
                <span ng-show="myForm.password.$touched && myForm.password.$invalid" style="color:red;margin-bottom: 10px;">
                The password is required.
            </span>               

                <div style="margin-bottom: 10px;">
                    <input type="checkbox" id="agr" name="agr" value="agr" onclick="button()">
                    <label for="agree"> I agree to the <a href="#" class="ar">Terms and Conditions</a></label>
                </div>
                <p style="color: red;text-align: left;margin-top: 2px"><?php echo $m1;?></p>

                <div>
                    <button type="submit" id="sub" name="register" disabled>Submit</button>
                    <button type="reset">Reset</button>
                </div>
                
                <span id="msg1" style="color:red;"> </span>

                <p>Already have an accont?<a href="login.php" class="ar">Log In</a></p>

            </form>
        </div>
    </div>

    <footer style="background:black;margin-top:5%;">
        <p style="color:white;">Copyright © 2024 All Rights Reserved</p>
    </footer>

    <script>
        function button() {
            var checkBox = document.getElementById("agr");
            var submitButton = document.getElementById("sub");
            if (checkBox.checked == true) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        function data(){
            var name=document.getElementById("uname").value;
            var email=document.getElementById("email").value;
            var phone=document.getElementById("uphone").value;
            var age=document.getElementById("age").value;
            var pass=document.getElementById("password").value;

            if(name==""||email==""||phone==""||age==""||pass==""){
                document.getElementById("msg1").innerHTML = "**All fields are required!";
                return false;
            }
            else if (phone.length > 10 || phone.length < 10) {
                document.getElementById("msg2").innerHTML = "**Number must be of 10 digits!";
                return false;
            }
            else if (age.length > 2) {
                document.getElementById("msg4").innerHTML = "**Age must be less than 100!";
                return false;
            }
            else if (isNaN(phone)) {
                document.getElementById("msg2").innerHTML = "**Alphabets are not allowed!";
                return false;
            }
            else if (pass.length < 8) {
                document.getElementById("msg3").innerHTML = "**Password length must be atleast 8 characters";
                return false;
            }
            else if (pass.length > 15) {
                document.getElementById("msg3").innerHTML = "**Password length must not exceed 15 characters";
                return false;
            }
            else{
                true;
            }
        }
    </script>

</body>
</html>