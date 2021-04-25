<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $parentArray = $_POST["parentArray"];
            $parentArray = json_decode($parentArray, false);
            $flag = "";
            for($i = 0; $i<count($parentArray); $i++){
                $allocateCourse = mysqli_query($conn, "UPDATE course SET coordinator =".$parentArray[$i]->courseLecturer." WHERE code ='".$parentArray[$i]->code."' AND session_taken =".$parentArray[$i]->session."") or die(mysqli_error($conn));
                if($allocateCourse){
                    $flag = true;
                }else{
                    $flag = false;
                }
            }
            if($flag = true){
                echo "Course Allocation Successful";
            }
            else{
                echo "Course Allocation failed";
            }
        }
    }

?>