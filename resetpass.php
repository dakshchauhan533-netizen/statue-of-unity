<?php
session_start();
if (!isset($_SESSION['femail'])) {
    header('location:login.php');
    exit();
}

$con = mysqli_connect("localhost", "root", "", "website");

$msg = "";

if (isset($_POST['submit'])) {
    $new_pass = $_POST['newPassword'];
    $con_pass = $_POST['confirmPassword'];
    if ($new_pass == $con_pass) {
        $femail = $_SESSION['femail']; // Use session variable for email
        $sql = "UPDATE user SET password = '$new_pass' WHERE email = '$femail'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            header('location:login.php');
            exit();
        } else {
            $msg = "Error to update";
        }
    } else {
        $msg = "Passwords do not match";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
<body>
    <div class="b">
        <div class="form-container">
            <h2>Reset Password</h2>
            <form name="myForm" id="resetPasswordForm" method="POST" onsubmit="return validatePassword()">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="newPassword" required>

                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirmPassword" required>

                <p id="msg" style="color: red"><?php echo $msg; ?></p>

                <button type="submit" name="submit">Reset Password</button>
            </form>
            <script>
                function validatePassword() {
                    const newPassword = document.getElementById('new-password').value;
                    const confirmPassword = document.getElementById('confirm-password').value;
                    const msg = document.getElementById('msg');

                    if (newPassword.length < 8 || newPassword.length > 15) {
                        msg.textContent = 'Password must be between 8 to 15 characters.';
                        return false;
                    }

                    if (newPassword !== confirmPassword) {
                        msg.textContent = 'Passwords do not match.';
                        return false;
                    }

                    msg.textContent = ''; // Clear any previous error messages
                    return true;
                }
            </script>
        </div>
    </div>
</body>
</html>