<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $session = $_POST["session"]; 
            $code = $_POST["code"]; 
            $title = $_POST["title"]; 
            $unit = $_POST["unit"]; 
            $semester = $_POST["semester"];
            $level = $_POST["level"]; 
            $option = $_POST["option"]; 
            $status = $_POST["status"]; 
            $min_pass_mark = $_POST["min_pass_mark"];
            
            // Verify course code for duplicate
            $queryCode = mysqli_query($conn, "SELECT code FROM course WHERE code = '".$code."'") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryCode)>0){
                echo "Course already exist";
            }
            else{
                $insertIntoCourse = mysqli_query($conn, "INSERT INTO course(
                    code,
                    session_taken,
                    title,
                    units,
                    level_taken,
                    semester,
                    taken_by,
                    status,
                    min_pass_score
                ) VALUES(
                    '".mysqli_real_escape_string($conn, $code)."',
                    '".mysqli_real_escape_string($conn, $session)."',
                    '".mysqli_real_escape_string($conn, $title)."',
                    '".mysqli_real_escape_string($conn, $unit)."',
                    '".mysqli_real_escape_string($conn, $level)."',
                    '".mysqli_real_escape_string($conn, $semester)."',
                    '".mysqli_real_escape_string($conn, $option)."',
                    '".mysqli_real_escape_string($conn, $status)."',
                    '".mysqli_real_escape_string($conn, $min_pass_mark)."'
                )") or die(mysqli_error($conn));
                if($insertIntoCourse){
                    echo "Course successfully uploaded";
                }
                else{
                    echo "Error! An error occur";
                }
            }
        }
    }
?>