<?php
include_once('../../required/server.php'); 
$error = '';
$uid = '';
$comment_content = '';
  
$uid = $_SESSION['user']['uid'];
  
if(empty($_POST["post_id"]))
{
 $error .= '<p class="text-danger">post id is required</p>';
}
else
{
 $post_id = $_POST["post_id"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               Comment is required
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
 
}
else
{
 $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 $query = "
 INSERT INTO tbl_comment 
 (parent_comment_id, comment, sender_id, post_id) 
 VALUES (:parent_comment_id, :comment, :sender_id, :post_id)
 ";
 $statement = $db_conn->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'           => $comment_content,
   ':sender_id'         => $uid,
   ':post_id'           => $post_id
  )
 );
 $error = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                تم اضافة التعليق 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
}

$data = array(
 'error'  => $error
);

$commentId = $db_conn->lastInsertId(); 

$sql = "
 INSERT INTO notifications 
 (landmarkID, owner, sender ,commentId) 
 VALUES ('".$post_id."','".$_POST["owner"]."','".$uid."','".$commentId."')
 ";
mysqli_query($db,$sql);

echo json_encode($data);

?>
