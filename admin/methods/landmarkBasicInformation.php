<?php
include_once('..\..\required/server.php');
include_once('..\..\required/AdminFunctions.php');
$basicInformationArray = AdminGetlandmarkID($_GET['landmarkID']);
$availabilityArray = AdminGetLandmarkAvailability($_GET['landmarkID']);

?>
<div class="card mb-3">
   <div class="row g-0">
      <div class="col-md-8">
         <div class="card-body">
            <h5 class="card-title">

               <?php
               echo $basicInformationArray['landmarkName'];
               ?>
            </h5>
            <p class="card-text"> <?php
                                    echo $basicInformationArray['description'];
                                    ?></p>
         </div>
      </div>
      <div class="col-md-4">
         <a href="<?php
                  echo $basicInformationArray['image'];
                  ?>" data-lightbox="example-1">
            <img src="<?php
                        echo $basicInformationArray['image'];
                        ?>" class="img-fluid rounded-start" alt="..." title="landmark : <?php echo $basicInformationArray['landmarkName']; ?>"> </a>
         <h5 class="text-center"><?php echo $basicInformationArray['landmarkName']; ?></h5>
      </div>
   </div>
</div>

<div class="card mb-3">
   <div class="row g-0">
      <div class="col-md-12">
         <div class="card-body">
            <h5 class="card-title">Google Maps</h5>
            <p class="card-text">
               <iframe src="//maps.google.com/maps?q=<?php echo $basicInformationArray['longitude'] . ',' . $basicInformationArray['latitude'] ?>&z=15&output=embed" height="300" style="width:100% ;border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </p>
         </div>
      </div>
   </div>
</div>

<div class="card mb-3">
   <div class="row g-0">
      <div class="col-md-8">
         <div class="card-body">
            <h5 class="card-title">About</h5>
            <p class="card-text">
               <?php echo 'Administrator: ' . getUserFullName($basicInformationArray['owner']); ?>
            </p>
            <p class="card-text"><?= 'Price per Day: ' . $basicInformationArray['price'] ?></p>
            <p class="card-text">
               <?php echo 'City: ' . getCityName($basicInformationArray['city']); ?>
            </p>
            <p class="card-text">
               <?php echo 'Area: ' . getAreaName($basicInformationArray['areaID']); ?>
            </p>
            <p class="card-text">
               <?php
               $status =  $basicInformationArray['haveBooking'];
               if ($status == 1) {
                  $status = 'Supported';
               } else {
                  $status = 'Not Supported';
               }
               echo 'Booking System: ' . $status;
               ?>
            </p>
            <p class="card-text">
               <?php
               $activity =  $basicInformationArray['activity'];
               if ($activity == 1) {
                  $activity = 'Active';
               } else {
                  $activity = 'Inactive';
               }
               echo 'Activity Status: ' . $activity;
               ?>
            </p>
            <p class="card-text">
               <?php echo 'Created At: ' . $basicInformationArray['createdAt']; ?>
            </p>
         </div>
      </div>
   </div>
</div>



<div class="modal-content">
   <div class="modal-header">
      <h5 class="modal-title">Edit Basic Information:</h5>
   </div>
   <div class="modal-body">
      <form id="myform" enctype="multipart/form-data">
         <div class="form-group row p-2">
            <label for="inputNanme4" class="col-sm-3 form-label">Administrator:</label>
            <div class="col-sm-9">
               <select class="form-control" id="owner" name="owner"></select>
            </div>
         </div>
         <div class="form-group row p-2">
            <label for="inputNanme4" class="col-sm-3 form-label">Place Name:</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" id="landmarkName" name="landmarkName" value="<?php echo $basicInformationArray['landmarkName']; ?>">
            </div>
         </div>
         <div class="form-group row p-2">
            <label class="col-sm-3 col-form-label">Place Type:</label>
            <div class="col-sm-9">
               <select id="type" name="type" class="form-select" aria-label="Default select example"></select>
            </div>
         </div>
         <div class="form-group row p-2">
            <label for="description" class="form-label">Place Description:</label>
            <textarea class="form-select" id="default"><?php echo $basicInformationArray['description']; ?></textarea>
         </div>
         <div class="form-group row p-2">
            <label for="longitude" class="col-sm-2 form-label">Longitude:</label>
            <div class="col-sm-4">
               <input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo $basicInformationArray['longitude']; ?>">
            </div>
            <label for="longitude" class="col-sm-2 form-label">Latitude:</label>
            <div class="col-sm-4">
               <input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo $basicInformationArray['latitude']; ?>">
            </div>
         </div>
         <div class="form-group row p-2">
            <label for="haveBooking" class="col-sm-2 form-label">Booking Availability:</label>
            <div class="col-sm-4">
               <select id="haveBooking" name="haveBooking" class="form-select" aria-label="Default select example">
                  <?php
                  if ($basicInformationArray['haveBooking'] == 1) {
                     echo '<option value="1" selected>Yes</option>
                                 <option value="0">No</option>';
                  } elseif ($basicInformationArray['haveBooking'] == 0) {
                     echo '<option value="1">Yes</option>
                                 <option value="0" selected>No</option>';
                  }
                  ?>
               </select>
            </div>
            <label for="activity" class="col-sm-2 form-label">Activity Status:</label>
            <div class="col-sm-4">
               <select id="activity" name="activity" class="form-select" aria-label="Default select example">
                  <?php
                  if ($basicInformationArray['activity'] == 1) {
                     echo '<option value="1" selected>Active</option>
                                 <option value="0">Inactive</option>';
                  } elseif ($basicInformationArray['activity'] == 0) {
                     echo '<option value="1">Active</option>
                                 <option value="0" selected>Inactive</option>';
                  }
                  ?>
               </select>
            </div>
         </div>
         <div class="form-group row p-2">
            <label for="city" class="col-sm-2 form-label">City:</label>
            <div class="col-sm-4">
               <select id="city" name="city" class="form-select" aria-label="Default select example"></select>
            </div>
            <label for="area" class="col-sm-2 form-label">Area:</label>
            <div class="col-sm-4">
               <select id="area" name="area" class="form-select" aria-label="Default select example">
                  <option value="0" selected="true" hidden>Select Area:</option>
               </select>
            </div>
         </div>
         <div class="form-group row p-2">
            <label class="form-label col-sm-2">Main Image:</label>
            <div class="col-sm-4">
               <!-- The existing image URL will be displayed here as a clickable link -->
               <input type="text" class="form-control" id="image" name="image" value="<?= $basicInformationArray['image'] ?>">
            </div>
            <label class="form-label col-sm-2">Price per Day ($):</label>
            <div class="col-sm-4">
               <input type="text" class="form-control" id="price" name="price" value="<?= $basicInformationArray['price'] ?>">
            </div>
         </div>
      </form>
   </div>
   <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" onclick="save()" class="btn btn-outline-primary">Save Changes</button>
   </div>
