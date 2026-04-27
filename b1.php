
<?php
    session_start();
    if(!isset($_SESSION['uemail'])){
        header("location:login.php");
    }

    $con = mysqli_connect("localhost","root","","website");

    $uid=$_SESSION['uemail'];

    $search = "SELECT `phone` FROM `user` WHERE email='$uid'";

    $ph = mysqli_query($con,$search);

    $row=mysqli_fetch_assoc($ph);

    $p_id = $_GET['id'];

    $sql = "SELECT * FROM `places` WHERE id='$p_id'";

    $result = mysqli_query($con,$sql);

    $ro = mysqli_fetch_assoc($result);

    if (isset($_POST['book'])){
        $ad = $_POST['adult'];
        $ch = $_POST['child'];
        $adult_price = $ad*200;
        $child_price = $ch*100;
        $total_price = $adult_price + $child_price;
        $place_name = $_POST['place_name'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $adult = $_POST['adult'];
        $child = $_POST['child'];
        $date = $_POST['date'];
        $amount = $_POST['amount'];

        /*$_SESSION['place_name'] = $place_name;
        $_SESSION['email'] = $name;
        $_SESSION['phone'] = $phone;
        $_SESSION['adult'] = $adult;
        $_SESSION['child'] = $child;
        $_SESSION['date'] = $date;
        $_SESSION['amount'] = $amount;

        header("location:payment.php");*/

        
        $_SESSION['place_name'] = $place_name;
        $_SESSION['email'] = $name;
        $_SESSION['phone'] = $phone;
        $_SESSION['adult'] = $adult;
        $_SESSION['child'] = $child;
        $_SESSION['date'] = $date;
        $_SESSION['amount'] = $amount;

        echo "<script> window.location.href='payment.php'; </script>";

        /*$sql = "INSERT INTO `ticket_book`(`place_name`, `email`, `phone`, `adult`, `child`, `date`, `total_price`) VALUES ('$place_name','$name','$phone','$adult','$child','$date','$amount')";

        $data =mysqli_query($con,$sql);

        if ($data) {
            echo "<script>
                    alert('Your tickets for $place_name has booked successfully.\\nYou can check out your tickets in your profile.');
                    window.location.href = 'place.php';
                  </script>";
        }*/
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket booking</title>
    <link rel="stylesheet" href="style.css">
    <script src="angular.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        .b {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            margin-top: 10%;
            
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 80px rgba(0, 0, 0, 0.1);
            width: 450px;
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

        input[type="email"],
        input[type="number"],
        input[type="tel"],
        input[type="text"],
        input[type="date"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
          <h2 class="logo"><a href="#"><img src="images/sou2.png" alt="SOU"></a></h2>
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
          </ul>
        </nav>
      </header>

      <div class="b">
        <div class="form-container" ng-app="myapp" ng-controller="priceinfo">
            <h2>Ticket Book</h2>
            
            <form action="" method="POST" onsubmit="return validateForm()">
                <label for="pname" style="margin-top:3px;">Place Name:</label>
                <input type="text" name="place_name" value="<?php echo $ro['place_name']; ?>" required readonly>
                
                <label for="name">Email:</label>
                <input type="Email" id="name" name="name" value="<?php echo $uid ?>" required readonly>

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $row['phone'] ?>" required readonly>

                <label for="adult">Adult<small>(Above 16 years)</small>:</label>
                <input type="number" name="adult" id="adult" ng-model="a1" ng-change="calprice()" ng-init="a1=0">
                <span id="msg1" style="color:red"> </span>

                <label for="child">Child<small>(Under 3-16 years)</small>:</label>
                <input type="number" name="child" id="child" ng-model="c1" ng-change="calprice()" ng-init="c1=0"> 
                <span id="msg2" style="color:red"> </span>               

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="price">Total Price:</label>
                <input type="text" name="amount" value="{{total_price}}.00" required readonly>


                <br>

                <input type="hidden" name="p1" ng-model="p1" ng-change="calprice()" value="<?php echo $ro['a_price']; ?>" ng-init="p1=<?php echo $ro['a_price']; ?>">
                <input type="hidden" name="p2" ng-model="p2" ng-change="calprice()" value="<?php echo $ro['c_price']; ?>" ng-init="p2=<?php echo $ro['c_price']; ?>">

                <input type="submit" value="Book Now" name="book">
                <span id="msg3" style="color:red"> </span>
                <small><p style="color:red"><span style="font-size:20px;">⚠️</span> Tickets once booked cannot be cancelled or refunded.</p></small>
            </form>
            <script>
                function validateForm() {
                    var adult = document.getElementById('adult').value;;
                    var child = document.getElementById('child').value;;

                    if (adult < 0) {
                        document.getElementById("msg1").innerHTML = "Negative numbers not allowed.";
                        return false;
                    }

                    if (child < 0) {
                        document.getElementById("msg2").innerHTML = "Negative numbers not allowed.";
                        return false;
                    }

                    if (adult == 0 && child == 0) {
                        document.getElementById("msg3").innerHTML = "At least one field (Adult or Child) must have one person to book ticket.";
                        return false;
                    }


                    return true;
                }

                document.getElementById('adult').addEventListener('input', function() {
                    if (this.value < 0) this.value = 0;
                });

                document.getElementById('child').addEventListener('input', function() {
                    if (this.value < 0) this.value = 0;
                });

                function validateInput(event) {
                    const inputField = event.target;
                    inputField.value = inputField.value.replace(/[^0-9]/g, '');
                }

                document.getElementById('adult').addEventListener('input', validateInput);
                document.getElementById('child').addEventListener('input', validateInput);
            </script>
            
        </div>
    </div>
    <script>
        var app = angular.module("myapp",[]);
app.controller("priceinfo", function($scope) {
    $scope.p1 = <?php echo $ro['a_price']; ?>; // Fetch adult price from PHP
    $scope.p2 = <?php echo $ro['c_price']; ?>; // Fetch child price from PHP
    $scope.a1 = 0; 
    $scope.c1 = 0; 
    $scope.aprice = 0;
    $scope.cprice = 0;
    $scope.total_price = 0; // Initialize total price

    $scope.calprice = function() {
        $scope.aprice = $scope.a1 * $scope.p1;
        $scope.cprice = $scope.c1 * $scope.p2;
        $scope.total_price = $scope.aprice + $scope.cprice; // Ensure total price is updated
    };
});
    </script>
  <?php include 'footer.php'; ?>