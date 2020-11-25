<?php
    require('db_conn.php');
    $conn = new DB_CONNECTION();
    $connection= $conn->createConnection();
    if($connection){
        $queryNumberOfAdmin = mysqli_query($connection,"SELECT COUNT(lecturer_id) as total FROM admin")or die(mysqli_error($connection));
        if(mysqli_num_rows($queryNumberOfAdmin)>0){
            $row = mysqli_fetch_assosc($queryNumberOfAdmin);
            echo $row['total'];
        }else{
            echo 0;
        }
    }
?>