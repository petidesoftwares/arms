<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $semester = $_POST["semester"];
            $level = $_POST["level"];
            $session = $_POST["session"];

            $queryEnrolledCourses = mysqli_query($conn,"SELECT code, title, units FROM course WHERE code =(SELECT DISTINCT code FROM course_registration WHERE level >".$level." AND session =".$session.") AND semester='".$semester."'") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryEnrolledCourses)>0){
                $dataArray = array();
                while($rows = mysqli_fetch_assoc($queryEnrolledCourses)){
                    $dataArray[]=$rows;
                }
                echo json_encode($dataArray);
            }else{
                echo "No course Found";
            }
        }
    }

?>