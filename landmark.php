<?php
include_once('required/server.php');
include_once('required/AdminFunctions.php');
$landmarkData = AdminGetlandmarkID($_GET['landmarkID']);
$basicInformationArray = AdminGetlandmarkID($_GET['landmarkID']);
$availabilityArray = AdminGetLandmarkAvailability($_GET['landmarkID']);
$contactArray = getLandmarkContact($_GET['landmarkID']);
$ownerFullName = getUserFullName($contactArray['uid']);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>
    <?php echo $_SESSION['systemInfo']['short_name'] ?>
  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/booking.png" rel="icon">
  <link href="assets/img/booking.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets2/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets2/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets2/css/style.css" rel="stylesheet">
  <script src="js/jquery-1.10.2.min.js"></script>
  <link rel="stylesheet" href="lightBox/css/lightbox.min.css">
  <script src="lightBox/js/lightbox-plus-jquery.min.js"></script>

  <style type="text/css">
    #div {
      width: 100%;
      height: 60vh;
      background-color: #53A7E7;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      padding: 2vh;
    }
  </style>
</head>

<body>
  <?php
  //    ======= Header ======= 
  include_once('required/header.php');
  ?>

  <section class="p-2">
    <div class="align-items-top">
      <div class="col-lg-12">
        <div class="card" id="div" style="background-image: url('<?= $landmarkData['image'] ?>');">
        </div>
      </div>
    </div>
    <div class="section-title"><br><br>
      <h2><?= $landmarkData['landmarkName'] ?></h2>
      <h5>(<?= landmarkTypeSP($landmarkData['type']) ?>)</h5>
      <?php
      if ($landmarkData['haveBooking'] == 1) {
        if (isLoggedIn()) {
          echo '<div class="team section-bg p-2">
                <button class="btn btn-outline-primary" onclick="booking()"><i class="ri-phone-line"></i> Book Now</button>
              </div>';
        } else {
          echo '<div class="team section-bg p-2">
                <h5>You must be logged in to make a booking</h5>
              </div>';
        }
      }
      ?>
    </div>
  </section>

  </div>
  </section>

  <section id="team" class="team section-bg p-4">
    <div class="card">
      <div class="card-body">
        <!-- Bordered Tabs Justified -->
        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
          <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#Info" type="button" role="tab" aria-controls="home" aria-selected="true">About</button>
          </li>
          <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#Services" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Services</button>
          </li>
          <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Specifications" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Specifications</button>
          </li>
          <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Images" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Images</button>
          </li>
          <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Availability" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Availability</button>
          </li>
          <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Owner" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Responsible for reservations</button>
          </li>
        </ul>
        <div class="tab-content pt-2" id="borderedTabJustifiedContent">

          <div class="tab-pane fade active show" style="opacity: 1;" id="Info" role="tabpanel" aria-labelledby="home-tab">
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-12">
                  <div class="card-body">
                    <h5 class="card-title">
                      <h5 class="card-title">About</h5>
                      <p>
                        Place Name: <?= $landmarkData['landmarkName'] ?>
                      </p>

                      <p class="card-text" id="landmarkData">
                        Place Description: <?= $landmarkData['description'] ?>
                      </p>

                      <p class="card-text">
                        City: <?= getCityName($basicInformationArray['city']) ?>
                      </p>
                      <p class="card-text">
                        Area: <?= getAreaName($basicInformationArray['areaID']) ?>
                      </p>

                      <p class="card-text">
                        Booking:
                        <?php
                        $status =  $basicInformationArray['haveBooking'];

                        if ($status == 1) {
                          $status = 'Supports Booking';
                          $price = '<p class="card-text">Price: ' . $basicInformationArray['price'] . '</p>';
                        } else {
                          $status = 'Does Not Support Booking';
                        }

                        echo 'Booking Status: ' . $status;
                        echo @$price;
                        ?>
                      </p>

                      <p class="card-text">
                        Activity:
                        <?php
                        $activity =  $basicInformationArray['activity'];

                        if ($activity == 1) {
                          $activity = 'Active';
                        } else {
                          $activity = 'Inactive';
                        }

                        echo 'Status: ' . $activity;
                        ?>
                      </p>

                      <p class="card-text">
                        Data Added At: <?= $basicInformationArray['createdAt'] ?>
                      </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-12">
                  <div class="card-body">
                    <h5 class="card-title">
                      Location on Map
                    </h5>
                    <p class="card-text">
                      <iframe src="//maps.google.com/maps?q=<?php echo $basicInformationArray['longitude'] . ',' . $basicInformationArray['latitude'] ?>&z=15&output=embed" height="300" style="width:100%;border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </p>
                  </div>
                </div>
              </div>
            </div>


          </div>


          <div class="tab-pane fade" id="Services" role="tabpanel" aria-labelledby="home-tab">

            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-12">
                  <div class="card-body">
                    <h5 class="card-title">
                      Services
                    </h5>
                    <div class="card-text">
                      <?php
                      $servicesArray = AdminGetLandmarkServices($_GET['landmarkID']);
                      echo '<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Services</th>
      </tr>
    </thead>
    <tbody id="SpecificationAria">';
                      $count = 1;
                      foreach ($servicesArray as $key => $array) {
                        echo '
    <tr>
      <th scope="row">' . $count . '</th>
      <td>' . $array['serviceName'] . '</td>
    </tr>';
                        $count++;
                      }
                      echo '</tbody>
  </table>';
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="tab-pane fade" id="Specifications" role="tabpanel" aria-labelledby="home-tab">

            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-12">
                  <div class="card-body">
                    <h5 class="card-title">
                      Specifications
                    </h5>
                    <div class="card-text">

                      <?php
                      $SpecificationsArray = AdminGetSpecifications($_GET['landmarkID']);
                      echo '<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Specifications</th>
      </tr>
    </thead>
    <tbody id="SpecificationAria">';
                      $count = 1;
                      foreach ($SpecificationsArray as $key => $array) {
                        echo '
    <tr>
      <th scope="row">' . $count . '</th>
      <td>' . $array['specification'] . '</td>
    </tr>';
                        $count++;
                      }
                      echo '</tbody>
  </table>';
                      ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="tab-pane fade" id="Images" role="tabpanel" aria-labelledby="home-tab">
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-12">
                  <div class="card-body">
                    <h5 class="card-title">
                      Images
                    </h5>
                    <div class="card-text">
                      <div class="row">

                        <?php
                        $imageArray = AdminGetLandmarkImages($_GET['landmarkID']);
                        foreach ($imageArray as $key => $array) {
                          echo '<div class="col-md-4">
      <div class="thumbnail mt-4">
        <a href="' . $array['image'] . '" data-lightbox="example-1">
          <img src="' . $array['image'] . '" alt="Lights" style="width:10%; height: 1%;">
        </a>
      </div>
    </div>';
                        }
                        ?>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="tab-pane fade" id="Availability" role="tabpanel" aria-labelledby="home-tab">

            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-12">
                  <div class="card-body">
                    <h5 class="card-title">
                      Availability
                    </h5>
                    <div class="card-text">

                      <div class="form-group row p-2">
                        <label for="services" class="form-label col-2">From Day:</label>
                        <div class="col-4">
                          <p class="card-text">
                            <?= $availabilityArray['fromDay'] ?>
                          </p>
                        </div>
                      </div>

                      <div class="form-group row p-2">
                        <label for="services" class="form-label col-2">To Day:</label>
                        <div class="col-4">
                          <p class="card-text">
                            <?= $availabilityArray['toDay'] ?>
                          </p>
                        </div>
                      </div>

                      <div class="form-group row p-2">
                        <label for="services" class="form-label col-2">From Time:</label>
                        <div class="col-4">
                          <p class="card-text">
                            <?= $availabilityArray['atTime'] ?>
                          </p>
                        </div>
                      </div>

                      <div class="form-group row p-2">
                        <label for="services" class="form-label col-2">To Time:</label>
                        <div class="col-4">
                          <p class="card-text">
                            <?= $availabilityArray['toTime'] ?>
                          </p>
                        </div>
                      </div>

                      <div class="form-group row p-2">
                        <label for="services" class="form-label col-2">Exceptions:</label>
                        <div class="col-4">
                          <p class="card-text">
                            <?= $availabilityArray['exception'] ?>
                          </p>
                        </div>
                      </div>

                      <div class="form-group row p-2">
                        <label for="services" class="form-label col-2">Updated By:</label>
                        <div class="col-4">
                          <p class="card-text">
                            <?= $availabilityArray['updatedByName'] ?>
                          </p>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>


        <div class="tab-pane fade" style="opacity: 1;" id="Owner" role="tabpanel" aria-labelledby="home-tab">
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-12">
                <div class="card-body">
                  <h5 class="card-title">
                    Contact
                  </h5>
                  <p class="card-text">
                  <div class="form-group row p-2">
                    <label for="services" class="form-label col-2">Administrator:</label>
                    <div class="col-4">
                      <p class="card-text">
                        <?= $ownerFullName ?>
                      </p>
                    </div>
                  </div>

                  <div class="form-group row p-2">
                    <label for="services" class="form-label col-2">Administrator Phone:</label>
                    <div class="col-4">
                      <p class="card-text">
                        <?= $contactArray['phone'] ?>
                      </p>
                    </div>
                  </div>

                  <div class="form-group row p-2">
                    <label for="services" class="form-label col-2">WhatsApp Account:</label>
                    <div class="col-4">
                      <a title="Just Click" href="https://wa.me/<?= $contactArray['phone']; ?>" target="_blank">+970<?= $contactArray['phone']; ?></a>
                    </div>
                  </div>

                  <div class="form-group row p-2">
                    <label for="services" class="form-label col-2">Email:</label>
                    <div class="col-4">
                      <p class="card-text">
                        <?= $contactArray['email'] ?>
                      </p>
                    </div>
                  </div>

                  <div class="form-group row p-2">
                    <label for="services" class="form-label col-2">Joined At:</label>
                    <div class="col-4">
                      <p class="card-text">
                        <?= $contactArray['joinAt'] ?>
                      </p>
                    </div>
                  </div>

                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    </p>
    </div>
    </div>
    <div class="col-md-4">
      <a href="profile/<?php
                        echo $contactArray['image'];
                        ?>" data-lightbox="example-1">

        <img src="profile/<?php
                          echo $contactArray['image'];
                          ?>" class="img-fluid rounded-start" alt="..." style="width: 30%; height: 30%;" title="owner : <?= $ownerFullName ?>">
      </a>
    </div>

    </div>
    </div>
    </div>


    </div>

    </div>
    </div>

  </section>

  <section>
    <div class="col-lg-12 p-5">
      <form method="POST" id="comment_form">
        <div class="form-group">
          <input type="hidden" name="owner" id="owner" value="<?= @$landmarkData['owner'] ?>" />
          <input type="hidden" name="post_id" id="post_id" value="<?= $_GET['landmarkID'] ?>" />
        </div>
        <div class="form-group p-2">
          <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="4"></textarea>
        </div>
        <div class="form-group">
          <input type="hidden" name="comment_id" id="comment_id" value="0" />
          <?php
          if (isLoggedIn()) {
            echo '<input type="submit" name="submit" id="submit" class="btn btn-outline-primary" value="Comment" />';
          } else {
            echo '<input type="submit" class="btn btn-outline-success" value="You must be logged in to comment" disabled />';
          }
          ?>
        </div>
      </form>
      <br />
      <span id="comment_message"></span>
      <br />
      <div id="display_comment"></div>
    </div>
  </section>

  <?php
  include_once('toster/toster2.php');
  include_once('required/footer.php');
  ?>
  <!-- ======= Footer ======= -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <div class="modal fade" id="booking" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Booking:</h5>
        </div>
        <div class="modal-body">
          <form id="myform" enctype="multipart/form-data">

            <div class="col-12 p-2">

              <div class="container-fluid d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 row">


                  <div class="form-group col-6">
                    <label for="cc-number" class="control-label">Payment Method:</label>
                    <select class="input-lg form-control m-3" name="paymentMethods" id="paymentMethods">
                      <option value="null" selected="true" hidden>Select Payment</option>
                      <option value="0">Cash</option>
                      <option value="1">Credit/Debit Card</option>
                    </select>
                  </div>


                  <div class="form-group col-6">
                    <label for="cc-number" class="control-label">From:</label>
                    <input type="date" name="from" id="from" class="input-lg form-control m-3">
                  </div>



                  <div class="form-group col-6">
                    <label for="numeric" class="control-label">To:</label>
                    <input type="date" name="to" id="to" class="input-lg form-control m-3">
                  </div>

                  <div class="form-group col-6">
                    <label for="numeric" class="control-label">Note:</label>
                    <textarea class="input-lg form-control m-3" id="note" name="note"></textarea>
                  </div>


                  <div class="card m-2" id="visaForm">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-md-6">
                          <span>Credit/Debit Card</span>
                        </div>

                        <div class="col-md-6 text-right" style="margin-top: -5px;">
                          <img src="https://img.icons8.com/color/36/000000/visa.png">
                          <img src="https://img.icons8.com/color/36/000000/mastercard.png">
                          <img src="https://img.icons8.com/color/36/000000/amex.png">
                        </div>

                      </div>

                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="cc-number" class="control-label">Card Number:</label>
                        <input id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;" maxlength="16" required>
                      </div>

                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="cc-exp" class="control-label">Expiration Date:</label>
                            <input id="cc-exp" id="cardNumber" maxlength="5" type="tel" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="&bull;&bull; / &bull;&bull;" required>
                          </div>

                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="cc-cvc" class="control-label">CVV:</label>
                            <input id="cc-cvc" type="number" ng-model="number" onKeyPress="if(this.value.length==3) return false;" min="0" class="input-lg form-control cc-cvc" autocomplete="off" placeholder="&bull;&bull;&bull;" required>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-12">
                    <h5 name="priceCost" id="priceCost">Price per Day: <?= @$basicInformationArray['price'] ?> $ <br> Select the start and end date of the booking to display the total</h5>
                    <h5 name="diffDays" id="diffDays"></h5>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="bookNaw()" class="btn btn-outline-primary">Book Now</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets2/vendor/purecounter/purecounter.js"></script>
  <script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets2/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets2/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets2/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets2/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets2/js/main.js"></script>

