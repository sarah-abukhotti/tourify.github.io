<?php 
include_once('../required/server.php');

if (isset($_POST['data'])) {
	
	$key = "%{$_POST['data']}%";

	$sql = "SELECT  landmarks.id as id , landmarkName , type
			FROM landmarks
			WHERE
            landmarks.activity = 1
            AND
	        landmarks.landmarkName LIKE ? 
	        OR
	        landmarks.description Like ?
	        LIMIT 5";
 
	$stmt = $db_conn->prepare($sql);
	$stmt->execute([$key, $key]);

	if ($stmt->rowCount() > 0) {
		$results = $stmt->fetchAll();
		foreach ($results as $row) { ?>
		<li style="text-align: left;">
		    <a href="landmark.php?landmarkID=<?=$row['id']?>">
		  	<img src="<?=landmarkMainImage($row['id'])?>" width=35px height="20"> 
		  	<?=$row['landmarkName']?> 
		       (<?=landmarkTypeSP($row['type'])?>) 
		  </a>
		</li>
	   <?php
       }
	}else{
		
		echo '<li>
				<a href="index.php"> Sorry  No Data  ...</a>  
				</li>';
			};
} ?>

