<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $lecturer = $_POST["admin"];
            $position = $_POST["position"];
            $insertIntoAdmin = mysqli_query($conn, "INSERT INTO admin(
                lecturer_id, 
                position
                ) VALUES(
                    ".$lecturer.",
                    '".$position."'
                )"
            ) or die(mysqli_error($conn));
            if($insertIntoAdmin){
                echo "Second Admin successsfully registered";
            }
        }
    }
?>