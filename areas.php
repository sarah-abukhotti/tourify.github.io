<?php 
include_once('required/server.php');
//    ======= meta ======= 
include_once('required/head.php'); 
 
//    ======= Header ======= 
include_once('required/header.php'); 
 ?>
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container p-3">

    <ol>
      <li><a href="index.php">Hotel and Resort Booking Website</a></li>
      <li><a href="browseLocation.php">Browse Places by City</a></li>
      <li>Browse Areas in City (<?= getCityNameId($_GET['city']); ?>)</li>
    </ol>
 
  </div>
</section><!-- End Breadcrumbs -->

<section class="why-us">
  <div class="container p-3">
    <div class="section-title">
      <h2>Browse Areas in City (<?= getCityNameId($_GET['city']); ?>)</h2>
      <h4>You can browse landmarks by area in <?= getCityNameId($_GET['city']); ?></h4>
    </div>

    <div class="row">
    <?php
      $query = "SELECT * FROM citys_areas WHERE cityId = ".$_GET['city']." ORDER BY id ASC";
      $result = $db->query($query);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="col-lg-3 p-2">
                  <a href="LandmarksArea.php?city='.$_GET['city'].'&areaID='.$row['id'].'">
                    <div class="box">
                      <span>'.landmarkCountsByAreas($row['id']).'</span>
                      <h4>'.$row['areaName'].'</h4>
                      <span>Go</span>
                    </div>
                  </a>
                </div>';
        }
      }
    ?>
    </div>
  </div>
</section>

<?php 
include_once('required/footer.php'); 
?>
