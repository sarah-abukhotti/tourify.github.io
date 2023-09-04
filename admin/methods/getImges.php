<?php 
include_once('..\..\required/server.php');
include_once('..\..\required/AdminFunctions.php');

  $imageArray = AdminGetLandmarkImages($_GET['landmarkID']);
 // pout::yellow($imageArray);
    foreach ($imageArray as $key => $array)
            {
               echo '<div class="col-xs-6 col-sm-3 p-2">
                  <div class="fall-item fall-effect">
                            <img src="'.$array['image'].'" style="height: 10rem;" alt="Card image cap">
                            <div class="mask">

                             <a href="'.$array['image'].'" data-lightbox="example-1">
                                <h2> <i class="ri-slideshow-4-line"></i> Show  </h2>
                              </a>
                                 <h2 onclick="deleteImage('.$array['controll'].')"> <i class="ri-delete-bin-line"></i>
                                 حذف   </h2>
                               </div>
                          </div>
                   </div>';
 
            }

        ?>