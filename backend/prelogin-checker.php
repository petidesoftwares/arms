<?php
    require('db_conn.php');
    if($conn){
        $checkAdmin = mysqli_query($conn, "SELECT id FROM lecturer")or die(mysqli_error($conn));
        if(mysqli_num_rows($checkAdmin)>0){
            echo "Content present";
        }
        else{
            echo "Content empty";
        }

    }
?>