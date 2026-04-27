<?php
    session_start();
    if(!isset($_SESSION['aemail'])){
        header("location:adminlogin.php");
    }

    $con = mysqli_connect("localhost","root","","website");

    if(isset($_GET['id'])){
        $p_id = $_GET['id'];
        $d_sql = "DELETE FROM `places` WHERE id='$p_id'";
        $data = mysqli_query($con,$d_sql);
        if($data){
            header("location:view_place.php");
        }
    }

    $sort_option = "";
    if(isset($_GET['search'])){
        $search = $_GET['isearch'];

        $sql = "SELECT * FROM `places` WHERE concat(place_name,a_price,c_price) LIKE '%$search%'";

        $result = mysqli_query($con,$sql);
    }
    elseif (isset($_GET['sorting'])) {
        if($_GET['sorting'] == "a-z"){
            $sort_option = "ASC";
            $sql = "SELECT * FROM `places` ORDER BY place_name $sort_option";
        }
        elseif($_GET['sorting'] == "z-a"){
            $sort_option = "DESC";
            $sql = "SELECT * FROM `places` ORDER BY place_name $sort_option";
        }
        elseif($_GET['sorting'] == "adult_low-high"){
            $sort_option = "ASC";
            $sql = "SELECT * FROM `places` ORDER BY a_price $sort_option";
        }
        elseif($_GET['sorting'] == "adult_high-low"){
            $sort_option = "DESC";
            $sql = "SELECT * FROM `places` ORDER BY a_price $sort_option";
        }
        elseif($_GET['sorting'] == "child_low-high"){
            $sort_option = "ASC";
            $sql = "SELECT * FROM `places` ORDER BY c_price $sort_option";
        }
        elseif($_GET['sorting'] == "child_high-low"){
            $sort_option = "DESC";
            $sql = "SELECT * FROM `places` ORDER BY c_price $sort_option";
        }
        $result = mysqli_query($con,$sql);
    }
    else{
        $sql = "SELECT * FROM `places`";

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
        .bq{
            text-decoration: none;
            color: white;
        }

        .bq:hover{
            text-decoration: none;
            color: white;
        }

        input[type='text']
        {
            width: 25%;
            padding: 10px;
        }

        #b{
            margin-bottom: 4px;
        }
        
        .f{
            margin-top: 1%;
        }

        .info{
            margin-top: 5%;
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

        #sort{
            background-color: #007bff;
            color: #fff;
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
                <h1>All Places</h1>
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <select name="sorting"  class="form-control" required>
                                    <option value="">--Select Option</option>
                                    <option value="a-z">Place Name A-Z</option>
                                    <option value="z-a">Place Name Z-A</option>
                                    <option value="adult_low-high">Adult Price Low-High</option>
                                    <option value="adult_high-low">Adult Price High-Low</option>
                                    <option value="child_low-high">Child Price Low-High</option>
                                    <option value="child_high-low">Child Price High-Low</option>
                                </select>
                                <button type="submit" class="input-group-text btn btn-primary" id="sort">Sort <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16"><path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/></svg></button>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Place Name</th>
                        <th>Opening Time</th>
                        <th>Closing Time</th>
                        <th>Adult price</th>
                        <th>Child Price</th>
                        <th>Image</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>

                    <?php
                        while($row=mysqli_fetch_assoc($result)){
                    ?>

                    <tr>
                        <td><?php echo $row['place_name'] ?></td>
                        <td class="text-center"><?php echo date("h:i", strtotime($row['o_time'])); ?></td>
                        <td class="text-center"><?php echo date("h:i", strtotime($row['c_time'])); ?></td>
                        <td class="text-center"><?php echo $row['a_price'] ?></td>
                        <td class="text-center"><?php echo $row['c_price'] ?></td>
                        <td><img src="../images/<?php echo $row['img'] ?>" alt="image" height="60" height="60"></td>
                        <td><button class="btn btn-success"><a href="update_place.php?id=<?php echo $row['id'] ?>" class="bq">Update</a></button></td>
                        <td><button class="btn btn-danger"><a onclick="return confirm('Are you sure to delete this data');" href="view_place.php?id=<?php echo $row['id'] ?>" class="bq">Delete</a></button></td>
                    </tr>

                    <?php
                        }
                    ?>   

                </table><br>
                <div>
                    <h3>Search:</h3>
                    <form action="" method="GET" class="f">
                        <input type="text" name="isearch">
                        <button type="submit" class="btn btn-primary btn-lg" id="b" name="search">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>