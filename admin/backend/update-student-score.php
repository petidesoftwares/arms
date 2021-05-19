<?php
    if(isset($_POST)){
        $code = $_POST['code'];
        $level = $_POST['level'];
        $matnum = $_POST['matnum'];
        $session = $_POST['session'];
        $score = $_POST['score'];
        require('db_conn.php');
        if($conn){
            $updateResult = mysqli_query($conn, "UPDATE course_registration SET score =".$score." WHERE 
            matno ='".$matnum."' AND code ='".$code."' AND level =".$level." AND session =".$session."")or die(mysqli_error($conn));
            if($updateResult){
                echo "success";
            }else {
                echo mysqli_error($conn);
            }
        }
    }
?>