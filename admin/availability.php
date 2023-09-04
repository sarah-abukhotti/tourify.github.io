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
          <center><h5 class="card-title">Availability</h5></center>
 
          <div class="panel panel-default">
    <div class="panel-heading"><b>Update Availability Data:</b></div>
    <br>
    <div class="panel-body">

      <form id="myform" enctype="multipart/form-data">

           <div class="form-group row">
              <label class="col-2 col-form-label">Place Name: </label>
            <div class="col-4">
                <select id="landmarkID" name="landmarkID" class="form-select" aria-label="Default select example">
                </select>
           </div>
                 
             <div class="form-group row p-2">
                  <label for="services" class="form-label col-2">From Day: </label>
                   &nbsp;  <div class="col-4">
                                 <select id="fromDay" name="fromDay" class="form-select" aria-label="Default select example">
                                      <option value="0" selected="true"   hidden>Select Day: </option> 
                                      <option value="Saturday" >Saturday</option> 
                                      <option value="Sunday" >Sunday</option> 
                                      <option value="Monday" >Monday</option> 
                                      <option value="Tuesday" >Tuesday</option> 
                                      <option value="Wednesday" >Wednesday</option> 
                                      <option value="Thursday" >Thursday</option> 
                                      <option value="Friday" >Friday</option> 
                                </select>
                     </div>
              </div>

                <div class="form-group row p-2">
                  <label for="services" class="form-label col-2">To Day: </label>
                   &nbsp;  <div class="col-4">
                           <select id="toDay" name="toDay" class="form-select" aria-label="Default select example">
                                      <option value="0" selected="true"   hidden>Select Day: </option> 
                                      <option value="Saturday" >Saturday</option> 
                                      <option value="Sunday" >Sunday</option> 
                                      <option value="Monday" >Monday</option> 
                                      <option value="Tuesday" >Tuesday</option> 
                                      <option value="Wednesday" >Wednesday</option> 
                                      <option value="Thursday" >Thursday</option> 
                                      <option value="Friday" >Friday</option> 
                                </select>
                    </div>
              </div>


                <div class="form-group row p-2">
                  <label for="services" class="form-label col-2">From Time: </label>
                   &nbsp;  <div class="col-4">
                         <input type="time" class="form-control" name="atTime" id="atTime">
                    </div>
              </div>

                <div class="form-group row p-2">
                  <label for="services" class="form-label col-2">To Time: </label>
                   &nbsp;  <div class="col-4">
                         <input type="time" class="form-control" name="toTime" id="toTime">
                    </div>
              </div>

                <div class="form-group row p-2">
                  <label for="services" class="form-label col-2">Exception: </label>
                   &nbsp;  <div class="col-4">
                        <textarea class="form-control" rows="3" name="exception" id="exception"></textarea>
                    </div>
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
            var fromDay =document.getElementById("fromDay").value;
            var toDay =document.getElementById("toDay").value;
            var atTime =document.getElementById("atTime").value;
            var toTime =document.getElementById("toTime").value;
            var exception =document.getElementById("exception").value;
  
            if (landmarkID == '0') {
            CuteAleart('error',' Error ',' Place name is required');
            }else{

            if (fromDay == '') {
              CuteAleart('error','   Error     ',' From day is required');
            }else{

            if (toDay == '') {
                  CuteAleart('error','   Error     ',' To day is required');
            }else{

            if (atTime == '') {
                  CuteAleart('error','   Error     ',' From time is required');
            }else{

            if (toTime == '') {
                  CuteAleart('error','   Error     ',' To time is required');
            }else{


            var fd = new FormData();


                fd.append('landmarkID',landmarkID);
                fd.append('fromDay',fromDay);
                fd.append('toDay',toDay);
                fd.append('atTime',atTime);
                fd.append('toTime',toTime);
                fd.append('exception',exception);
 
                $.ajax({
                  url:'methods/availability.php',
                  type:'post',
                  data: fd ,
                  contentType: false,
                  processData: false,
                  success:function(response){
                    Swal.fire(
                      'Information!',
                      'Availability Updated successful ',
                      'success'
                             )
                      $("#myform")[0].reset()
 
                      }
                   });  
                  }
               }
          }
        }
      }
  }

  </script>
</body>
</html>
             