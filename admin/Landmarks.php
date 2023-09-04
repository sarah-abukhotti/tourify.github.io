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
        <center><h5 class="card-title">Places</h5></center>

        <div class="panel panel-default">
          <div class="panel-heading"><b>Select a place to view details:</b></div>
          <br>
          <div class="panel-body">

 

   <div class="container">
  
      <div class="row" >
        <?php
  
        $query = "SELECT landmarks.id as controll ,landmarkName , image
          FROM landmarks
          JOIN images
          ON landmarks.id = images.landmarkID
          WHERE images.main=1 
          ORDER BY controll DESC";
   
        $result = $db->query($query);
           while($row = $result->fetch_assoc()) { 
 // pout::yellow($row);
             echo ' <div class="col-xs-6 col-sm-3">
                    <div class="fall-item fall-effect">
                          <img src="'.$row['image'].'" style="height: 23vh;">
                          <div class="mask">
                          
                              <h2>'.$row['landmarkName'].' <i class="btn btn-danger ri-delete-bin-line" onclick=(deleteLandmark('.$row['controll'].'))></h2></i> 
                               <a href="viowLandmark.php?landmarkID='.$row['controll'].'" class="btn btn-default"></a>
                          </div>
                      </div>
                      <a href="viowLandmark.php?landmarkID='.$row['controll'].'">
                         <h4 class="text-center p-2">'.$row['landmarkName'].'</h4>
                      </a>
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
</section>
</main>
  <!-- ======= Footer ======= -->
 <?php
 include_once("required/footer.php");
 include_once("../toster/toster.php");
 ?>
</body>
</html>

<script>
  function deleteLandmark(id){
      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to see it anymore",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '../admin/methods/removeLandmark.php',
          type: 'post',
          data: { 'id': id },
          success: function (response) {
            swalWithBootstrapButtons.fire(
              'Delete',
              'Successfully deleted.',
              'success'
        )
              window.location="Landmarks.php";
          }
        });

      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancel',
          ':) Deletion cancelled',
          'error'

        )
      }
    })

  }
</script>