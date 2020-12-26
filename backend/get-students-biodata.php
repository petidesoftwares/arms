<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $matno = $_POST["matno"];
            $queryStudentData = mysqli_query($conn, "SELECT student.matno, student.surname, student.firstname, (SELECT student_othernames.othername FROM student_othernames WHERE student_othernames.student_id=student.id) AS othername, admission_session FROM student, student_othernames WHERE student.matno = '".$matno."'") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryStudentData)>0){
                $dataArray = array();
                while($row = mysqli_fetch_assoc($queryStudentData)){
                    $dataArray[] = $row;
                }
                echo json_encode($dataArray);
            }
        }
    }

?>