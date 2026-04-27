<?php
    session_start();
    if(isset($_SESSION['uemail'])){
      $uid=$_SESSION['uemail'];
      $con = mysqli_connect("localhost","root","","website");

      $search = "SELECT * FROM `user` WHERE email='$uid'";

      $ph = mysqli_query($con,$search);

      $row=mysqli_fetch_assoc($ph);
    }
?>

<?php include 'header.php'; ?>
<!--<style>
  header {
    background-color: #674C47;
    color: #F9F5E7;
  }

  footer {
    background-color: #3E2723;
    color: #F9F5E7;
  }

  body {
    background-color: #F9F5E7;
    color: #2E2E2E;
  }
</style>-->

    <section class="homepage" id="home" style="background-image: url(images/0001.jpg);">
      <div class="content">
        <div class="text">
          <h1>Statue Of Unity</h1>
          <p>
            All Tickets Available in Very Confirmable Price, And All Tour Progarm.</p>
        </div>
        <a href="place.php">Book Tickets</a>
      </div>
    </section>

    

    <section class="services" id="services">
      <h2>Places & Shows</h2>
      <p>Take a look at some of our memorable places and shows.</p>
      <ul class="cards">
        <li class="card">
          <img src="images/2.jpg" alt="img">
          <h3>SOU Entry Ticket</h3>
          <p>Sardar Sarovar Dam Viewpoint and Bus Service for above places. This ticket does not include access to Viewing Gallery.</p>
        </li>
        <li class="card">
          <img src="images/3.jpg" alt="img">
          <h3>Viewing Gallery</h3>
          <p>This ticket does include Access to Viewing Gallery in addition to SoU Entry.</p>
        </li>
        <li class="card">
          <img src="images/4.jpg" alt="img">
          <h3>Narmada Maha Aarti</h3>
          <p>Sankalp of the person will be performed before the Aarti and should be given seat behind Pujari performing the aarti.</p>
        </li>
        <li class="card">
          <img src="images/5.jpg" alt="img">
          <h3>Jungle Safari</h3>
          <p>Step into a world of immersive, walk-in habitats featuring a vibrant collection of exotic and native birds, as well as primates.</p>
        </li>
        <li class="card">
          <img src="images/6.jpg" alt="img">
          <h3>Butterfly Garden</h3>
          <p>There are more than 450 species of Cacti and succulents from 17different countries have been planted here.</p>
        </li>
        <li class="card">
          <img src="images/7.jpg" alt="img">
          <h3>Maze Garden</h3>
          <p>The aesthetic beauty of the site will enable to attract visitors of all age groups.</p>
        </li>
      </ul>
    </section>

<?php include 'footer.php'; ?>
