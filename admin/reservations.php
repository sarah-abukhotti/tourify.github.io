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

  <main id="main" class="main" dir=ltr>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
            <center><h5 class="card-title"> <?php echo 'Reservations in '.$_SESSION['systemInfo']['short_name'] ?>  <h5><center>
              <div class="panel panel-default">
              <div class="panel-heading"><b>Reservation Management: </b></div>
                <br>
                <div class="panel-body">
                  <div class="container">
      
                    <div class="row" id="result">
                    </div>
                     <div class="row" id="ReservData">
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

  function getReservData() {
    $.ajax({
      type: "POST",
      datatype: 'json',
      url: "methods/getUserReservations.php",
      success: function (data) {
        $("#ReservData").html(data);
      },
    });
  }

  getReservData();
 
  function deleteResrvation(controll) {

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to see this reservation!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
      }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
      url: 'methods/removeReservData.php',
      type: 'post',
      data: { 'controll': controll },
      success: function (response) {
      swalWithBootstrapButtons.fire(
      'Deleted!',
      'The reservation has been successfully deleted.',
      'success'
      )
            getReservData();

          }
        });

      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancel',
      ':) The operation has been canceled',
      'error'
    )
  }
})
}

function info(id){
$.ajax({
url:"methods/reservationModel.php",
method:"POST",
data:{'id':id},
success:function(data){

    $('#result').html(data);
    $('#reservationModel').modal('show');

    }});
}
function accept(controll) {


const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
title: 'Are you sure?',
  text: "You won't be able to make changes after approval",
  icon: 'warning',
  showCancelButton: true,
 confirmButtonText: 'Yes, approve!',
cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url:"methods/updateResrvationStatus.php", 
      type: 'post',
      data: { 'controll': controll },
      success: function (response) {
        $('#reservationModel').modal('hide');

        swalWithBootstrapButtons.fire(
          'Reservation Approved!',
          'The reservation has been approved.',
          'success'
        )
        getReservData();

      }
    });

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Canceled',
      ':) The reservation request has been canceled',
      'error'
    )
  }
})
}
 
  
 </script>