</div>



<script type="text/javascript">
   function getTypes() {
      $.ajax({
         type: "GET",
         datatype: 'json',
         data: {
            'id': <?= $basicInformationArray['type'] ?>
         },
         url: "methods/landmarkTypes.php",
         success: function(data) {
            $("#type").html(data);
         },
      });
   }
   getTypes();

   function getCitys() {
      $.ajax({
         type: "GET",
         datatype: 'json',
         data: {
            'id': <?= $basicInformationArray['city'] ?>
         },
         url: "methods/getCitys.php",
         success: function(data) {
            $("#city").html(data);
         },
      });
   }
   getCitys();

   function getAreas() {
      $.ajax({
         type: "GET",
         datatype: 'json',
         data: {
            'areaID': <?= $basicInformationArray['areaID'] ?>
         },
         url: "methods/getAreas.php",
         success: function(data) {
            $("#area").html(data);
         },
      });
   }
   getAreas();


   function getOwnerUsers() {
      $.ajax({
         type: "GET",
         datatype: 'json',
         data: {
            'owner': <?= $basicInformationArray['owner'] ?>
         },
         url: "methods/landmarkOwnerUsers.php",
         success: function(data) {
            $("#owner").html(data);
         },
      });
   }
   getOwnerUsers();


   $('#city').on('change', function() {
      var city = $(this).val();

      $.ajax({
         type: "GET",
         data: {
            'city': city
         },
         datatype: 'json',
         url: "methods/getAreas.php",
         success: function(data) {
            $("#area").html(data);
         },
      });

   });


   function save() {
      var owner = document.getElementById("owner").value;
      var landmarkName = document.getElementById("landmarkName").value;
      var type = document.getElementById("type").value;
      var latitude = document.getElementById("latitude").value;
      var longitude = document.getElementById("longitude").value;
      var city = document.getElementById("city").value;
      var area = document.getElementById("area").value;
      var image = document.getElementById("image").value;
      var haveBooking = document.getElementById("haveBooking").value;
      var description = tinyMCE.get('default').getContent();
      var activity = document.getElementById("activity").value;
      var price = document.getElementById("price").value;
      // var files = $('#image')[0].files;
      if (owner == '0') {
         CuteAleart('error', 'Error', 'Owner name is required');
      } else if (landmarkName == '') {
         CuteAleart('error', 'Error', 'Place name is required');
      } else if (type == '0') {
         CuteAleart('error', 'Error', 'Place type is required');
      } else if (description == '') {
         CuteAleart('error', 'Error', 'Place description is required');
      } else if (longitude == '') {
         CuteAleart('error', 'Error', 'Longitude is required');
      } else if (latitude == '') {
         CuteAleart('error', 'Error', 'Latitude is required');
      } else if (city == '0') {
         CuteAleart('error', 'Error', 'City is required');
      } else if (area == '0') {
         CuteAleart('error', 'Error', 'Area is required');
      } else if (haveBooking == 'null') {
         CuteAleart('error', 'Error', 'Is booking available?');
      } else if (activity == 'null') {
         CuteAleart('error', 'Error', 'Is the place active?');
      } else if (image == '') {
         CuteAleart('error', 'Error', 'Main image is required');
      } else {
         var fd = new FormData();
         fd.append('landmarkID', <?php echo $_GET['landmarkID']; ?>);
         fd.append('file', files[0]);
         fd.append('owner', owner);
         fd.append('landmarkName', landmarkName);
         fd.append('type', type);
         fd.append('description', description);
         fd.append('longitude', longitude);
         fd.append('latitude', latitude);
         fd.append('city', city);
         fd.append('area', area);
         fd.append('haveBooking', haveBooking);
         fd.append('activity', activity);
         fd.append('price', price);
         fd.append('image', image);

         $.ajax({
            url: 'methods/updateLandmark.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
               $('#basicInformationModel').modal('hide');
               getlandmarkBasicInformation();
               Swal.fire(
                  'Information',
                  'Landmark data has been successfully updated',
                  'success'
               )
            }
         });
      }
   }
</script>