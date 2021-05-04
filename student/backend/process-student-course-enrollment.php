<?php
    if(isset($_POST)){
        $allenrolledCourses = $_POST['allenrolledCourses'];
        $allCourses = json_decode($allenrolledCourses, false);
        $flag = true;
        require('db_conn.php');
        if($conn){
            for($i=0; $i<count($allCourses);$i++){
                $regCourseQuery = mysqli_query($conn,"INSERT INTO course_registration(matno, code, session, level) VALUES(
                    '".mysqli_real_escape_string($conn, $allCourses[$i]->matnum)."',
                    '".mysqli_real_escape_string($conn, $allCourses[$i]->code)."',
                    ".$allCourses[$i]->session.",
                    ".$allCourses[$i]->level."
                )") or die(mysqli_error($conn));
                if($regCourseQuery){
                    $flag = true;
                }else{
                    $flag = false;
                }
            }
            if($flag==true){
                echo "success";
            }else {
                echo "Network Error! Try again later.";
            }

        }
    }
?>