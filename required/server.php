<?php 
include('connect.php');
include('ErrorsModule.php');
session_start();

date_default_timezone_set('Asia/Gaza');	
$username = "";
$email    = "";
$errors   = array(); 
$success  = array(); 

if(isLoggedIn()){
	@$FullName  = $_SESSION["user"]["fname"]." ".$_SESSION["user"]["lname"];
}else{
	@$FullName='';
}

 
	if (isset($_POST['register'])) {
			register();
		}	
	
	// if (isset($_POST['update'])) {
	// 	UpdateUser();
	// 	}
	 
	if (isset($_POST['login_btn'])) {
				login();
		}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location:index.php");
	}

   if (!isset($_SESSION['systemInfo'])) {
			loadSystemInfo();
    }


	function loadSystemInfo(){
		global $db;
 			$sql = "SELECT * FROM system_info";
			$qry = $db->query($sql);
				while($row = $qry->fetch_assoc()){
					$_SESSION['systemInfo'][$row['meta_field']] = $row['meta_value'];
				}
 	}
  
 
	function register(){
		global $db, $errors ,$success;

 		$fname    =  e($_POST['fname']);
		$lname    =  e($_POST['lname']);
 		$email    =  e($_POST['email']);
 		$phone    =  $_POST['phone'];
 		$birthday =  $_POST['birthday'];
 		//$type     =  $_POST['type'];
		$password1=  e($_POST['password1']);
		$password2=  e($_POST['password2']);

		///////////////// validation 

		if (empty($fname)) { 
			array_push($errors,"First Name is Required"); 
		}
		if (empty($lname)) { 
			array_push($errors, "Second Name Required"); 
		}
  
		if (empty($phone)) { 
			array_push($errors, "Phone is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($birthday)) { 
			array_push($errors, "Date of birth is required"); 
		}
 
		if (empty($password1)) { 
			array_push($errors,"Password is required"); 
		}
		if (empty($password2)) { 
			array_push($errors, "Confirm Password Required"); 
		}

		if ((isset($password1)) && (isset($password2)) && ($password1 != $password2)) {
			array_push($errors, "The two passwords do not match");
		}


		$sql1 = "SELECT email FROM users WHERE email='$email' ";
		$result = mysqli_query($db, $sql1);

		if (mysqli_num_rows($result) > 0) {
			array_push($errors, "This Email is already in use.");
		}	


		if (count($errors) == 0) {

			$password = md5($password1);
      $uid      = rand(1000000000000,9999999999999);

			////////////////////////////////////////////
		$query = "INSERT INTO users (uid,fname, lname,phone, email, birthday, type, password) 
													VALUES('$uid','$fname', '$lname', '$phone','$email','$birthday',0, '$password')";
 
				if (mysqli_query($db, $query) == true) {
					header('location: login.php');

				}
 
		}

	}


	function login(){
		global $db , $errors;

		$email    = e($_POST['email']);
		$password = e($_POST['password']);
 
		if ($email == NULL) {
			array_push($errors, "Email is required");
		}
		if ($password == NULL) {
			array_push($errors, "Password is required ");
		}
 
 

		if (count($errors) == 0) {
		
		$sql = "SELECT * FROM users WHERE email = '$email'  LIMIT 1";

		$result = $db->query($sql);

		$row = $result->fetch_assoc();

   
 	  $password = md5($password);
 
		// pout::yellow($password );
		// exit();

		if ($password == $row['password']) {

			if (mysqli_num_rows($result) == 1) { // user found

				  @$status = ActivatyChiker(@$email);
 
					if (@$status == 1) {
			 
					$_SESSION['user'] = $row;
  
					if ($_SESSION['user']['type'] == 0) {
							
							header('location: index.php');

					}elseif ($_SESSION['user']['type'] == 1 ) {
							
							header('location: admin/index.php');

					}elseif ($_SESSION['user']['type'] == 2 ){

							header('location: owner/index.php');

					}
 
				} else{
					array_push($errors, " The account has been banned ");
				}
			}
		  }else{
					array_push($errors, " Wrong username or password ");
		  } 
		}
	}

	function ActivatyChiker($email)
	{
		global $db;
		$user  = array();
		$query = "SELECT activity FROM users WHERE email = '".$email."'";
 		$result = mysqli_query($db, $query);
 		if ($result->num_rows > 0) {
				$user = mysqli_fetch_assoc($result);
			}			
		return $user['activity'];
		 
	}

	function getUserById($id){
		global $db;
		$user  = array();
		$query = "SELECT * FROM users WHERE uid=".$id;
 		$result = mysqli_query($db, $query);
 		if ($result->num_rows > 0) {
				$user = mysqli_fetch_assoc($result);
			}			
		return $user;
	}
  
	
	function isLoggedIn()
	{
		
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isLoggedInEcho()
	{
		
		if (isset($_SESSION['user'])) {
			echo 'true';
		}else{
			echo 'false';
		}
	}


	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'Admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="alert alert-danger">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}


	function display_success() {
		global $success;

		if (count($success) > 0){
			echo '<div class="alert alert-success">';
				foreach ($success as $succes){
					echo $succes .'<br>';
				}
			echo '</div>';
		}
	}

		function getUserType($type)
	{
		if ($type == 0) {
				return 'User ';						
		}elseif ($type == 1 ) {
				return 'admin ';						
		}	 
	}


	function getlandmarkID($id){
		global $db;
		$landmarkData = array();
			$query = "SELECT * , landmarks.id as controll 
			FROM landmarks
			LEFT JOIN images
			ON landmarks.id = images.landmarkID
			WHERE images.main=1 
			AND landmarks.id='".$id."'
			AND landmarks.owner='".$_SESSION['user']['uid']."'
			";
			$result = mysqli_query($db, $query);
			if ($result->num_rows > 0) {
					$landmarkData = mysqli_fetch_assoc($result);
			}
			return $landmarkData;
	}

	function getlandmarkNameByID($id){
		global $db;
 			$query = "SELECT landmarkName
			FROM landmarks
			WHERE 
			id='".$id."'
 			";
			$result = mysqli_query($db, $query);
			if ($result->num_rows > 0) {
					$landmarkData = mysqli_fetch_assoc($result);
					return $landmarkData['landmarkName'];
			}
	}



	function getSpecifications($id){
		global $db;
		$landmarkData = array();

			$query = "
				SELECT specifications.id as controll , specification
                FROM specifications
                JOIN landmarks
                ON landmarks.id = specifications.landmarkID
			    WHERE landmarkID =".$id."
				AND landmarks.owner='".$_SESSION['user']['uid']."'
			";
			$result = $db->query($query);
			if ($result->num_rows > 0) {

			  while($row = $result->fetch_assoc()) {
						array_push($landmarkData, $row); 
			   		}
			  }
 
		return $landmarkData;
	}


	function getLandmarkImages($id){
		global $db;
		$landmarkData = array();

		$query = "SELECT images.id as controll, image 
		from images 
		JOIN landmarks
        ON landmarks.id = images.landmarkID
        WHERE main = 0 
        AND images.landmarkID =".$id."
        AND landmarks.owner='".$_SESSION['user']['uid']."'
        ";
  
			$result = $db->query($query);
			if ($result->num_rows > 0) {

			  while($row = $result->fetch_assoc()) {
						array_push($landmarkData, $row); 
			   		}
			  }
 
		return $landmarkData;
	}

	function getLandmarkServices($id){
		global $db;
		$landmarkData = array();

			$query = "SELECT services.id as controll , serviceName 
			from services 
			JOIN landmarks
       		ON landmarks.id = services.landmarkID
			WHERE landmarkID =".$id."
			AND landmarks.owner='".$_SESSION['user']['uid']."'
			";
 			$result = $db->query($query);
 			if ($result->num_rows > 0) {

			  while($row = $result->fetch_assoc()) {
						array_push($landmarkData, $row); 
			   		}
			  }
 
		return $landmarkData;
	}

	function getLandmarkAvailability($id){
		global $db;
		$landmarkData = array();

			$query = "SELECT fromDay , toDay , atTime , toTime , exception , fromDay ,updatedBy
			FROM availability  
			JOIN landmarks
      		ON landmarks.id = availability.landmarkID
      		WHERE
			availability.landmarkID ='".$id."'
	        AND landmarks.owner='".$_SESSION['user']['uid']."'
			";
 			$result = mysqli_query($db, $query);
			if ($result->num_rows > 0) {
					$landmarkData = mysqli_fetch_assoc($result);
					$landmarkData['updatedByName'] = getUserFullName($landmarkData['updatedBy']);
 			}
			return $landmarkData;
	}	

	function getLandmarkContact($id){
		global $db;
		$landmarkData = array();

		$query = "SELECT owner FROM landmarks WHERE landmarks.id='".$id."'";
			$result = mysqli_query($db, $query);
			if ($result->num_rows > 0) {
					$landmarkData = mysqli_fetch_assoc($result);
					$landmarkData = getUserById($landmarkData['owner']);

			}
			return $landmarkData;
	}

	function getUserFullName($uid){
		global $db;
		$fullName ='' ;
		if ($uid!=null) {
			$query = "SELECT * FROM users WHERE uid=".$uid;
	 		$result = mysqli_query($db, $query);
			if (mysqli_num_rows($result)  > 0) { // user found
	 				$user = mysqli_fetch_assoc($result);
					$fullName = $user['fname'].' '. $user['lname'];
				}			
			return $fullName;
		}
		return null;

	}

	function getCityName($id){
		global $db;
		$cityName='';
 		$query = "SELECT name FROM citys WHERE id=".$id;
 		$result = mysqli_query($db, $query);
 		if ($result->num_rows > 0) {
				$data = mysqli_fetch_assoc($result);
				$cityName = $data['name'];
			}			
		return $cityName;
	}

	function getAreaName($id){
		global $db;
		$areaName='';
 		$query = "SELECT areaName FROM citys_areas WHERE id=".$id;
 		$result = mysqli_query($db, $query);
 		if ($result->num_rows > 0) {
				$data = mysqli_fetch_assoc($result);
				$areaName = $data['areaName'];
			}			
		return $areaName;
	}

	function countLandMarks(){
		global $db;
  		$query = "SELECT id FROM landmarks";
 		$result = mysqli_query($db, $query);
 		if ($result->num_rows > 0) {
			return $result->num_rows;
			}			
		}

	function countInteractions(){
		global $db;
  		$query = "SELECT comment_id FROM tbl_comment ";
 		$result = mysqli_query($db, $query);
 		if ($result->num_rows > 0) {
			return $result->num_rows;
			}			
		}

	function countTotalOwners(){
		global $db;
  		$query = "SELECT id FROM users WHERE type =2 ";
 		$result = mysqli_query($db, $query);
 		if ($result->num_rows > 0) {
			return $result->num_rows;
			}			
		}

	function countClients(){
		global $db;
  		$query = "SELECT id FROM users WHERE type =0 ";
 		$result = mysqli_query($db, $query);
 		if ($result->num_rows > 0) {
			return $result->num_rows;
			}			
		}


    function landmarkCountsByType($type){
      global $db;
        $query = "SELECT count(id) as count FROM landmarks WHERE type =".$type."";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
          return $row['count'];
         }
     }

     function landmarkCountsByCity($id){
      global $db;
        $query = "SELECT count(id) as count  FROM citys_areas WHERE cityID =".$id."";
        // echo  $query;
        $result = $db->query($query);
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
          return $row['count'];
         }
     }

     function landmarkCountsByAreas($id){
      global $db;
        $query = "SELECT count(id) as count FROM landmarks WHERE areaID =".$id."";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
          return $row['count'];
         }
     }

     function landmarkTypeName($id){
      global $db;
        $query = "SELECT type FROM landmarks_type WHERE id =".$id."";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
          return $row['type'];
         }
     }

     function landmarkTypeSP($id){
      global $db;
        $query = "SELECT type FROM landmarks_type WHERE id =".$id."";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
          return $row['type'];
         }
     }

      function landmarkMainImage($id){
      global $db;
        $query = "SELECT image FROM images WHERE landmarkID =".$id." AND main=1";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
          return $row['image'];
         }
     }


     function getCityNameId($id){
      global $db;
        $query = "SELECT name FROM citys WHERE id =".$id."";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
          return $row['name'];
         }
     }

     function getAreaNameId($id){
      global $db;
        $query = "SELECT areaName FROM citys_areas WHERE id =".$id."";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
          return $row['areaName'];
         }
     }

      function getOwnerNameId($uid){
      global $db;
        $query = "SELECT uid, fname , lname   FROM users WHERE uid =".$uid."";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
          return $row;
         }
     }

   function getFromDB($tabel , $colom, $value , $select ){
		global $conn;

		$sql = "SELECT ".$select." from ".$tabel." where ".$colom." like  '".$value."' ";

		 // echo $sql; 
		   $SqlResult = $conn->query($sql);
		      if ($SqlResult->num_rows > 0) {
		         $SqlRow = $SqlResult->fetch_assoc();
		         $Data   = (object) $SqlRow;

		         return  $Data -> $select;
		         }
		          else {
		           return 'No Data ..'   ;
		                  }
		  }


	function getReservationData($id){
		global $db;
		$data  = array();
		$query = "SELECT * FROM reservation WHERE id=".$id;
 		$result = mysqli_query($db, $query);
 		if ($result->num_rows > 0) {
				$data = mysqli_fetch_assoc($result);
			}			
		return $data;
	}


		function getNotificationCount(){
		global $db;
 		$query = "SELECT count(`id`) as count  FROM notifications WHERE owner=".$_SESSION['user']['uid']." and status=0";
 		// echo $query ;
 		$result = mysqli_query($db, $query);
 		if ($result->num_rows > 0) {
				$data = mysqli_fetch_assoc($result);
			}			
		return $data['count'];
	}

function getDeferance($time){
$originalTime = new DateTimeImmutable(date("Y-m-d H:i:s"));
$targedTime = new DateTimeImmutable($time);
$interval = $originalTime->diff($targedTime);
// print_r($interval);
return  $interval->format(" منذ    %h  ساعة   و   %I  دقيقة      ( يوم %a  )  ");
 
}
   
?>