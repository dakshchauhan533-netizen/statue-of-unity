<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOU online ticket booking</title>
    <script src="angular.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome Link for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <style>
    .dropbtn {
      background-color: #54948a;
      color: white;
      padding: 9px;
      font-size: 15px;
      border: none;
      cursor: pointer;
      border-radius: 7px;
      margin-left: 29%;
      padding-bottom: 7px;
      padding-top: 7px;
      display: flex;
      align-items: center;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 10px 13px;
      text-decoration: none;
      display: block;
      margin-left: 0px;
    }

    .dropdown-content a:hover {background-color: #f1f1f1}

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown:hover .dropbtn {
      background-color: #54948a;
    }

    .btn {
            background-color: #4caf50; /* Green */
            border: solid #4caf50 1px;
            color: white;
            padding: 10px 8px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 10px;
            width: 25%;
        }

        .btn:hover {
            background-color: #ffffff; /* Darker green */
            color: #4CAF50;
            border: solid #4caf50 1px;
        }

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

        input[type="text"],
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
    <header>
      <nav class="navbar">
        <h2 class="logo"><a href="index.php"><img src="images/sou2.png" alt="SOU"></a></h2>
        <input type="checkbox" id="menu-toggler">
        <label for="menu-toggler" id="hamburger-btn">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
            <path d="M0 0h24v24H0z" fill="none"/>
            <path d="M3 18h18v-2H3v2zm0-5h18V11H3v2zm0-7v2h18V6H3z"/>
          </svg>
        </label>
        <ul class="all-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="place.php">Places & Shows</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="contact.php">Contact Us</a></li>

          <?php
            if(isset($_SESSION['uemail'])){
          ?>
            <div class="dropdown">
              <button class="dropbtn"><img src="images/user.png" alt="img"><?php echo $row['name'] ?></button>
              <div class="dropdown-content">
                <a href="update.php?id=<?php echo $row['id'] ?>">Update Profile</a>
                <a href="userpage.php">My Tickets</a>
                <a href="logout.php">Log Out</a>
              </div>
            </div>
          <?php
            }else{
          ?>

          <li><a href="signin.php">Sign in/Log in</a></li>
          <?php
            }
          ?>
        </ul>
      </nav>
    </header>