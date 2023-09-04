<?php 

include_once('..\..\required/server.php');

// echo "<pre>";
// print_r($_FILES);
// print_r($_REQUEST);

	//if(isset($_FILES['file']['name'])){
 	/* Getting file name */
	/*$filename = $_FILES['file']['name'];
  	$location = "..\..\landmark-Image-main/".$filename;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);*/

 	//$valid_extensions = array("jpg","jpeg","png");
 
	/* Check file extension */
	//if(in_array(strtolower($imageFileType), $valid_extensions)) {
	   	/* Upload file */
	   	//if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){

 	     	$uid         = $_POST['owner'];
			$landmarkName= $_POST['landmarkName'];
  		    $type        = $_POST['type'];
		    $description = $_POST['description'];
            $longitude   = $_POST['longitude'];
 			$latitude    = $_POST['latitude'];
 			$city   	 = $_POST['city'];
 			$area   	 = $_POST['area'];
 			$haveBooking = $_POST['haveBooking'];
 			$price 		 = $_POST['price'];
			$url_image   = $_POST['url_image'];

			$query = "INSERT INTO landmarks (owner , type, landmarkName ,description ,longitude , latitude, city, areaID , haveBooking, price  , addByUid )VALUES ('$uid' , '$type','$landmarkName','$description','$longitude', '$latitude', '$city', '$area', '$haveBooking', '$price' ,'$uid')";
 			
 			mysqli_query($db, $query);
  			$landmarkID = mysqli_insert_id($db);

			$query2 = "INSERT INTO images (landmarkID , image , main )  
							     VALUES ( '$landmarkID','$url_image', 1)";
  			mysqli_query($db, $query2);

			$query3 = "INSERT INTO availability (landmarkID )  
							     VALUES ( '$landmarkID')";
  			mysqli_query($db, $query3);


			 //  	}
		//	}
 
		//}
 
	

 	
?>
