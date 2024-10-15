<?php 
include("config.php");

if(isset($_POST['meeting'])){
    $topic = $_POST['topic'];
    $duration = $_POST['duration'];

    if(!empty($topic) AND !empty($duration)){

        $insert_meeting = "INSERT INTO `meetings` (`id`, `topic`, `duration`) VALUES (NULL, '$topic', '$duration')";

        $meeting_result = mysqli_query($connection, $insert_meeting);
        if($meeting_result){
            echo '
            <script>
            alert("inserted")
            </script>
            ';
        }
    }
}
?>