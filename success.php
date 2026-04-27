<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "website");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$place_name = $_SESSION['place_name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$adult = $_SESSION['adult'];
$child = $_SESSION['child'];
$date = $_SESSION['date'];
$amount = $_SESSION['amount'];

$sql = "INSERT INTO `ticket_book`(`place_name`, `email`, `phone`, `adult`, `child`, `date`, `total_price`) 
        VALUES ('$place_name','$email','$phone','$adult','$child','$date','$amount')";

if (mysqli_query($con, $sql)) {
    echo "<script>
                    alert('Your tickets for $place_name has booked successfully.\\nYou can check out your tickets in your profile.');
                    window.location.href = 'place.php';
                  </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
?>
