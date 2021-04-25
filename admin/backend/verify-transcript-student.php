<?php
    if(isset($_POST)){
        require('db_conn.php');
        $matno = $_POST['matno'];
        $queryStdent = mysqli_query($conn, "SELECT matno FROM student WHERE matno ='".$matno."'")or die(mysqli_error($conn));
        if(mysqli_num_rows($queryStdent)>0){
            echo 'Student found';
        }
    }
?>