<?php
session_start();

$api_key = "rzp_test_jP3TtByYGUAeLp"; // Replace with your test API key

$place_name = $_SESSION['place_name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$adult = $_SESSION['adult'];
$child = $_SESSION['child'];
$date = $_SESSION['date'];
$amount = $_SESSION['amount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<script>
    var options = {
        "key": 'rzp_test_jP3TtByYGUAeLp',
        "amount": "<?php echo $amount * 100; ?>", // Razorpay uses paise
        "currency": "INR",
        "name": "Statue of Unity Booking",
        "description": "Ticket Booking Payment",
        "image": "images/sou2.png", // Add your logo URL
        "handler": function (response){
            window.location.href = "success.php?payment_id=" + response.razorpay_payment_id;
        },
        "prefill": {
            "name": "<?php echo $email; ?>",
            "email": "<?php echo $email; ?>",
            "contact": "<?php echo $phone; ?>"
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
</script>



</body>
</html>
