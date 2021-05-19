<?php
    require("../backend/admin-task-function.php");
    $sessions = getSessions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arms.css/admin.css">
    <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/admin.js"></script>
    <title>Edit Result</title>
</head>
<body>
    <div class="menu-bar" onclick="showMenu()">
        <div class="menu-frame">
            <div class="menu-icon-bar-1"></div>
            <div class="menu-icon-bar-2"></div>
            <div class="menu-icon-bar-3"></div>
        </div>
    </div>
    <div id = "edit-result-form">
        <input type="text" id="edit-matnum" placeholder = "Enter Student Matric. Number">
        <select name = "session" id="session">
            <option>Select Session</option>
            <?php
                        $secondYear=1;
                        foreach($sessions as $session){
                            $secondYear+= $session['year'];
                            echo '<option value="'.$session['year'].'">'.$session['year'].'/'.$secondYear.'</option>';
                        }
                    ?>
        </select>
        <select name="course-level" id="course-level" onchange = "getCourseCode()">
            <option>Select Course Level</option>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="300">300</option>
            <option value="400">400</option>
            <option value="500">500</option>
        </select>
        
        <select name="course-Code" id="course-code" onchange = getScore()></select>
        <input type="number" name="" id="score" placeholder = "Edit Score">
        <button id = "update-score-btn" onclick = "updateScore();">Update Score</button>
    </div>
    <div id = "edit-student-result-response-pane"></div>
</body>
</html>