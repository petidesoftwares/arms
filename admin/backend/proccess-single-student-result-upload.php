<?php
    if(isset($_POST)){
        $result = $_POST['result'];
        $resultDetail = json_decode($result, false);
        require('db_conn.php');
        if($conn){
            $updateResult = mysqli_query($conn, "UPDATE course_registration SET score =".$resultDetail->score." WHERE matno ='".$resultDetail->matno."' AND code = '".$resultDetail->code."' AND score = -1")or die(mysqli_error($conn));
            if($updateResult){
                echo "success";
            }else {
                die("Update failed! ".mysqli_error($conn));
            }
        }
    }

?>