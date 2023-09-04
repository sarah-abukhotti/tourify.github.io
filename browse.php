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
      <li>Browse Places by Type</li>
    </ol>
 
  </div>
</section>
<!-- End Breadcrumbs -->
<section class="why-us">
  <div class="container p-3">
     <div class="section-title">
      <h2>Browse Places (by Type)</h2>
      <h4>You can browse landmarks by type. <a href="browseLocation.php">Click here</a> to browse by location.</h4>
     </div>
    <div class="row">
    <?php
      $query = "SELECT * FROM landmarks_type ORDER BY id ASC";
        $result = $db->query($query);
        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {

              echo ' <div class="col-lg-3 p-2">
                     <a href="landmarksType.php?type='.$row['id'].'">
                        <div class="box">
                          <span>'.landmarkCountsByType($row['id']).'</span>
                          <h4>'.$row['type'].'</h4>
                          <span>Go</span>
                        </div></a>
                      </div>';
                  }
            }
    ?>
    </div>
  </div>
</section>
<?php 
include_once('required/footer.php'); 
// ======= library toster 
?>
