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
  <link rel="stylesheet" type="text/css" href="..\css/images.css">
  <main id="main" class="main" dir="ltr">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          <div class="card-body">
              <center><h5 class="card-title">Areas</h5></center>
              <div class="panel panel-default">
                <div class="panel-heading"><b> Manage Areas: </b></div>
                <br>
                <div class="panel-body">
                  <div class="container">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-md-9">Areas List</div>
                        <div class="col-md-3" align="left">
                          <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal"
                            data-bs-target="#Landmarks_area">
                            Add
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="landmarkTypes">
                    </div>
                    <div class="modal fade" id="Landmarks_area" tabindex="-1" aria-hidden="true"
                      style="display: none;">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Add Area:</h5>

                            </div>
                          <div class="modal-body">
                            <form id="myform" enctype="multipart/form-data">
                              <div class="col-12  p-2">
                                <label for="inputNanme4" class="form-label">Area Name: </label>
                                <input type="text" class="form-control" id="name" name="name">
                              </div>

                              <div class="col-12  p-2">
                                <label for="inputNanme4" class="form-label">City: </label>
                                    <select id="city" name="city" class="form-select" aria-label="Default select example">
                                    </select>
                              </div>

                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="save()" class="btn btn-outline-primary">Add</button>
                          </div>

                        </div>
                      </div>
                    </div>
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
 include_once("../toster/toster.php");
  ?>
</body>

</html>


<script type="text/javascript">

  function getCityAreas() {
    $.ajax({
      type: "POST",
      datatype: 'json',
      url: "methods/getAreasData.php",
      success: function (data) {
        $("#landmarkTypes").html(data);
      },
    });
  }

  getCityAreas();

    function getCitys(){
      $.ajax({
        type: "POST",
        datatype: 'json',
        url:"methods/getCitys.php", 
         success:function(data){  
              $("#city").html(data); 
                 },
             });
          }
  getCitys();
 
  function deleteDataArea(id) {

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
    title: 'Are you sure?',
    text: "You won't be able to see this after the action!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete!',
    cancelButtonText: 'No, cancel',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: 'methods/removeArea.php',
        type: 'post',
        data: { 'id': id },
        success: function (response) {
          swalWithBootstrapButtons.fire(
            'Deletion',
            'The item has been successfully deleted.',
            'success'
          )

            getCityAreas();

          }
        });

      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          'Your item is safe :)',
          'error'
        )
      }
    })
  }



function save(){
       var name =document.getElementById("name").value;
       var city =document.getElementById("city").value;
 
          if (name == '') {
          CuteAleart('error', 'Error', 'Area name is required');
        } else {
          if (city == '0') {
            CuteAleart('error', 'Error', 'City is required');
          } else {


        $.ajax({
          url:'methods/addArea.php',
          type:'post',
          data: {'name' : name ,
                 'city' : city}  ,
         success:function(response){
              Swal.fire(
                'Message',
                'Area added successfully',
                'success'
              )
              $("#myform")[0].reset();
              $('#Landmarks_area').modal('hide');
               getCityAreas();

                }
             });  
            }
          }
   }


</script>