<?php
    session_start();
    if(!isset($_SESSION['aemail'])){
        header("location:adminlogin.php");
    }

    $con = mysqli_connect("localhost","root","","website");
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
            <form  method="post" style="display: flex; gap: 15px; align-items: center;">
                    <input type="date" name="date1" class="form-control" required>
                    <input type="date" name="date2" class="form-control" required>
                    <select name="visitor" class="form-control" required>
                        <option value="adult">Adults</option>
                        <option value="child">Childs</option>
                        <option value="both">Both</option>
                    </select>
                    <button type="submit" name="submit" class="btn btn-primary">View Report</button>
                </form>
                <?php
                    $d1 = "";
                    $d2 = "";
                    $visitor = "";
                    if (isset($_POST['submit'])) {
                        $d1 = $_POST['date1'];
                        $d2 = $_POST['date2'];
                        $visitor = $_POST['visitor'];

                        if ($visitor == "adult") {
                            $sql = "SELECT * FROM `ticket_book` WHERE `date` BETWEEN '$d1' AND '$d2' AND adult > 0";
                        }
                        elseif ($visitor == "child") {
                            $sql = "SELECT * FROM `ticket_book` WHERE `date` BETWEEN '$d1' AND '$d2' AND child > 0";
                        }
                        elseif ($visitor == "both") {
                            $sql = "SELECT * FROM `ticket_book` WHERE `date` BETWEEN '$d1' AND '$d2' AND (adult > 0 OR child > 0)";
                        }
                    }
                    if (!empty($sql)) {
                        $data = mysqli_query($con, $sql);
                    } else {
                        $data = false;
                    }
                    
                ?>
                <br>
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Place Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Adult</th>
                        <th>Child</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                    </tr>

                    <?php
                        $total = 0;
                        if ($data && mysqli_num_rows($data) > 0) {
                            foreach($data as $show){
                                if ($visitor == "adult") {
                                    $total += $show['adult'];
                                } elseif ($visitor == "child") {
                                    $total += $show['child'];
                                } elseif ($visitor == "both") {
                                    $total += $show['adult'] + $show['child'];
                                }
                    ?>

                    <tr>
                        <td><?php echo $show['place_name'] ?></td>
                        <td><?php echo $show['email'] ?></td>
                        <td><?php echo $show['phone'] ?></td>
                        <td><?php echo $show['adult'] ?></td>
                        <td><?php echo $show['child'] ?></td>
                        <td><?php echo $show['date'] ?></td>
                        <td><?php echo $show['total_price'] ?></td>
                    </tr>

                    <?php
                    }
                        }
                        else{
                    ?>

                    <tr>
                        <td colspan="7">No Record Found!!!</td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <?php
                    echo !empty($visitor) ? ucfirst($visitor) . " Count Is : $total" : "Please select a visitor type.";
                ?>
            </div>
        </div>
    </div>
</body>
</html>