<?php
    session_start();
    if(!isset($_SESSION['aemail'])){
        header("location:adminlogin.php");
    }

    $con = mysqli_connect("localhost","root","","website");

    if(isset($_GET['search'])){
        $search = $_GET['isearch'];

        $sql = "SELECT * FROM `ticket_book` WHERE concat(place_name,email,phone) LIKE '%$search%'";

        $result = mysqli_query($con,$sql);
    }
    else{
        $sql = "SELECT * FROM `ticket_book`";

        $result = mysqli_query($con,$sql);
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
                <h1>Booked Tickets</h1>
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Place Name</th>
                        <th>User Email</th>
                        <th>User Phone</th>
                        <th>Adult</th>
                        <th>Child</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                    </tr>

                    <?php
                        while($row=mysqli_fetch_assoc($result)){
                    ?>

                    <tr>
                        <td><?php echo $row['place_name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['adult'] ?></td>
                        <td><?php echo $row['child'] ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td><?php echo $row['total_price'] ?></td>
                    </tr>

                    <?php
                        }
                    ?>

                </table><br>
                <div>
                    <h3>Search:</h3>
                    <form action="" method="GET" class="f">
                        <input type="text" name="isearch" required>
                        <button type="submit" class="btn btn-primary btn-lg" id="b" name="search">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>