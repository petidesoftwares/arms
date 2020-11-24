<?php
class DB_CONNECTION{
    var $HOST='localhost';
    var $USER_NAME='root';
    var $PASSWORD = '';
    var $DB='myschool_arms';
    
    function getHost(){
        return $this->HOST;
    }
    function getUsername(){
        return $this->USER_NAME;
    }
    function getPassword(){
        return $this->PASSWORD;
    }
    function getDB(){
        return $this->DB;
    }

    function createConnection(){
        $conn = mysqli_connect($this->HOST,$this->USER_NAME,$this->PASSWORD) or die('No Connection Established');
        if($conn){
            if(mysqli_select_db($conn, $this->DB)==true){
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