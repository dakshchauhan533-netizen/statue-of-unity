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

      <section class="about" id="about"><br><br>
        <h2>About Us</h2>
        <p style="margin-top: 0%">Discover about Statue Of Unity.</p>
        <div class="row company-info">
          <h3>SOU Info</h3>
          <p style="text-align: left;margin-top: 0;">The Statue of Unity stands tall at an impressive 182 meters (597 feet), making it the world's
            tallest statue. To put this into perspective, it's nearly double the height of the Statue of
            Liberty in the United States.</p>
        </div>
        <div class="row mission-vision">
          <h3>Sardar Vallabhbhai Patel</h3>
          <p style="text-align: left;margin-top: 0;">The statue portrays Vallabhbhai Patel, an eminent Indian statesman and independence activist. Patel,
            also known as Sardar Patel, was the first deputy prime minister and home minister of independent
            India. His unwavering commitment to the country’s unity and his role in the political integration of
            India are highly respected.</p>
          <h3>Project Info</h3>
          <p style="text-align: left;margin-top: 0;">The project was announced in 2010, and construction began in October 2013. Indian company Larsen &
            Toubro undertook the construction, with a total cost of ₹27 billion (US$422 million). The statue was
            designed by renowned Indian sculptor Ram V. Sutar. It was inaugurated by the Prime Minister of
            India, Narendra Modi, on 31 October 2018, which marked the 143rd anniversary of Patel’s birth.</p>
        </div>
        <div class="row team">
          <h3>Our Team</h3>
          <ul>
            <li>Ram V. Sutar - Design Sculptor</li>
            <li>Goverment Of Gujrat - Funding Partner</li>
            <li>Larsen & Toubro - Infrastucture</li>
          </ul>
        </div>
      </section>

      <?php include 'footer.php'; ?>