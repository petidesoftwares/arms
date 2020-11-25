<?php
    require('db_conn.php');
    $conn = new DB_CONNECTION();
    $connection= $conn->createConnection();
    if($connection){
        $checkAdmin = mysqli_query($connection, "SELECT id FROM lecturer");
        if(mysqli_num_rows($checkAdmin)>0){
            echo "Content present";
        }
        else{
            echo "Content empty";
        }

    }
?>