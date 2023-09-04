<?php 
include_once('..\..\required/server.php');
include_once('..\..\required/AdminFunctions.php');

$availabilityArray = AdminGetLandmarkAvailability($_GET['landmarkID']);
?>
<div class="form-group row p-2">
    <label for="services" class="form-label col-2">From Day: </label>
    <div class="col-4">
        <p class="card-text"> 
            <?php 
                echo $availabilityArray['fromDay'];
            ?> 
        </p>
    </div>
</div>

<div class="form-group row p-2">
    <label for="services" class="form-label col-2">To Day: </label>
    <div class="col-4">
        <p class="card-text"> 
            <?php 
                echo $availabilityArray['toDay'];
            ?> 
        </p>
    </div>
</div>


<div class="form-group row p-2">
    <label for="services" class="form-label col-2">From Time: </label>
    <div class="col-4">
        <p class="card-text"> 
            <?php 
                echo $availabilityArray['atTime'];
            ?> 
        </p>
    </div>
</div>

<div class="form-group row p-2">
    <label for="services" class="form-label col-2">To Time: </label>
    <div class="col-4">
        <p class="card-text"> 
            <?php 
                echo $availabilityArray['toTime'];
            ?> 
        </p>
    </div>
</div>

<div class="form-group row p-2">
    <label for="services" class="form-label col-2">Exception: </label>
    <div class="col-4">
        <p class="card-text"> 
            <?php 
                echo $availabilityArray['exception'];
            ?> 
        </p>
    </div>
</div>

<div class="form-group row p-2">
    <label for="services" class="form-label col-2">Updated By: </label>
    <div class="col-4">
        <p class="card-text"> 
            <?php 
                echo $availabilityArray['updatedByName'];
            ?> 
        </p>
    </div>
</div>
