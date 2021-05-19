<?php
    if(isset($_POST)){
        $code = $_POST['code'];
        $level = $_POST['level'];
        $matnum = $_POST['matnum'];
        $session = $_POST['session'];
        require('db_conn.php');
        if($conn){
            $queryScore = mysqli_query($conn, "SELECT score FROM course_registration WHERE 
            matno ='".$matnum."' AND level =".$level." AND code ='".$code."' AND session = ".$session." ") 
            or die(mysqli_error($conn));
            if(mysqli_num_rows($queryScore)>0){
                $score = mysqli_fetch_assoc($queryScore);
                echo $score['score'];
            }else {
                echo "Score not found.";
            }

        }
    }

?>