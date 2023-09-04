<?php 
include_once('required/server.php');
//    ======= meta ======= 
include_once('required/head.php'); 
//    ======= Header ======= 
include_once('required/header.php'); 
$user =  getUserById($_SESSION['user']['uid']); 

if (isset($_POST['updateBaseData'])) {

  extract($_POST);

  $sql = "
  UPDATE users 
  SET
  fname ='".$fname."',
  lname ='".$lname."',
  gender ='".$gender."',
  birthday ='".$birthday."'
  WHERE 
  uid ='".$_SESSION['user']['uid']."'
   "; 
  $status = mysqli_query($db , $sql);
  if ($status == true) {
    $_SESSION['user']['fname'] = $fname;
    $_SESSION['user']['lname'] = $lname;
    $_SESSION['user']['gender'] = $gender;
    $_SESSION['user']['birthday'] = $birthday;
    header('location: settings.php');
    } 
  }


if (isset($_POST['updateContactInfo'])) {

  extract($_POST); 

  if(isset($_FILES['image']['name']) and $_FILES['image']['name'] != null ){ 

    /* Getting file name */
  $filename = $_FILES['image']['name']; 
  /* Location */
  $location = "profile/".$filename;
  $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
  $imageFileType = strtolower($imageFileType);

  /* Valid extensions */
  $valid_extensions = array("jpg","jpeg","png");

  $response = 0;
  /* Check file extension */
  if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      move_uploaded_file($_FILES['image']['tmp_name'],$location); 

    $sql = "
        UPDATE users 
        SET
        email ='".$email."',
        phone ='".$phone."',
        type ='".$type."',
        image ='".$filename."'
        WHERE 
        uid ='".$_SESSION['user']['uid']."'
         ";    
        
        $_SESSION['user']['image'] = $filename;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['type'] = $type;

         $status = mysqli_query($db , $sql);

                if ($status == true) {

                header('location: settings.php');
             }  
         }  
       }else{ 
          $sql = "
          UPDATE users 
          SET
          email ='".$email."',
          phone ='".$phone."',
          type ='".$type."'
          WHERE 
          uid ='".$_SESSION['user']['uid']."'
           ";  


            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['phone'] = $phone;
            $_SESSION['user']['type'] = $type;
            $status = mysqli_query($db , $sql);
                if ($status == true) {
               header('location: settings.php');
             } 

        }   
 
     }


 ?>

<!-- ======= Breadcrumbs ======= -->
<section id="team" class="team section-bg">
  <div class="container p-5"> 
    <div class="row">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="font-weight: bold;">Account Settings:</h5>
        </div>
        <div class="modal-body">

            <div class="col-12  p-2">

                <div class="container-fluid d-flex justify-content-center">
                  <div class="col-sm-12 col-md-12">
                    <div class="card">
                      <div class="card-header">

                        <div class="row">
                          <div class="col-md-6">
                            <span style="font-weight: bold;">Basic Information: <span>
                          </div>
                        </div> 
                      </div>
                          <form method="POST" enctype="multipart/form-data">
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group col-6">
                                <label for="cc-number" class="control-label" style="font-weight: bold;">First Name</label>
                                <input type="text" name="fname" value="<?=$user['fname']?>" class="input-lg form-control" placeholder="First Name"
                                  maxlength="7" required>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="cc-exp" class="control-label" style="font-weight: bold;">Last Name</label>
                                  <input name="lname" value="<?=$user['lname']?>"  type="text" class="input-lg form-control"
                                    placeholder="Last Name"   maxlength="7" required="">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="cc-exp" class="control-label" style="font-weight: bold;">Gender</label>

                                  <select class="input-lg form-control" name="gender" >
                                    <?php 
                                    if ($user['gender'] ==1 ) {
                                      echo '<option value="1" selected>Male</option>
                                            <option value="0">Female</option>';
                                    }else{
                                       echo '<option value="1">Male</option>
                                            <option value="0" selected>Female</option>'; 
                                    }

                                    ?>
                                    </select>    
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="cc-exp" class="control-label" style="font-weight: bold;">Birthday</label>
                                  <input type="date" name="birthday"  value="<?=$user['birthday']?>" class="input-lg form-control" required="">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="updateBaseData" class="btn btn-outline-primary" style="font-weight: bold;">Edit</button>
                          </div>
                          </form>
                    </div>
                  </div>
                </div>
            </div> 

            <div class="col-12  p-2"> 
                <div class="container-fluid d-flex justify-content-center">
                  <div class="col-sm-12 col-md-12">
                    <div class="card">
                      <div class="card-header">

                        <div class="row">
                          <div class="col-md-6">
                            <span style="font-weight: bold;">Contact Information: <span>
                          </span></span></div>
                        </div> 
                      </div>
                          <form method="POST" enctype="multipart/form-data">
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group col-6">
                                <label for="cc-number" class="control-label" style="font-weight: bold;">Email</label>
                                <input type="text" name="email"  value="<?=$user['email']?>" class="input-lg form-control" placeholder="Email"  required="">
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="cc-exp" class="control-label" style="font-weight: bold;">Phone Number</label>
                                  <input type="text" name="phone"  value="<?=$user['phone']?>" class="input-lg form-control" placeholder="Phone Number" required="">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="cc-exp" class="control-label" style="font-weight: bold;">Account Type</label>

                                  <select class="input-lg form-control" name="type" > 
                                        <?php 
                                        if ($user['type'] ==2 ) {
                                          echo '<option value="2" selected>Property Owner</option>
                                                <option value="0">General</option>';
                                            }elseif($user['type'] ==1 ){
                                                echo '<option value="1" selected disabled>Admin</option>
                                                  ';
                                                
                                            }else{
                                              echo '<option value="2">Property Owner</option>
                                                    <option value="0" selected >General</option>';

                                           } 
                                        ?> 
                                    </select>    
                                </div>
                              </div>

                                <div class="col-md-6">
                                <div class="form-group">
                                  <label for="cc-exp" class="control-label" style="font-weight: bold;">Profile Image</label>
                                  <input type="file" name="image"  class="input-lg form-control" >
                                      <div class="col-md-12 p-4" align="center">
                                                <img src="profile/<?=$user['image']?>" 
                                                style="padding:1%;border:1px solid black; width: 120px;">
                                      </div>
                                </div>
                              </div> 


                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="updateContactInfo" class="btn btn-outline-primary" style="font-weight: bold;">Edit</button>
                          </div>
                          </form>
                        </div>
                        <div class="row p-4">
                           <a href="changePass.php" style="font-weight: bold;">Change Password</a>
                        </div> 
                   </div>
                </div>
            </div>


        </div>
        <div class="modal-footer">
          <a href="index.php" class="btn btn-secondary" style="font-weight: bold;">Back</a>
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