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
            <center><h5 class="card-title">User Management <?php echo 'Manage Users of '.$_SESSION['systemInfo']['short_name'] ?> </h5></center>
              <div class="panel panel-default">
                  <div class="panel-heading"><b>Manage All System Users:</b></div>
                  <br>
                  <div class="panel-body">
                      <div class="container">
                          <div class="row" id="userData">
                          </div>
                          <div class="modal fade" id="userTypeModel" tabindex="-1" aria-hidden="true"
                              style="display: none;">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">User Type:</h5>
                                      </div>
                                      <div class="modal-body">
                                          <form id="myform" enctype="multipart/form-data">
                                              <div class="col-12  p-2">
                                                  <input type="hidden" class="form-control" id="uid-seter" name="uid-seter">
                                              </div>
                                              <div class="col-12  p-2">
                                                  <label for="inputNanme4" class="form-label">User Type:</label>
                                                  <select class="form-control" id="user-type" name="user-type">
                                                      <!--<option value="0">User</option>-->
                                                      <!--<option value="2">Owner</option>-->
                                                      <option value="1">Manager</option>
                                                  </select>
                                              </div>
                                          </form>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                              data-bs-dismiss="modal">Close</button>
                                          <button type="button" onclick="save()" class="btn btn-outline-primary">Save</button>
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

  function getUserData() {
    $.ajax({
      url: "methods/getUserData.php",
      success: function (data) {
        $("#userData").html(data);
      },
    });
  }

  getUserData();


  function deleteUserData(uid) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: 'Are you sure?',
    text: "Delete user data",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete!',
    cancelButtonText: 'No, cancel',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: 'methods/removeUser.php',
        type: 'post',
        data: { 'uid': uid },
        success: function (response) {
          if (response === "admin") {
            swalWithBootstrapButtons.fire(
              'Cannot Delete',
              'Cannot delete admin user data.',
              'error'
            )
          } else {
            swalWithBootstrapButtons.fire(
              'Deleted',
              'User data has been successfully deleted.',
              'success'
            )
            getUserData();
          }
        }
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      swalWithBootstrapButtons.fire(
        'Cancelled',
        'User data was not deleted.',
        'error'
      )
    }
  })
}


      function Disactive(uid) {
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "The account will be deactivated",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, disable account',
          cancelButtonText: 'No, cancel',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'methods/disactiveUser.php',
              type: 'post',
              data: { 'uid': uid },
              success: function (response) {
                swalWithBootstrapButtons.fire(
                  'Disabled',
                  'The account has been disabled',
                  'success'
                )
                getUserData();
              }
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'The account was not disabled',
              'error'
            )
          }
        })
      }
      
      function Active(uid) {
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "The account will be activated",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, activate account',
          cancelButtonText: 'No, cancel',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'methods/activeUser.php',
              type: 'post',
              data: { 'uid': uid },
              success: function (response) {
                swalWithBootstrapButtons.fire(
                  'Activated',
                  'The account has been activated',
                  'success'
                )
                getUserData();
              }
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'The account was not activated',
              'error'
      )
    }
  })
}

 </script>