<?php

    session_start();

    $con = mysqli_connect("localhost","root","","website");

    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $sql = "SELECT * from admin Where email='".$email."' AND password='".$pass."' ";

        $data =mysqli_query($con,$sql);

        $row =mysqli_fetch_array($data);

        if($row){
            $_SESSION['aemail']=$email;
            header("location:index.php");
        }
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

        input[type="text"],
        input[type="password"] {
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
<body ng-app="">

    <div class="b">
        <div class="form-container">
            <h2>Log in</h2>
            <form onsubmit="return data()" action="" method="POST" name="myForm">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" ng-model="email" class="ang" required> 
                <span ng-show="myForm.email.$touched && myForm.email.$invalid" style="color:red;margin-bottom: 10px;">
                Enter a valid email.
            </span>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" ng-model="password" class="ang" required>  
                <span ng-show="myForm.password.$touched && myForm.password.$invalid" style="color:red;margin-bottom: 10px;">
                The password is required.
            </span>                

                <button type="submit" name="login">Log In</button>
                <span id="msg1" style="color:red"> </span>

                <?php
                    if (isset($_POST['login'])){
                        if(!$row){
                            echo "<p style='color:red;'>Inavalid email or password</p>";
                        }
                    }
                ?>

                <p>Don't have an accont?<a href="signin.php" class="al">Sign In</a></p>

            </form>
        </div>
    </div>

    <script>
        function data(){
            var email=document.getElementById("email").value;
            var pass=document.getElementById("password").value;

            if(email==""||pass==""){
                document.getElementById("msg1").innerHTML = "**All fields are required!";
                return false;
            }
            else{
                true;
            }
        }
    </script>

</body>
</html>