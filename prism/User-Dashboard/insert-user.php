<?php
include("config.php");

if (isset($_POST['update'])) {
    $user_id = $_POST['u_id']; 
    $user_name = $_POST['u_name'];
    $user_studentid = $_POST['u_studentid'];
    $user_number = $_POST['u_number'];
    $user_address = $_POST['u_address'];
    $user_cv = $_FILES['u_cv']['name'];
    $user_cv_tmp = $_FILES['u_cv']['tmp_name'];
    $user_img = $_FILES['u_img']['name'];
    $user_img_tmp = $_FILES['u_img']['tmp_name'];


        $update_profile = "UPDATE `users` SET `u_name` = '$user_name', `u_studentid` = '$user_studentid', `u_number` = '$user_number', `u_address` = '$user_address', `u_cv` = '$user_cv', `u_img` = '$user_img' WHERE `u_id` = '$user_id'";
        $connect = mysqli_query($connection, $update_profile);
        move_uploaded_file($user_img_tmp, 'assets/images/user_img/' . $user_img);
        move_uploaded_file($user_cv_tmp, 'assets/images/user_img/' . $user_cv);
        if ($connect) {
            echo '<script>
                alert("Profile updated successfully");
                window.location.href="../form.php";
                </script>';
        } else {
            echo '<script>
                alert("Profile update failed");
                window.location.href="user_profile.php";
                </script>';
        }
    }
?>