<?php
include_once('..\required/server.php');
include_once('..\required/AdminFunctions.php');
include_once("required/head.php");
if (!isLoggedIn()) {
  header('location: ..\login.php');
}
if ($_SESSION['user']['type'] != 1) {
  header('location: ..\index.php');
}

$basicInformationArray = AdminGetlandmarkID($_GET['landmarkID']);
$servicesArray = AdminGetLandmarkServices($_GET['landmarkID']);
$availabilityArray = AdminGetLandmarkAvailability($_GET['landmarkID']);
$contactArray = getLandmarkContact($_GET['landmarkID']);
$ownerFullName = getUserFullName($contactArray['uid']);
?>

<body>
  <?php
  include_once("required/header.php");
  include_once("required/sidebar.php");
  ?>

  <style>
    /* تنسيق حقول الجدول */
    .contact-field {
      background-color: #f8f9fa;
      /* خلفية لون فاتح */
      padding: 10px;
    }

    /* تنسيق النصوص */
    .small-text {
      font-size: 0.7rem;
      /* حجم النص الصغير */
    }

    /* تنسيق الصورة */
    .contact-image {
      max-width: 150px;
      /* حجم أقصى للصورة */
    }
  </style>

  <link rel="stylesheet" type="text/css" href="..\css/images.css">
  <link rel="stylesheet" href="..\lightBox/css/lightbox.min.css">
  <script src="..\lightBox/js/lightbox-plus-jquery.min.js"></script>

  <main id="main" class="main" dir=ltr>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Place Details</h5>

              <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">

                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#basicInformation" type="button" role="tab" aria-controls="home" aria-selected="true">Basic Information</button>
                </li>

                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#Specifications" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Specifications</button>
                </li>

                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#services" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Services</button>
                </li>


                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 " id="profile-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="profile" aria-selected="true">Images</button>
                </li>


                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 " id="profile-tab" data-bs-toggle="tab" data-bs-target="#availability" type="button" role="tab" aria-controls="profile" aria-selected="true">Availability</button>
                </li>

                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 " id="profile-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="profile" aria-selected="true">Contact</button>
                </li>

              </ul>

              <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                <div class="tab-pane fade show active" id="basicInformation" role="tabpanel" aria-labelledby="home-tab">

                </div>
                <div class="tab-pane fade" id="Specifications" role="tabpanel" aria-labelledby="profile-tab">

                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">
                            Specifications
                          </h5>
                          <div class="card-text" id="SpecificationAria">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <a href="<?php echo $basicInformationArray['image']; ?>" data-lightbox="example-1">

                          <img src="<?php echo $basicInformationArray['image']; ?>" class="img-fluid rounded-start" alt="..." title="owner: <?php echo $basicInformationArray['landmarkName']; ?>">

                        </a>
                        <h5 class="text-center"><?php echo $basicInformationArray['landmarkName']; ?></h5>
                      </div>

                      <div class="col-md-6 p-3" dir="ltr">
                        <button type="button" class="btn btn-outline-primary m-2" onclick="redirectToAddLandmarksSpecifications()">
                          Add
                        </button>
                      </div>

                    </div>
                  </div>

                </div>
                <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="contact-tab">

                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">
                            Services
                          </h5>
                          <div class="card-text" id="ServicesAria">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <a href="<?php echo $basicInformationArray['image']; ?>" data-lightbox="example-1">

                          <img src="<?php echo $basicInformationArray['image']; ?>" class="img-fluid rounded-start" alt="..." title="owner: <?php echo $basicInformationArray['landmarkName']; ?>">

                        </a>
                        <h5 class="text-center"><?php echo $basicInformationArray['landmarkName']; ?></h5>
                      </div>

                      <div class="col-md-6 p-3" dir="ltr">
                        <button type="button" class="btn btn-outline-primary m-2" onclick="redirectToAddLandmarksServices()">
                          Add
                        </button>
                      </div>

                    </div>
                  </div>

                </div>

                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="contact-tab">

                  <div class="card mb-3">
                    <div class="row g-0">

                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">
                            Images
                          </h5>

                        </div>
                      </div>

                      <div class="col-md-4 p-3" dir="ltr">
                        <button type="button" class="btn btn-outline-primary m-2" onclick="redirectToAddLandmarksImagesPage()">
                          Add
                        </button>
                      </div>

                      <div class="row col-12" id="imagesAria"></div>

                    </div>
                  </div>

                </div>

                <div class="tab-pane fade" id="availability" role="tabpanel" aria-labelledby="contact-tab">

                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">
                            Availability
                          </h5>
                          <div id="availabilityAria"></div>


                        </div>
                      </div>

                      <div class="col-md-4">
                        <a href="<?php echo $basicInformationArray['image']; ?>" data-lightbox="example-1">

                          <img src="<?php echo $basicInformationArray['image']; ?>" class="img-fluid rounded-start" alt="..." title="owner: <?php echo $basicInformationArray['landmarkName']; ?>">

                        </a>
                        <h5 class="text-center"><?php echo $basicInformationArray['landmarkName']; ?></h5>
                      </div>

                      <div class="col-md-6 p-3" dir="rtl">
                        <button type="button" class="btn btn-outline-primary m-2" onclick="redirectToAddLandmarksAvailability()">
                          Update
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="card mb-2">
                    <div class="row g-0">
                      <div class="col-md-10">
                        <div class="card-body">
                          <h5 class="card-title">Contact Information</h5>

                          <!-- حقول البيانات -->
                          <div class="form-group row p-1 contact-field">
                            <label for="services" class="form-label col-2">Administrator</label>
                            <div class="col-4">
                              <p class="card-text">
                                <?php echo $ownerFullName; ?>
                              </p>
                            </div>
                          </div>

                          <div class="form-group row p-2 contact-field">
                            <label for="services" class="form-label col-2">Phone</label>
                            <div class="col-4">
                              <p class="card-text">
                                <?php echo $contactArray['phone']; ?>
                              </p>
                            </div>
                          </div>

                          <div class="form-group row p-2 contact-field">
                            <label for="services" class="form-label col-2">Email</label>
                            <div class="col-4">
                              <p class="card-text">
                                <?php echo $contactArray['email']; ?>
                              </p>
                            </div>
                          </div>

                          <div class="form-group row p-2 contact-field">
                            <label for="services" class="form-label col-2">Join Date</label>
                            <div class="col-4">
                              <p class="card-text">
                                <?php echo $contactArray['joinAt']; ?>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- الصورة بجوار الجدول -->
                      <div class="col-md-2" style="margin-top: 100px;">
                        <a href="../profile/<?php echo $contactArray['image']; ?>" data-lightbox="example-1">
                          <img src="../profile/<?php echo $contactArray['image']; ?>" class="img-fluid rounded-start contact-image" alt="..." title="owner: <?php echo $basicInformationArray['landmarkName']; ?>">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>


    </section>
  </main>

  <!-- ======= Footer ======= -->
  <?php
  //include_once("../owner/methods/popUpMenus.php");
  include_once("required/footer.php");
  include_once('..\toster/toster.php');
  ?>

