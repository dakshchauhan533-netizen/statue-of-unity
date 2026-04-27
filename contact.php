<?php
  session_start();
  
  if(isset($_SESSION['uemail'])){
    $uid=$_SESSION['uemail'];
    $con = mysqli_connect("localhost","root","","website");
    $search = "SELECT * FROM `user` WHERE email='$uid'";
    $ph = mysqli_query($con,$search);
    $row=mysqli_fetch_assoc($ph);
  }

  if(!isset($_SESSION['uemail'])){
    header("location:login.php");
  }

  if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $review = $_POST['review'];
    $review = mysqli_real_escape_string($con, $review);
    
    $sql = "INSERT INTO `feedback`(`name`, `email`, `review`) VALUES ('$name','$email','$review')";

    $data =mysqli_query($con,$sql);

    if ($data) {
      echo "<script>alert('$name, Thank you! Your feedback has been successfully submitted.')</script>";
    }
  }

  $record = "SELECT * FROM `feedback`";
  $result = mysqli_query($con,$record);

?>

<?php include 'header.php'; ?>
      <section class="contact" id="contact"><br><br>
        <h2>Contact Us</h2>
        <p style="margin-top: 0%">Reach out to us for any inquiries or feedback.</p>
        <div class="row">
          <div class="col information">
            <div class="contact-details">
              <p style="text-align: left;margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Sardar Sarovar Dam, Satute of Unity Rd, Kevadia, Gujrat 393155</p>
              <p style="text-align: left;margin-top: 0;"><i class="fas fa-envelope"></i> info@sou.com</p>
              <p style="text-align: left;margin-top: 0;"><i class="fas fa-phone"></i> 1800 233 6600</p>
              <p style="text-align: left;margin-top: 0;"><i class="fas fa-clock"></i> Tue To Sun: 8:00 AM -  6:00 PM</p>
              <p style="text-align: left;margin-top: 0;"><i class="fas fa-clock"></i> Monday: Closed</p>
              <p style="text-align: left;margin-top: 0;"><i class="fas fa-globe"></i> www.soutickets.com</p>
            </div>          
          </div>
          <div class="col form">
            <form method="POST">
              <input type="text" placeholder="Name*" value="<?php echo $row['name'] ?>" name="name" required>
              <input type="email" placeholder="Email*" value="<?php echo $uid ?>" name="email" readonly required>
              <textarea placeholder="Message*" name="review" required></textarea>
              <button id="submit" type="submit" name="submit">Send Feedback</button>
            </form>
          </div>
        </div>
      </section>
      <section class="about" id="about" style="padding: 0px;">
        <h2>Reviews</h2>
        <?php
          while($ro=mysqli_fetch_assoc($result)){
        ?>
        <div class="row company-info">
          <div style="display: flex; align-items: center;">
            <img src="images/user1.png" alt="img" style="width: 5%;height: 5%;">
            <div style="margin-left: 1%">
              <h4><?php echo $ro['name']; ?></h4>
              <h5><?php echo $ro['email']; ?></h5>
            </div>
          </div>
          <div>
            <p style="text-align: left;margin-top: 0;"><?php echo $ro['review']; ?></p>
          </div>
        </div>
        <?php
          }
        ?>
      </section>

      <?php include 'footer.php'; ?>