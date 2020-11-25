<?php
    
    //Get Heroku ClearDB connection information
    $cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server   = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db       = substr($cleardb_url["path"],1);

    $active_group = 'default';
    $query_builder = TRUE;

    $conn = mysqli_connect($this->$cleardb_server,$this->$cleardb_username,$this->$cleardb_password,$this->$cleardb_db) or die('No Connection Established');
    
    function closeConnection(){
        mysqli_connection_close();
    }

?>