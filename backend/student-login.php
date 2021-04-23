<?php
session_start();
    if(isset($_POST)){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $algorithm = "sha512";
        require("db_conn.php");
        if($conn){
            /***************authenticate user credentials**************/
            $queryUserCredentials = mysqli_query($conn, "SELECT id FROM student WHERE matno ='".$username."' AND password ='".hash($algorithm, $password)."'") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryUserCredentials)>0){
                $id = mysqli_fetch_assoc($queryUserCredentials);
                $_SESSION['id'] = $id['id'];
                if($username == $password){
                    header('Location:../views/update-student-password.php');
                }else{
                    header('Location:../views/home.php');
                }
            }else{
                echo "Error! User not found. Username or Password does not exist.";
            }
        }
    }
?>