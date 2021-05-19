<?php
    if(isset($_POST)){
        $level = $_POST['level'];

        require('db_conn.php');
        if($conn){
            $code = array();
            $queryCourseCode = mysqli_query($conn, "SELECT code FROM course WHERE level_taken =".$level."") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryCourseCode)>0){
                while($rows = mysqli_fetch_assoc($queryCourseCode)){
                    $code[] = $rows;
                }
                echo json_encode($code);
            }else {
                echo "failed";
            }
        }
    }

?>