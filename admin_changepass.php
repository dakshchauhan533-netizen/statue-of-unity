<?php
    session_start();
    if(!isset($_SESSION['aemail'])){
        header("location:adminlogin.php");
    }

    $con = mysqli_connect("localhost","root","","website");
    $id = $_SESSION['aemail'];
    
    $sql = "SELECT * FROM `admin` WHERE email='$id'";

    $result = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['update'])){
        $pass = $_POST['npass'];

        $update = "UPDATE `admin` SET `password`='$pass' WHERE email='$id'";

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
    <title>Admin site</title>
    <link rel="stylesheet" href="admin-style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Improved Card Design */
        .my_card{
            background: linear-gradient(135deg, #2c3e50, #3498db);
            width: 300px;
            color: white;
            padding: 25px;
            margin: 15px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }

        .my_card:hover {
            transform: translateY(-5px);
        }

        .card{
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
            gap: 20px;
            flex-direction: row;
        }

        .my_card p{
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        hr{
            border: 1px solid rgba(255,255,255,0.3);
            margin: 15px 0;
        }

        .my_card h3{
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .my_card a{
            color: white;
            text-decoration: none;
            display: block;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            background: rgba(255,255,255,0.1);
            transition: background 0.3s ease;
        }

        .my_card a:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Sidebar Icons */
        .sidebar ul li a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover {
            background: rgba(255,255,255,0.1);
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                flex-direction: column;
                align-items: center;
            }
            
            .my_card {
                width: 100%;
                max-width: 400px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <h2><i class="fas fa-user-shield"></i> SOU Admin</h2>
            <ul>
                <li>
                    <a href="index.php">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <i class="fas fa-users"></i>Users
                    </a>
                </li>
                <li>
                    <a href="add_place.php">
                        <i class="fas fa-plus-circle"></i>Add Places
                    </a>
                </li>
                <li>
                    <a href="view_place.php">
                        <i class="fas fa-map-marked-alt"></i>View Places
                    </a>
                </li>
                <li>
                    <a href="ticket_booked.php">
                        <i class="fas fa-ticket-alt"></i>Booked Tickets
                    </a>
                </li>
                <li>
                    <a href="admin_changepass.php">
                    <i class="fas fa-lock icon"></i>Change Password
                    </a>
                </li>
                <li>
                    <a href="place_report.php">
                    <i class="fa fa-file-alt"></i> Places Report
                    </a>
                </li>
                <li>
                    <a href="visit_report.php">
                    <i class="fa fa-file-alt"></i> Visitor Report
                    </a>
                </li>
            </ul>
        </div>
        <div class="header">
            <div class="admin_header">
                <a href="adminlogout.php">
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