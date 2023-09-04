<?php 
include_once('..\required/server.php'); 
include_once("required/head.php");
if (!isLoggedIn()) {
     header('location: ..\login.php');
  }
if ($_SESSION['user']['type'] != 1 ) {
      header('location: ..\index.php');
}
?>
 
 <body>
  <?php
      include_once("required/header.php");
      include_once("required/sidebar.php");
  ?>
<main id="main" class="main" dir=ltr>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
        <center> <h5 class="card-title">Place Specifications</h5></center>

<div class="panel panel-default">
  <div class="panel-heading"><b>Add New Specifications for the Place:</b></div>
  <br>
  <div class="panel-body">

    <form id="myform" enctype="multipart/form-data">

         <div class="form-group row p-2">
            <label class="col-sm-2 col-form-label">Place Name:</label>
          <div class="col-sm-10">
              <select id="landmarkID" name="landmarkID" class="form-select" aria-label="Default select example">
              </select>
         </div>

           <div class="form-group p-2">
                <label for="specification" class="form-label">Place Description:</label>
                <textarea class="form-control" name="specification" id="specification"></textarea>
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

        function getlandmarksID(){
            $.ajax({
              type: "POST",
              datatype: 'json',
              url:"methods/landmarkID.php", 
               success:function(data){  
                    $("#landmarkID").html(data); 
                       },
                   });
                }
        getlandmarksID();

      function save(){
            var landmarkID =document.getElementById("landmarkID").value;
            var specification =document.getElementById("specification").value;
  
            if (landmarkID == '0') {
            CuteAleart('error', 'Error', 'Place name is required');
            } else {
            if (specification == '') {
            CuteAleart('error', 'Error', 'Place description is required');
            } else {
            var fd = new FormData();

            fd.append('landmarkID', landmarkID);
            fd.append('specification', specification);

            $.ajax({
                url: 'methods/addSpecification.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire(
                        'Information',
                        'Place specification added successfully',
                        'success'
                          )
                     $("#myform")[0].reset()
 
                      }
                   });  
                  }
               }
          }

  </script>
</body>
</html>
             