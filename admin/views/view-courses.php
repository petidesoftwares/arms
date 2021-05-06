<?php
    require("../backend/admin-task-function.php");
    $courses = getCourses();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arms.css/admin.css">
    <title>Document</title>
</head>
<body>
    <div class="menu-bar" onclick="showMenu()">
        <div class="menu-frame">
            <div class="menu-icon-bar-1"></div>
            <div class="menu-icon-bar-2"></div>
            <div class="menu-icon-bar-3"></div>
        </div>
    </div>
    <div id = "course-view-pane">
        <table>
            <thead id = "grey-row">
                <th>S/N</th>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>UNITS</th>
                <th>LEVEL TAKEN</th>
                <th>SEMESTER</th>
                <th>TAKEN BY</th>
                <th>STATUS</th>
                <th>EDITOR</th>
            </thead>
            <tbody>
                <?php
                    $s_n=0;
                    foreach($courses as $course){
                        $s_n++;
                        if($s_n%2 ==0){
                            echo '<tr id = "grey-row"><td>'.$s_n.'</td><td id = "code_'.$s_n.'">'.$course['code'].'</td><td id = "title_'.$s_n.'">'.$course['title'].'</td><td id = "units_'.$s_n.'">'.$course['units'].'</td><td id = "level_'.$s_n.'">'.$course['level_taken'].'</td><td id = "semester_'.$s_n.'">'.$course['semester'].'</td><td id = "takenby_'.$s_n.'">'.$course['taken_by'].'</td><td id = "starus_'.$s_n.'">'.$course['status'].'</td><td class = "edit-course-btn" onclick = "getEditorPane('.$s_n.')"><button>Edit Record</button></td></tr>';
                        }else{
                            echo '<tr><td>'.$s_n.'</td><td id = "code_'.$s_n.'">'.$course['code'].'</td><td id = "title_'.$s_n.'">'.$course['title'].'</td><td id = "units_'.$s_n.'">'.$course['units'].'</td><td id = "level_'.$s_n.'">'.$course['level_taken'].'</td><td id = "semester_'.$s_n.'">'.$course['semester'].'</td><td id = "takenby_'.$s_n.'">'.$course['taken_by'].'</td><td id = "status_'.$s_n.'">'.$course['status'].'</td><td class = "edit-course-btn" onclick = "getEditorPane('.$s_n.')"><button>Edit Record</button></td></tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id = "course-edito-pane">
        <input type="text" name="" id="course-code">
        <input type="text" name="" id="course-title">
        <input type="number" name="" id="course-units">
        <input type="number" name="" id="course-level_taken">
        <input type="text" name="" id="course-semester">
        <input type="text" name="" id="course-takenby">
        <input type="text" name="" id="course-status">
        <button id ="update-course-btn" onclick = "updateCourseDetails();">Update</button>
    </div>
</body>
</html>