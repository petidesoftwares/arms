<?php
    function getTitles(){
        require('db_conn.php');
        // $conn = new DB_CONNECTION();
        // $connection= $conn->createConnection();
        if($conn){
            $getTitles =mysqli_query($conn, "SELECT title FROM title")or die(mysqli_error($conn));
            if(mysqli_num_rows($getTitles)>0){
                return $getTitles;
            }
        }
    }

?>