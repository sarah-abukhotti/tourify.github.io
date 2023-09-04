<?php 

	function AdminGetlandmarkID($id){
		global $db;
		$landmarkData = array();

			$query = "SELECT * , landmarks.id as controll 
			FROM landmarks
			LEFT JOIN images
			ON landmarks.id = images.landmarkID
			WHERE images.main=1 
			AND landmarks.id='".$id."'
			";
			$result = mysqli_query($db, $query);
			if ($result->num_rows > 0) {
					$landmarkData = mysqli_fetch_assoc($result);
			}
			return $landmarkData;
	}



	function AdminGetSpecifications($id){
		global $db;
		$landmarkData = array();

			$query = "
				SELECT specifications.id as controll , specification
                FROM specifications
                JOIN landmarks
                ON landmarks.id = specifications.landmarkID
			    WHERE landmarkID =".$id."
 			";
			$result = $db->query($query);
			if ($result->num_rows > 0) {

			  while($row = $result->fetch_assoc()) {
						array_push($landmarkData, $row); 
			   		}
			  }
 
		return $landmarkData;
	}


	function AdminGetLandmarkImages($id){
		global $db;
		$landmarkData = array();

		$query = "SELECT images.id as controll, image 
		from images 
		JOIN landmarks
        ON landmarks.id = images.landmarkID
        WHERE main = 0 
        AND images.landmarkID =".$id."
         ";
  
			$result = $db->query($query);
			if ($result->num_rows > 0) {

			  while($row = $result->fetch_assoc()) {
						array_push($landmarkData, $row); 
			   		}
			  }
 
		return $landmarkData;
	}

	function AdminGetLandmarkServices($id){
		global $db;
		$landmarkData = array();

			$query = "SELECT services.id as controll , serviceName 
			from services 
			JOIN landmarks
       		ON landmarks.id = services.landmarkID
			WHERE landmarkID =".$id."
 			";
 			$result = $db->query($query);
 			if ($result->num_rows > 0) {

			  while($row = $result->fetch_assoc()) {
						array_push($landmarkData, $row); 
			   		}
			  }
 
		return $landmarkData;
	}

	function AdminGetLandmarkAvailability($id){
		global $db;
		$landmarkData = array();

			$query = "SELECT fromDay , toDay , atTime , toTime , exception , fromDay ,updatedBy
			FROM availability  
			JOIN landmarks
      		ON landmarks.id = availability.landmarkID
      		WHERE
			availability.landmarkID ='".$id."'
 			";
 			$result = mysqli_query($db, $query);
			if ($result->num_rows > 0) {
					$landmarkData = mysqli_fetch_assoc($result);
					$landmarkData['updatedByName'] = getUserFullName($landmarkData['updatedBy']);
 			}
			return $landmarkData;
	}	

 
?>