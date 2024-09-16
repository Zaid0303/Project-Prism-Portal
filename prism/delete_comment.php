<?php
// include("config.php");
// if (isset($_POST['comment_id'])) {
//     $comment_id = mysqli_real_escape_string($connection, $_POST['comment_id']);

//     // Delete the comment from the database
//     $delete_query = "DELETE FROM `comment` WHERE `comment_id` = '$comment_id'";
//     $delete_result = mysqli_query($connection, $delete_query);

//     if ($delete_result) {
//         echo "deleted";
//     } else {
//         echo "Error: " . mysqli_error($connection);
//     }
// }
?>

<?php 

include("config.php");

if(isset($_GET["c-id"])){
 $comment_id = $_GET["c-id"];
}

$delete = "DELETE from `comment` where `comment_id` = '$comment_id'";
$query = mysqli_query ($connection , $delete) ;
?>
