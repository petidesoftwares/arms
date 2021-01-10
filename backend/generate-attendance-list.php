<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $session = $_POST["session"];
            $level = $_POST["level"];
            $code = $_POST["code"];
            $getMatno = mysqli_query($conn, "SELECT matno FROM `course_registration` WHERE session=".$session." AND level=".$level." AND code='".$code."' AND score=-1 ") or die(mysqli_error($conn));
            if(mysqli_num_rows($getMatno)>0){
                $attArray = array();
                while($rows = mysqli_fetch_assoc($getMatno)){
                    $getStudentID = mysqli_query($conn,"SELECT id from student WHERE matno = '".$rows['matno']."' ") or die(mysqli_error($conn));
                    if(mysqli_num_rows($getStudentID)>0){
                        while($id = mysqli_fetch_assoc($getStudentID)){
                            $verifyOtherName = mysqli_query($conn,"SELECT COUNT(student_id) AS count_othername FROM student_othernames")or die(mysqli_error($conn));
                            if(mysqli_num_rows($verifyOtherName)>0){
                                $queryList = mysqli_query($conn, "SELECT matno, firstname, surname, (SELECT othername FROM student_othernames WHERE student.id = student_othernames.student_id) as othername FROM student WHERE matno = '".$rows['matno']."'") or die(mysqli_error($conn));
                                while($bioData = mysqli_fetch_assoc($queryList)){
                                    $attArray[]=$bioData;
                                }
                            }else{
                                $queryList = mysqli_query($conn, "SELECT matno, firstname, surname FROM student WHERE matno = '".$rows['matno']."'") or die(mysqli_error($conn));
                                while($bioData = mysqli_fetch_assoc($queryList)){
                                    $attArray[]=$bioData;
                                }
                            }
                        }
                    }
                }
                echo json_encode($attArray);
            }else{
                echo "No Student found for the course";
            }
        }
    }

?>