<?php
    if(isset($_POST)){
        require('db_conn.php');
        $courseID = $_POST['courseID'];
        $code = $_POST['code'];
        $title = $_POST['title'];
        $units = $_POST['units'];
        $level = $_POST['level'];
        $semester = $_POST['semester'];
        $takenby = $_POST['takenby'];
        $status = $_POST['status'];

        if($conn){
            $updateCourseQuery = mysqli_query($conn, "UPDATE course SET code ='".$code."', title ='".$title."', units = ".$units.", level_taken =".$level.", taken_by ='".$takenby."', semester ='".$semester."', status ='".$status."' WHERE id =".$courseID."")or die(mysqli_error($conn));
            if($updateCourseQuery){
                echo "success";
            }else {
                echo "failed";
            }
        }
    }
?>