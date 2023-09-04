<?php 
include_once('required/server.php');
// ======= meta ======= 
include_once('required/head.php'); 
// ======= Header ======= 
include_once('required/header.php'); 
?>

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container p-3">

    <ol>
      <li><a href="index.php">Hotel and Resort Booking Website</a></li>
      <li><a href="browse.php">Browse by Type</a></li>
      <li>Available Places of Type (<?= landmarkTypeName($_GET['type']); ?>)</li>
    </ol>

  </div>
</section><!-- End Breadcrumbs -->

<section class="why-us">
  <div class="container p-4">
    <div class="section-title">
      <h2>Available Places of Type (<?= landmarkTypeName($_GET['type']); ?>)</h2>
    </div>

    <section id="team" class="team section-bg">
      <div class="container">

        <div class="row">

          <?php

          $query = "SELECT *, landmarks.id AS controll FROM landmarks
                    JOIN images ON images.landmarkID = landmarks.id
                    WHERE images.main = 1 AND landmarks.activity = 1 AND landmarks.type = " . $_GET['type'] . "
                    ORDER BY landmarks.id DESC";

          $result = $db->query($query);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $owner = getOwnerNameId($row['owner']);

              echo '<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                      <div class="member">
                        <div class="member-img">
                          <a href="landmark.php?landmarkID=' . $row['controll'] . '">
                            <img src="' . $row['image'] . '" class="img-fluid" alt="" style="height: 27vh;">
                            <div class="social">
                              <a href="areas.php?city=' . $row['city'] . '">' . getCityNameId($row['city']) . '</a>
                              <a href="LandmarksArea.php?city=' . $row['city'] . '&areaID=' . $row['areaID'] . '">' . getAreaNameId($row['areaID']) . '</a>
                            </div>
                          </a>
                        </div>
                        <div class="member-info">
                          <a href="landmark.php?landmarkID=' . $row['controll'] . '">
                            <h4>' . $row['landmarkName'] . '</h4>
                          </a>
                          <span>Owner: <a href="owner.php?owner=' . $owner['uid'] . '">' . $owner['fname'] . ' ' . $owner['lname'] . '</a></span>
                        </div>
                      </div>
                    </div>';
            }
          } else {
            echo '<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                      <div class="member-img">
                        Sorry, No Data...
                      </div>
                    </div>
                  </div>';
          }

          ?>

        </div>

      </div>
    </section><!-- End Team Section -->

  </div>

</section>

<?php 
include_once('required/footer.php'); 
?>
