<?php  
include_once('../../required/server.php'); ?>
<div class="container mt-5">
<div class="row d-flex justify-content-center">
    <div class="col-md-12" >
        <div class="headings d-flex justify-content-between align-items-center mb-3">
            <h5>  التفاعلات    (<?php echo  getFromDB('tbl_comment','post_id', $_POST['page_id'],"count('id')") ?>) </h5>
              <div class="buttons"> <span class="badge bg-white d-flex flex-row align-items-center"> 
               </span> </div>
                  </div>
<?php
 //fetch_comment.php
$page_id = $_POST['page_id'];
$query = "
SELECT * FROM tbl_comment 
WHERE parent_comment_id = '0' and post_id = ".$page_id."
ORDER BY comment_id DESC
";

$statement = $db_conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{

$sql_get_user = "SELECT uid , fname , lname , image  from users WHERE uid = ".$row['sender_id']."";

          $result_get_user = $conn->query($sql_get_user);
          $row_get_user = $result_get_user->fetch_assoc();
          $image = $row_get_user['image'];
                 
$output .= '                   
    <div class="p-3" id="id'.$row['comment_id'].'">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="user d-flex flex-row align-items-center"> <img src="profile/'.$image.'" width="40" class="user-img rounded-circle mr-2" alt="Person">&nbsp;&nbsp; <span><div class="font-weight-bold text-primary">'.getUserFullName($row_get_user["uid"]) .'</div> </span> </div> <div>'.$row["date"].'</div>
                </div>
                <div class="action d-flex justify-content-between mt-2 align-items-center">
                    <div class="px-4">  <span class="dots"></span> <div id="'.$row["comment_id"].'>رد  </div> <span class="dots"></span>
                    <p class="font-weight-normal">'.$row["comment"].'</p> </div>
                                 <div class="panel-footer"><button type="button" class="btn btn-outline-primary reply" id="'.$row["comment_id"].'">رد  </button></div>
                     </div>
                </div>
            </div> ';
 $output .= get_reply_comment( $db_conn, $row["comment_id"]);
}

echo $output;

function get_reply_comment($db_conn, $parent_id = 0, $marginleft = 0)
{
  
 $query = "
 SELECT * FROM tbl_comment WHERE parent_comment_id = '".$parent_id."'";
 $output = '';
 $statement = $db_conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 45;
 }
 if($count > 0)
 {
  foreach($result as $row)
  { 
global $conn;

        $sql_get_user = "SELECT uid , fname , lname , image ,phone from users WHERE uid = ".$row['sender_id']."";
        $result_get_user = $conn->query($sql_get_user);
        $row_get_user = $result_get_user->fetch_assoc();
        $image = $row_get_user["image"];
 

                          
   $output .= '
                    <div class=" p-3" id="id'.$row['comment_id'].'"  style="margin-right:'.$marginleft.'px">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center"> <img src="profile/'.$image.'" width="40" class="user-img rounded-circle mr-2" alt="Person">&nbsp;&nbsp; <span><div class="font-weight-bold text-primary">'.getUserFullName($row_get_user["uid"]) .'</div> </span> </div> <div>'.$row["date"].'</div>
                            </div>
                            <div class="action d-flex justify-content-between mt-2 align-items-center">
                                <div class="px-4">  <span class="dots"></span> <div id="'.$row["comment_id"].'>رد  </div> <span class="dots"></span>
                                <p class="font-weight-normal">'.$row["comment"].'</p> </div>
                                 <div class="panel-footer"><button type="button" class="btn btn-outline-primary reply" id="'.$row["comment_id"].'">رد  </button></div>
                                 </div>
                            </div>
                        </div>
                               ';
   $output .= get_reply_comment($db_conn, $row["comment_id"], $marginleft);
  }
 }
    return $output;
}

?>
        </div>
    </div>
</div>