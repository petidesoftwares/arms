<?php
    if(isset($_POST)){
        $semester = $_POST['semester'];
        $session = $_POST['session'];
        $level  = $_POST['level'];

        require('db_conn.php');
        $resultList =array();
        $queryMatno = mysqli_query($conn, "SELECT DISTINCT matno FROM course_registration WHERE session =".$session." AND level =".$level." AND deleted_at IS NULL") or die(mysqli_error($conn));
        if(mysqli_num_rows($queryMatno)>0){
            while($rowNums = mysqli_fetch_assoc($queryMatno)){
                $queryStudents = mysqli_query($conn, "SELECT matno, firstname, surname FROM student WHERE matno ='".$rowNums['matno']."'") or die(mysqli_error($conn));
                while($studentDetails = mysqli_fetch_assoc($queryStudents)){
                    $resultList[] = $studentDetails;                    
                }
            }
        }
        echo json_encode($resultList);
    }

?>