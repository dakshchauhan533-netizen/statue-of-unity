<?php
    session_start();
    if(!isset($_SESSION['aemail'])){
        header("location:adminlogin.php");
    }

    $con = mysqli_connect("localhost","root","","website");

    if (isset($_POST['add'])){
        $name = $_POST['p_name'];
        $o_time = $_POST['o_time'];
        $c_time = $_POST['c_time'];
        $a_price = $_POST['a_price'];
        $c_price = $_POST['c_price'];
        $img=$_FILES['img']['name'];
        $tmp = explode(".",$img);
        $newfn = round(microtime(true)).'.'.end($tmp);
        $uploadpath = "../images/".$newfn;
        move_uploaded_file($_FILES['img']['tmp_name'],$uploadpath);

        $sql = "INSERT INTO `places`(`place_name`, `o_time`, `c_time`, `a_price`, `c_price`,`img`) VALUES ('$name','$o_time','$c_time','$a_price','$c_price','$newfn')";

        $data =mysqli_query($con,$sql);

        if ($data) {
            header('location:add_place.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <h2><i class="fas fa-user-shield"></i> SOU Admin</h2>
            <ul>
                <li>
                    <a href="index.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li>
                    <a href="users.php"><i class="fas fa-users"></i>Users</a>
                </li>
                <li>
                    <a href="add_place.php"><i class="fas fa-plus-circle"></i>Add Places</a>
                </li>
                <li>
                    <a href="view_place.php"><i class="fas fa-map-marked-alt"></i>View Places</a>
                </li>
                <li>
                    <a href="ticket_booked.php"><i class="fas fa-ticket-alt"></i>Booked Tickets</a>
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
                <a href="adminlogout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
            <div class="info">
                <h1>Add Places</h1>
                <div class="my_form">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="div_deg">
                            <label for="p_name">Place Name:</label>
                            <input type="text" name="p_name">
                        </div>

                        <div class="div_deg">
                            <label for="time">Open Time:</label>
                            <input type="time" name="o_time">                             
                        </div>

                        <div class="div_deg">
                            <label for="time">Close Time:</label>
                            <input type="time" name="c_time">
                        </div>

                        <div class="div_deg">
                            <label for="a_price">Adult Price:</label>
                            <input type="number" name="a_price">
                        </div>

                        <div class="div_deg">
                            <label for="c_price">Child Price:</label>
                            <input type="number" name="c_price">
                        </div>

                        <div class="div_deg">
                            <label for="c_price">Place Image:</label>
                            <input type="file" name="img">
                        </div>

                        <div class="div_deg">
                            <input type="submit" value="ADD PLACE" name="add" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector("form").addEventListener("submit", function (e) {
        const placeName = document.querySelector("input[name='p_name']").value.trim();
        const openTime = document.querySelector("input[name='o_time']").value;
        const closeTime = document.querySelector("input[name='c_time']").value;
        const adultPrice = document.querySelector("input[name='a_price']").value;
        const childPrice = document.querySelector("input[name='c_price']").value;
        const image = document.querySelector("input[name='img']").value;
        
        const namePattern = /^[a-zA-Z ]{3,}$/; // At least 3 characters, only letters and spaces.
        const pricePattern = /^[1-9]\d*$/; // Must be a positive integer.
        const imagePattern = /\.(jpg|jpeg|png)$/i; // Allowed image formats.

        // Clear previous errors
        let errorMessage = "";
        
        if (!namePattern.test(placeName)) {
            errorMessage += "Place name must contain only letters and be at least 3 characters long.\n";
        }

        if (!openTime || !closeTime) {
            errorMessage += "Open and Close times must be selected.\n";
        }

        if (!pricePattern.test(adultPrice)) {
            errorMessage += "Adult price must be a positive number.\n";
        }

        if (!pricePattern.test(childPrice)) {
            errorMessage += "Child price must be a positive number.\n";
        }

        if (!imagePattern.test(image)) {
            errorMessage += "Invalid image format. Only JPG, JPEG, and PNG are allowed.";
        }

        if (errorMessage) {
            alert(errorMessage);
            e.preventDefault();
        }
    });
    </script>
</body>

</html>