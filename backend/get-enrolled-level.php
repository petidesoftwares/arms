<?php
     require('db_conn.php');
     if($conn){
         $session = $_POST["session"];
         $code = $_POST["code"];
         $getEnrolledLevel = mysqli_query($conn,"SELECT DISTINCT level FROM course_registration WHERE code = '".$code."' AND session = ".$session."") or die(mysqli_error($conn));
        if(mysqli_num_rows($getEnrolledLevel)>0){
            $levelarray = array();
            while($rows=mysqli_fetch_assoc($getEnrolledLevel)){
                $levelarray[] = $rows;
            }
            echo json_encode($levelarray);
        }
     }
?>