<?php
  session_start();
  if (!isset($_SESSION['femail'])) {
    header('location:login.php');
    exit();
  }

  $msg = "";
  
  $con = mysqli_connect("localhost","root","","website");

  $femail = $_SESSION['femail'];
 
  $otp = $_SESSION['otp'];
  if(isset($_POST['submit'])){
    $submited_otp = $_POST['otp'];
    if($submited_otp == $otp){
      header('location:resetpass.php');
    }
    else {
      $msg = "Please enter valid otp";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
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
        .otp-form {
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

        input[type="text"]{
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

        p{
            text-align: center;
            margin-top: 2%;
        }
    </style>
</head>
<body>
  <div class="b">
    <div class="otp-form">
        <h2>OTP Verification</h2>
        <form method="POST">
            <input type="text" name="otp" maxlength="6" required>
            
            <button type="submit" name="submit">Verify</button>
            <p style="color: red"><?php echo $msg; ?></p>
        </form>
    </div>
  </div>
</body>
</html>
