<?php
    if(isset($_POST)){
        $allenrolledCourses = $_POST['allenrolledCourses'];
        $allCourses = json_decode($allenrolledCourses, false);
        echo($allCourses[1]->code);
    }
?>