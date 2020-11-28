<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $session = $_POST["session"]; 
            $code = $_POST["code"]; 
            $title = $_POST["title"]; 
            $unit = $_POST["unit"]; 
            $level = $_POST["level"]; 
            $option = $_POST["option"]; 
            $status = $_POST["status"]; 
            $min_pass_mark = $_POST["min_pass_mark"];
        }
    }
?>