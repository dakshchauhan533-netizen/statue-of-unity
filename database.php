<?php
      $con = mysqli_connect("localhost","root","","website");

      if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    echo "Connected successfully";
      
?>