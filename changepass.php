<?php
    session_start();
    if(!isset($_SESSION['uemail'])){
        header("location:login.php");
    }
    $con = mysqli_connect("localhost","root","","website");

    $p_id = $_GET['id'];

    $sql = "SELECT * FROM `user` WHERE id='$p_id'";

    $result = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['update'])){
        $pass = $_POST['npass'];

        $update = "UPDATE `user` SET `password`='$pass' WHERE id='$p_id'";

        $data =mysqli_query($con,$update);

        if ($data) {
            echo "<script>
                    alert('Your password has changed successfully');
                    window.location.href = 'index.php';
                  </script>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user site</title>
    <link rel="stylesheet" href="admin/admin-style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        th{
            text-align: center;
        }

        input[type='text'],
        input[type='time'],
        input[type='tel'],
        input[type='email'],
        input[type='password'],
        input[type='number']{
            width: 40%;
            padding: 8px;
            resize: vertical;
            box-sizing: border-box;
            border-radius: 4px;
        }

        /* Icon styling */
        .icon {
            margin-right: 8px;
            width: 20px;
        }

        .wrapper .sidebar ul li{
            padding: 18px;
        }

        /* Logout Button */
        .admin_header a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: #e74c3c;
            color: white;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .admin_header a:hover {
            background: #c0392b;
            text-decoration: none;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <h2><i class="fas fa-user icon"></i>SOU User</h2>
            <ul>
                <li>
                    <a href="update.php?id=<?php echo $row['id'] ?>">
                        <i class="fas fa-user-edit icon"></i>Update Profile
                    </a>
                </li>
                <li>
                    <a href="userpage.php">
                        <i class="fas fa-ticket-alt icon"></i>My Tickets
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <i class="fas fa-home icon"></i>Homepage
                    </a>
                </li>
                <li>
                    <a href="changepass.php?id=<?php echo $row['id'] ?>">
                    <i class="fas fa-lock icon"></i>Change Password
                    </a>
                </li>
            </ul>
        </div>
        <div class="header">
            <div class="admin_header">
                <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i>Logout
                </a>
            </div>

            <div class="info">
            <h1><i class="fas fa-lock icon"></i> Change Password</h1>
                <div class="my_form">
                <form action="" method="POST" id="passwordForm">
                    <div class="div_deg">
                        <label><i class="fas fa-lock"></i> Old Password:</label>
                        <input type="password" id="currentPassword" placeholder="Current Password" value="<?php echo $row['password'] ?>" readonly required>
                    </div>

                    <div class="div_deg">
                        <label><i class="fas fa-key"></i> New Password:</label>
                        <input type="password" id="newPassword" placeholder="New Password" required>
                    </div>

                    <div class="div_deg">
                        <label><i class="fas fa-check-circle"></i> Confirm Password:</label>
                        <input type="password" id="confirmPassword" placeholder="Confirm New Password" name="npass" required>
                    </div>

                    <div class="div_deg">
                        <div id="errorMessage" style="color: red; margin-bottom: 10px; display: none;"></div>
                        <input type="submit"  value="Change Password" name="update" class="btn btn-info">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const errorMessage = document.getElementById('errorMessage');

            // Regular Expression for password validation
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,8}$/;

            // Clear previous error
            errorMessage.style.display = 'none';

            // Check if passwords match
            if (newPassword !== confirmPassword) {
                errorMessage.textContent = 'New password and confirm password do not match!';
                errorMessage.style.display = 'block';
                e.preventDefault();
            }

            // Validate password complexity and length
            else if (!passwordPattern.test(newPassword)) {
                errorMessage.textContent = 'Password must be 6-8 characters long and include at least one letter, one number, and one special character.';
                errorMessage.style.display = 'block';
                e.preventDefault();
            }
        });

        // Real-time validation for confirm password field
        document.getElementById('confirmPassword').addEventListener('input', function() {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = this.value;
            const errorMessage = document.getElementById('errorMessage');

            if (newPassword !== confirmPassword) {
                errorMessage.textContent = 'Passwords do not match!';
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        });
    </script>
</body>
</html>