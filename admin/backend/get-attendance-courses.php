<?php
if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $session = $_POST["session"];
        $semester = $_POST["semester"];
        $level = $_POST["level"];
        $option = $_POST["option"];
            $getCourses = mysqli_query($conn, "SELECT code, title, units FROM course WHERE level_taken = ".$level." AND session_taken = ".$session." AND semester = '".$semester."' AND taken_by = '".$option."'") or die(mysqli_error($conn));
            if(mysqli_num_rows($getCourses)>0){
                $dataArray = array();
                while($row = mysqli_fetch_assoc($getCourses)){
                    $dataArray[]=$row;
                }
                echo json_encode($dataArray);
            }else{
                echo "ERROR! No data found";
            }
        }
    }
?>