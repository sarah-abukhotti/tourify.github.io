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
          <center><h5 class="card-title">Place Services</h5></center>
          <div class="panel panel-default">
    <div class="panel-heading"><b>Add New Services for the Place:</b></div>
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
                  <label for="services" class="form-label">Place Services: </label>
                  <textarea class="form-control" name="services" id="services"></textarea>
             </div>


            <div class="form-group p-3">
               <center>
                  <input type="button" onclick="save()"  class="btn btn-outline-primary" name="add" value="Save">
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
        var services =document.getElementById("services").value;

        if (landmarkID == '0') {
             CuteAleart('error','   Error  ',' Place Name is required');
        }else{

        if (services == '') {
              CuteAleart('error','   Error  ',' Service Name is required');
        }else{


            var fd = new FormData();

            fd.append('landmarkID',landmarkID);
            fd.append('services',services);

            $.ajax({
              url:'methods/addServices.php',
              type:'post',
              data: fd  ,
              contentType: false,
              processData: false,
              success:function(response){
                Swal.fire(
                  'Information',
                  'Service added successfully',
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
             