<?php
    session_start();
    $con = mysqli_connect("localhost","root","","website");
    if(isset($_SESSION['uemail'])){
      $uid=$_SESSION['uemail'];

      $search = "SELECT * FROM `user` WHERE email='$uid'";

      $ph = mysqli_query($con,$search);

      $row=mysqli_fetch_assoc($ph);
    }

    $sql= "SELECT * FROM `places`";

    $result = mysqli_query($con,$sql);
?>

<?php include 'header.php'; ?>
      <section class="portfolio" id="portfolio"><br><br>
        <h2>Available Tickets</h2>
        <p style="margin-top: 0%">Explore our wide range of places for tourism.</p>
        <ul class="cards">
          <?php
            while($ro=mysqli_fetch_assoc($result)){
          ?>
          <li class="card" style="margin-top: 10px">
            <img src="images/<?php echo $ro['img']; ?>" alt="img">
            <h3><?php echo $ro['place_name']; ?></h3>
            <p>Time - <?php echo date("h:i", strtotime($ro['o_time'])); ?>am to <?php echo date("h:i", strtotime($ro['c_time'])); ?>pm<br>Adult - <b>₹<?php echo $ro['a_price']; ?></b> & Child - <b>₹<?php echo $ro['c_price']; ?></b></p>
            <br>
            <a href="b1.php?id=<?php echo $ro['id'] ?>"><button type="button" class="btn">Book</button></a>
          </li>
          <?php
            }
          ?>
        </ul>
      </section>

      <?php include 'footer.php'; ?>