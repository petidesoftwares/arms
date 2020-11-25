<?php
    function getTitles(){
        require('db_conn.php');
        $conn = new DB_CONNECTION();
        $connection= $conn->createConnection();
        if($connection){
            $getTitles =mysqli_query($connection, "SELECT title FROM title")or die(mysqli_error($connection));
            if(mysqli_num_rows($getTitles)>0){
                return $getTitles;
            }
        }
    }

?>