<?php
    session_start();
    if(!isset($_SESSION['uemail'])){
        header("location:login.php");
    }
    $uid=$_SESSION['uemail'];

    $con = mysqli_connect("localhost","root","","website");

    $sql = "SELECT * FROM `ticket_book` WHERE email='$uid'";

    $result = mysqli_query($con,$sql);

    $search = "SELECT * FROM `user` WHERE email='$uid'";

    $ph = mysqli_query($con,$search);

    $row=mysqli_fetch_assoc($ph);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Tickets - SOU</title>
    <link rel="stylesheet" href="admin/admin-style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Icon styling */
        .icon {
            margin-right: 8px;
            width: 20px;
        }

        /* Table improvements */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        table {
            margin: 0;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 1rem 1.5rem;
            font-weight: 600;
            vertical-align: middle;
            border-bottom: 2px solid #e0e0e0;
        }

        td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f8f9fa;
            transform: scale(1.005);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        .amount-column {
            font-weight: 600;
            color: #27ae60;
        }

        .date-column {
            min-width: 120px;
        }

        /* Responsive table */
        @media (max-width: 768px) {
            .table-container {
                overflow-x: auto;
            }
            
            table {
                min-width: 600px;
            }
        }

        /* Header improvements */
        h1 {
            color: #2c3e50;
            margin-bottom: 2rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #3498db;
            display: inline-block;
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
                <h1>Booked Tickets</h1>
                <div class="table-container">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Place</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Adult</th>
                                <th>Child</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row=mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['place_name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td class="text-center"><?php echo $row['adult'] ?></td>
                                <td class="text-center"><?php echo $row['child'] ?></td>
                                <td class="date-column"><?php echo date('M j, Y', strtotime($row['date'])) ?></td>
                                <td class="text-center"><?php echo number_format($row['total_price']) ?></td>
                                <td class="text-center"><a href="generate_pdf.php?ticket_id=<?php echo $row['id']; ?>" ><i class="fas fa-file-pdf"></i></a></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>