<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $regNum = $_POST['regNum'];
        }
    }

?>