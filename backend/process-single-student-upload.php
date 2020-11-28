<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $session = $_POST['session'];
            $matno = strtoupper($_POST['matno']);
            $fname = $_POST['fname'];
            $surname = $_POST['surname'];
            $level = $_POST['level'];

            $algorithm = "sha512";
            $defaultPassword = hash($algorithm,$matno);
            $verifyMatno = mysqli_query($conn, "SELECT matno FROM student WHERE matno = '".$matno."'");
            if(mysqli_num_rows($verifyMatno)>0){
                echo ("Registration number already exist");
            }else{

                $insertIntoStudent = mysqli_query($conn, "INSERT INTO student(
                    matno,
                    firstname,
                    surname,
                    admission_level,
                    admission_session,
                    password
                ) VALUES(
                    '".mysqli_real_escape_string($conn, $matno)."',
                    '".mysqli_real_escape_string($conn, $fname)."',
                    '".mysqli_real_escape_string($conn, $surname)."',
                    '".mysqli_real_escape_string($conn, $level)."',
                    '".mysqli_real_escape_string($conn, $session)."',
                    '".$defaultPassword."'
                )") or die(mysqli_error($conn));

                if($insertIntoStudent){
                    echo "Student successfully registered";
                }else{
                    echo "Error! An error occurred while uploading student";
                }
            }
        }
    }
?>