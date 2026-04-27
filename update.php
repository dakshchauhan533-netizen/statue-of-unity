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
        $name = $_POST['uname'];
        $email = $_POST['email'];
        $phone = $_POST['uphone'];
        $age = $_POST['age'];

        $update = "UPDATE `user` SET `name`='$name',`email`='$email',`phone`='$phone',`age`='$age' WHERE id='$p_id'";

        $data =mysqli_query($con,$update);

        if($data){
            header("location:index.php");
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
            <h1><i class="fas fa-user-cog"></i> Update Profile</h1>
                <div class="my_form">
                    <form action="" method="POST" name="updateForm" onsubmit="return validateForm()" enctype="multipart/form-data">
                        <div class="div_deg">
                            <label for="uname"><i class="fas fa-user icon"></i>Name:</label>
                            <input type="text" value="<?php echo $row['name'] ?>" name="uname" id="uname">
                        </div>

                        <div class="div_deg">
                            <label for="email"><i class="fas fa-envelope icon"></i>Email:</label>
                            <input type="email" value="<?php echo $row['email'] ?>" name="email" id="email">                             
                        </div>

                        <div class="div_deg">
                            <label for="uphone"><i class="fas fa-phone icon"></i>Phone:</label>
                            <input type="tel" value="<?php echo $row['phone'] ?>" name="uphone" id="uphone">
                        </div>

                        <div class="div_deg">
                            <label for="age"><i class="fas fa-birthday-cake icon"></i>Age:</label>
                            <input type="number" value="<?php echo $row['age'] ?>" name="age" id="age">
                        </div>

                        <div class="div_deg">
                            <input type="submit" value="UPDATE" name="update" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            var name=document.getElementById("uname").value;
            var email=document.getElementById("email").value;
            var phone=document.getElementById("uphone").value;
            var age=document.getElementById("age").value;

            // Name validation
            if (name === "") {
                alert("Name must be filled out.");
                return false;
            }

            var regex = /^[a-zA-Z ]+$/;
            if (!regex.test(name)) {
                alert("Name must contain only alphabets!");
                return false;
            }
            
            // Email validation
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Phone validation
            const phonePattern = /^[0-9]{10}$/; // Adjust this regex for your requirements
            if (!phonePattern.test(phone)) {
                alert("Please enter a valid 10-digit phone number.");
                return false;
            }

            // Age validation
            if (isNaN(age) || age <= 0 || age.length > 2) {
                alert("Please enter a valid age.");
                return false;
            }


            return true;
        }
    </script>
</body>
</html>