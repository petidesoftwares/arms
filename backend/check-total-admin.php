<?php
    require('db_conn.php');
    if($conn){
        $queryNumberOfAdmin = mysqli_query($conn,"SELECT COUNT(lecturer_id) as total FROM admin")or die(mysqli_error($conn));
        if(mysqli_num_rows($queryNumberOfAdmin)>0){
            $row = mysqli_fetch_assosc($queryNumberOfAdmin);
            echo $row['total'];
        }else{
            echo 0;
        }
    }
?>