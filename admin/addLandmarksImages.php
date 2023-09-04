<?php
include_once('..\required/server.php');
include_once("required/head.php");
if (!isLoggedIn()) {
  header('location: ..\login.php');
}
if ($_SESSION['user']['type'] != 1) {
  header('location: ..\index.php');
}
?>

<body>
  <?php
  include_once("required/header.php");
  include_once("required/sidebar.php");
  ?>
  <main id="main" class="main" dir=ltr>
    <div class="pagetitle">
      <h1> <?php echo $_SESSION['systemInfo']['name'] . ' (' . $_SESSION['systemInfo']['short_name'] . ')'; ?></h1>

    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Images to Places</h5>

              <div class="panel panel-default">
                <div class="panel-heading"><b>Add New Images for the Place:</b></div>
                <br>
                <div class="panel-body">

                  <form id="myform" enctype="multipart/form-data">

                    <div class="form-group row p-2">
                      <label class="col-sm-2 col-form-label">Place Name: </label>
                      <div class="col-sm-10">
                        <select id="landmarkID" name="landmarkID" class="form-select" aria-label="Default select example">
                        </select>
                      </div>

                      <div class="form-group p-2">
                        <label for="services" class="form-label">Images (as Text):</label>
                        <textarea class="form-control" id="image" name="image" rows="4"></textarea>
                      </div>


                      <div class="form-group p-3">
                        <center>
                          <input type="button" onclick="save()" class="btn btn-outline-primary" name="add" value="Save">
                        </center>
                      </div>
                  </form>


                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- ======= Footer ======= -->
  <?php
  include_once("required/footer.php");
  include_once('..\toster/toster.php');
  ?>
  <script type="text/javascript">
    function getlandmarksID() {
      $.ajax({
        type: "POST",
        datatype: 'json',
        url: "methods/landmarkID.php",
        success: function(data) {
          $("#landmarkID").html(data);
        },
      });
    }
    getlandmarksID();

    function save() {
    var landmarkID = document.getElementById("landmarkID").value;
    var imageText = document.getElementById('image').value;

    if (landmarkID == '0') {
        CuteAleart('error', 'Error', 'Place name is required');
    } else {
        if (imageText.trim() === '') {
            CuteAleart('error', 'Error', 'Enter the image URLs as text');
        } else {
            var formData = new FormData();
            formData.append('landmarkID', landmarkID);
            formData.append('imageText', imageText);

            $.ajax({
                url: 'methods/addImages.php',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire(
                        'Info',
                        'Images added successfully',
                        'success'
                    );
                    $("#myform")[0].reset();
                },
                error: function (xhr, status, error) {
                    Swal.fire('Error', 'An error occurred while saving the place.', 'error');
                }
            });
        }
    }
}

  </script>
</body>

</html>