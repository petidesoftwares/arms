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
    <div>
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
            </thead>
            <tbody>
                <?php
                    $s_n=0;
                    foreach($courses as $course){
                        $s_n++;
                        if($s_n%2 ==0){
                            echo '<tr id = "grey-row"><td>'.$s_n.'</td><td>'.$course['code'].'</td><td>'.$course['title'].'</td><td>'.$course['units'].'</td><td>'.$course['level_taken'].'</td><td>'.$course['semester'].'</td><td>'.$course['taken_by'].'</td><td>'.$course['status'].'</td></tr>';
                        }else{
                            echo '<tr><td>'.$s_n.'</td><td>'.$course['code'].'</td><td>'.$course['title'].'</td><td>'.$course['units'].'</td><td>'.$course['level_taken'].'</td><td>'.$course['semester'].'</td><td>'.$course['taken_by'].'</td><td>'.$course['status'].'</td></tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>