<?php
    if(isset($_POST)){
        $id = $_POST['id'];
        $regNum = $_POST['regNum'];
        require('db_conn.php');
        if($conn){
            $updateRegNumber = mysqli_query($conn, "UPDATE student SET matno ='".mysqli_real_escape_string($conn,$regNum)."' WHERE id =".$id."") or die(mysqli_error($conn));
            if($updateRegNumber){
                echo "success";
            }else {
                echo "failed";
            }
        }
    }

?>