</body>

</html>
<script type="text/javascript">
  function getlandmarkBasicInformation() {
    $.ajax({
      type: 'GET',
      data: {
        'landmarkID': <?php echo $_GET['landmarkID']; ?>
      },
      url: "methods/landmarkBasicInformation.php",
      success: function(data) {
        $("#basicInformation").html(data);
      },
    });
  }
  getlandmarkBasicInformation();

  function getSpecification() {
    $.ajax({
      type: 'get',
      data: {
        'landmarkID': <?php echo $_GET['landmarkID']; ?>
      },
      url: "methods/getSpecifications.php",
      success: function(data) {
        $("#SpecificationAria").html(data);
      },
    });
  }
  getSpecification();


  function getServices() {
    $.ajax({
      type: 'get',
      data: {
        'landmarkID': <?php echo $_GET['landmarkID']; ?>
      },
      url: "methods/getServicess.php",
      success: function(data) {
        $("#ServicesAria").html(data);
      },
    });
  }

  getServices();


  function getimages() {
    $.ajax({
      type: 'GET',
      data: {
        'landmarkID': <?php echo $_GET['landmarkID']; ?>
      },
      url: "methods/getImges.php",
      success: function(data) {
        $("#imagesAria").html(data);
      },
    });
  }
  getimages();


  function getAvailability() {
    $.ajax({
      type: 'GET',
      data: {
        'landmarkID': <?php echo $_GET['landmarkID']; ?>
      },
      url: "methods/getAvailability.php",
      success: function(data) {
        $("#availabilityAria").html(data);
      },
    });
  }
  getAvailability();



  function deleteData(controll) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to see this after the process!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'methods/removeSpecification.php',
          type: 'post',
          data: {
            'controll': controll
          },
          success: function(response) {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'The item has been deleted successfully.',
              'success'
            )
            getSpecification();
          }
        });

      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          'The deletion process has been cancelled.',
          'error'
        )
      }
    })
  }

  function deleteDataService(controll) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to see this after the process!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'methods/removeService.php',
          type: 'post',
          data: {
            'controll': controll
          },
          success: function(response) {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'The item has been deleted successfully.',
              'success'
            )
            getServices();
          }
        });

      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          'The deletion process has been cancelled.',
          'error'
        )
      }
    })
  }

  function deleteImage(controll) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to see this after the process!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'methods/removeImage.php',
          type: 'post',
          data: {
            'controll': controll
          },
          success: function(response) {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'The item has been deleted successfully.',
              'success'
            )
            getimages();
          }
        });

      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          'The deletion process has been cancelled.',
          'error'
        )
      }
    })
  }
</script>

<script>
  // استدعاء دالة لتحويل المستخدم عند الضغط على الزر "Add"
  function redirectToAddLandmarksImagesPage() {
    window.location.href = "addLandmarksImages.php";
  }

  function redirectToAddLandmarksSpecifications() {
    window.location.href = "specification.php";
  }

  function redirectToAddLandmarksServices() {
    window.location.href = "addServices.php";
  }
  function redirectToAddLandmarksAvailability() {
    window.location.href = "availability.php";
  }
</script>


<script src='../js/tinymce.min.js'></script>
<script src="../js/script.js"></script>