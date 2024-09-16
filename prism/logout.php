<?php 
session_start();

if(isset($_SESSION['user_email'])){
    header('location: index.php');
}

session_unset();
session_destroy();

?>