<?php 
include_once('../required/server.php'); 
include_once("required/head.php");
if (!isLoggedIn()) {
     header('location: ..\login.php');
  }
if ($_SESSION['user']['type'] != 1 ) {
      header('location: ..\index.php');
}
?>
 <!-- ../assets/img/imageresort.jpg -->
<style type="text/css">
        main {
          background: url(../assets/img/imageresort.jpg);
          background-repeat: no-repeat;
          background-size: cover;
        }
        .card{
            opacity: 0.9;
         }
 </style>
 
 <body>
  <?php
      include_once("required/header.php");
      include_once("required/sidebar.php");
  ?>
<main id="main" class="main" dir=ltr>
<div class="pagetitle">
<!-- Hotel Template -->
<section class="section hotel-template">
  <div class="container">
    <h2>Welcome to our Tourify</h2>
    <p>Experience luxury and comfort during your stay with us.</p>
    <div class="row">
    <div class="col-md-6">
     <img src="https://images.unsplash.com/photo-1615460549969-36fa19521a4f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80" alt="Hotel Image" class="img-fluid rounded" style="border-radius: 100%; object-fit: cover; width: 100%; height: 70%;">
    </div>

      <div class="col-md-6">
        <h3>Tourify Amenities</h3>
        <ul>
          <li>Swimming Pool</li>
          <li>Gym and Fitness Center</li>
          <li>24-hour Room Service</li>
        </ul>
        <p>Book your stay at our tourify and enjoy these amazing amenities.</p>
      </div>
    </div>
  </div>
</section>

<!-- End Hotel Template -->


</main>
  <!-- ======= Footer ======= -->
 <?php
 include_once("required/footer.php");
 ?>
</body>
</html>
 