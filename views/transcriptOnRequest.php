<?php
    if(isset($_POST)){
        $matno = $_POST['t_matno'];
        $session = $_POST['transcript_session'];
        $level = $_POST['transcript-level'];
        echo $matno;
    }
?>