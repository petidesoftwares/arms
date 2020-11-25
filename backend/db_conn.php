<?php
class DB_CONNECTION{
    
    var $cleardb_url;
    var $cleardb_server;
    var $cleardb_username;
    var $cleardb_password;

    public function __construct(){
        //Get Heroku ClearDB connection information
        $cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $cleardb_server   = $cleardb_url["host"];
        $cleardb_username = $cleardb_url["user"];
        $cleardb_password = $cleardb_url["pass"];
        $cleardb_db       = substr($cleardb_url["path"],1);

        $active_group = 'default';
        $query_builder = TRUE;
    }

    
    function getHost(){
        return $this->$cleardb_server;
    }
    function getUsername(){
        return $this->$cleardb_username;
    }
    function getPassword(){
        return $this->$cleardb_password;
    }
    function getDB(){
        return $this->$cleardb_db;
    }

    function createConnection(){
        $conn = mysqli_connect($this->$cleardb_server,$this->$cleardb_username,$this->$cleardb_password) or die('No Connection Established');
        if($conn){
            if(mysqli_select_db($conn, $this->$cleardb_db)==true){
                return $conn;
            }
        }
        return false;
    }
    function closeConnection(){
        mysqli_connection_close();
    }
}

?>