</body>

</html>
<style>
  .mystyle {
    width: 100%;
    padding: 25px;
    background-color: coral;
    color: white;
    font-size: 25px;
    box-sizing: border-box;
  }
</style>

<script>
  var params = new window.URLSearchParams(window.location.search);
  commentId = params.get('commentId');


  if (typeof(commentId) != "undefined" && commentId !== null) {
    // $("id"+commentId).addClass("p-3 alert alert-secondary");

    jQuery('#id' + commentId).addClass('p-3 alert alert-secondary');

    window.location = "#id" + commentId;

    // var element = document.getElementById("myDIV");
    // element.classList.add("alert-secondary");



  }

  function booking() {
    $('#booking').modal('show');
  }

  load_comment();


  $('#comment_form').on('submit', function(event) {

    event.preventDefault();
    var form_data = $(this).serialize();
    $.ajax({
      url: "methods/comments/add_comment.php",
      method: "POST",
      data: form_data,
      dataType: "JSON",
      success: function(data) {
        load_comment();

        if (data.error != '') {
          $('#comment_form')[0].reset();
          $('#comment_message').html(data.error);
          $('#comment_id').val('0');

        }
      }
    })
  });




  function load_comment() {

    $.ajax({
      data: {
        'page_id': <?= $_GET['landmarkID'] ?>
      },
      url: "methods/comments/fetch_comment.php",
      method: "POST",
      success: function(data) {
        $('#display_comment').html(data);
      }
    })
  }
  /////////////////////// SET PARENT COMMENT VALUE  ///////////////////////

  $(document).on('click', '.reply', function() {
    var comment_id = $(this).attr("id");
    $('#comment_id').val(comment_id);
    $('#comment_content').focus();
  });


  /////////////////////////////  add ( - ) in expiration   ///////////////////////////////
  document.querySelector('.cc-exp').addEventListener('input', function(e) {
    var foo = this.value.split("-").join("");
    if (foo.length > 0) {
      foo = foo.match(new RegExp('.{1,2}', 'g')).join("-");
    }
    this.value = foo;
  });

  ////////////////////////////  Chik visa ////////////////////////////////

  function is_creditCard(str) {
    regexp = /^(?:(4[0-9]{12}(?:[0-9]{3})?)|(5[1-5][0-9]{14})|(6(?:011|5[0-9]{2})[0-9]{12})|(3[47][0-9]{13})|(3(?:0[0-5]|[68][0-9])[0-9]{11})|((?:2131|1800|35[0-9]{3})[0-9]{11}))$/;

    if (regexp.test(str)) {
      return true;
    } else {
      return false;

    }
  }

  $(function() {

    $("#to").on("change", function() {
      getCost();
    });
    $("#from").on("change", function() {
      getCost();
    });
  });


  function getCost() {
    var LandmarkPrice = 0 + <?= @$basicInformationArray['price']; ?>;
    var from = document.getElementById('from').value;
    var to = document.getElementById('to').value;

    const date1 = new Date(from);
    const date2 = new Date(to);
    const diffTime = Math.abs(date2 - date1);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    document.getElementById('priceCost').innerHTML = 'Total: ' + ((diffDays + 1) * LandmarkPrice) + ' $ ';
    document.getElementById('diffDays').innerHTML = 'Total Booking Days: ' + diffDays;
  }

  $("#visaForm").hide();

  $('#paymentMethods').on('change', function() {
    var paymentMethods = $(this).val();
    if (paymentMethods == 1) {
      $("#visaForm").show();
    } else {
      $("#visaForm").hide();
    }
  });


  function bookNaw() {
    var errors = 0;
    var paymentMethods = document.getElementById('paymentMethods').value;
    var from = document.getElementById('from').value;
    var to = document.getElementById('to').value;
    var note = document.getElementById('note').value;
    var LandmarkPrice = 0 + <?= @$basicInformationArray['price']; ?>;

    var fd = new FormData();

    if (paymentMethods == 1) {
      var cardNumber = document.getElementById('cc-number').value;
      var cardExpir = document.getElementById('cc-exp').value;
      var cardCVV = document.getElementById('cc-cvc').value;

      if (is_creditCard(cardNumber) == false) {
        CuteAlert('error', 'Error', 'Invalid card details');
        errors++;
      } else {
        if (cardExpir == '') {
          CuteAlert('error', 'Error', 'Please enter the card expiration date');
          errors++;
        } else {
          if (cardCVV == '') {
            CuteAlert('error', 'Error', 'Please enter the card CVV information');
            errors++;
          } else {
            fd.append('cardNumber', cardNumber);
            fd.append('cardExpir', cardExpir);
            fd.append('cardCVV', cardCVV);
          }
        }
      }
    }

    if (from == '') {
      CuteAlert('error', 'Error', 'Please select the start time of the booking');
      errors++;
    } else {
      if (to == '') {
        CuteAlert('error', 'Error', 'Please select the end time of the booking');
        errors++;
      } else {
        if (errors == 0) {
          const date1 = new Date(from);
          const date2 = new Date(to);
          const diffTime = Math.abs(date2 - date1);
          const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
          var total = ((diffDays + 1) * LandmarkPrice);

          fd.append('landmarkID', <?= $_GET['landmarkID'] ?>);
          fd.append('owner', <?= $landmarkData['owner'] ?>);
          fd.append('paymentMethods', paymentMethods);
          fd.append('from', from);
          fd.append('to', to);
          fd.append('note', note);
          fd.append('price', total);

          $.ajax({
            method: "POST",
            data: fd,
            contentType: false,
            processData: false,
            url: "methods/book.php",
            success: function(html) {
              CuteAlert('info', 'Information', 'Booking request has been successfully made');
              $("#booking").modal('hide');
            },
          });
        }
      }
    }
  }
</script>