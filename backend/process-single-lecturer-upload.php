<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $title = $_POST["title"]; 
            $fname = $_POST["fname"];
            $surname = $_POST["surname"];
            $mobile = $_POST["mobile"];

            $algorithm = "sha512";
            $l_password = hash($algorithm, $mobile);

            //Check mobile phone number for duplicate
            $queryMobile = mysqli_query($conn, "SELECT mobile_phone FROM lecturer WHERE mobile_phone ='".$mobile."'") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryMobile)>0){
                echo "Phone number already exist";
            }
            else{
                $insertIntoLecturer = mysqli_query($conn, "INSERT INTO lecturer(
                    mobile_phone,
                    title,
                    firstname,
                    surname,
                    password
                ) VALUES(
                    '".mysqli_real_escape_string($conn, $mobile)."',
                    '".mysqli_real_escape_string($conn, $title)."',
                    '".mysqli_real_escape_string($conn, $fname)."',
                    '".mysqli_real_escape_string($conn, $surname)."',
                    '".$l_password."'
                )") or die(mysqli_error($conn));

                if($insertIntoLecturer){
                    echo "Lecturer successfully uploaded";
                }else{
                    echo "An error occured while uploading lecturer";
                }
            }
        }
    }
?>