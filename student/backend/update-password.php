<?php
    session_start();
    if(isset($_POST)){
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];
        $student_id = $_SESSION['id'];
        
        $algorithm = "sha512";
        require("db_conn.php");
        if($conn){
            $updatePassword = mysqli_query($conn, "UPDATE student SET password = '". hash($algorithm, $newPassword)."' WHERE id =".$student_id."") or die(mysqli_error($conn));
            if($updatePassword){
                session_destroy();
                echo "success";
            }else {
                echo "Network Error! Update failed. Try again later";
            }
        }
    }
?>