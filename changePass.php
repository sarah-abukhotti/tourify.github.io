<?php 
include_once('required/server.php');
//    ======= meta ======= 
include_once('required/head.php'); 
//    ======= Header ======= 
include_once('required/header.php');  
$user =  getUserById($_SESSION['user']['uid']); 

if (isset($_POST['updatePass'])) {

      extract($_POST); 
      $oldPass = md5($oldPass);

      if ($oldPass != $user['password']) {
          array_push($errors, "Incorrect old password");
      }elseif($newPass != $rePass){
          array_push($errors, "Passwords do not match"); 
      } 

      if (count($errors) == 0) {
      $newPass = md5($newPass);

      $sql = "
      UPDATE users 
      SET
      password ='".$newPass."' 
      WHERE 
      uid ='".$_SESSION['user']['uid']."'
       "; 
      $status = mysqli_query($db , $sql);
      if ($status == true) {
           array_push($success, "Password changed successfully"); 
 
        }  
      }
 
    }

 
 ?>

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container p-3">

    <ol>
      <li><a href="index.php">Hotel and Resort Booking Website</a></li>
      <li>Account Settings</li>
    </ol>

  </div>
</section><!-- End Breadcrumbs -->

<section class="why-us">
  <div class="container p-3">
    <div class="section-title">
      <h2>Account Settings</h2>
      <h4>Change Password</h4>
    </div>

    <section id="team" class="team section-bg">
      <div class="container p-5"> 
        <div class="row">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Change Password:</h5>
            </div>
            <div class="modal-body">

                <div class="col-12  p-2">

                    <div class="container-fluid d-flex justify-content-center">
                      <div class="col-sm-12 col-md-12">
                        <div class="card">
                          <div class="card-header">

                            <div class="row">
                              <div class="col-md-6">
                                <span>Old Password:<span>
                              </div>
                            </div> 
                          </div>
                              <form method="POST" enctype="multipart/form-data">
                              <div class="card-body">
                                <div class="row">
                                  <div class="form-group col-6">
                                    <label for="cc-number" class="control-label">Old Password</label>
                                    <input type="password" name="oldPass" class="input-lg form-control" placeholder="Old Password" required>
                                  </div>
                                  <div class="col-md-6">
                                    
                                  </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="cc-exp" class="control-label">New Password</label>
                                      <input name="newPass" type="password" class="input-lg form-control"
                                        placeholder="New Password"  required="">
                                    </div>
                                  </div>
                                   <div class="col-md-6">
                                    
                                  </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="cc-exp" class="control-label">Confirm New Password</label>
                                      <input name="rePass" type="password" class="input-lg form-control"
                                        placeholder="Confirm New Password"  required="">
                                    </div> 
                                     <?=display_success().display_error() ?> 
                                  </div>
 
                                
                                </div>
                              </div>
                               <div class="col-md-6">
                                 <div class="modal-footer">
                                <button type="submit" name="updatePass" class="btn btn-outline-primary">Change Password</button>
                                <a href="index.php" class="btn btn-secondary">Back</a>

                              </div>

                                    
                                  </div>

                             
                              </form>
                        </div>
                      </div>
                    </div>
                </div> 

             

            </div>
           
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->


  </div>
</section>


<?php 
  include_once('required/footer.php'); 
?>
