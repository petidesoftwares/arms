<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("Locatoin:../index.php");
    }else{
        require("../backend/student-functions.php");
        $homeProfile = getStudentNameAndLevel($_SESSION['id']);
        $currentSession = getCurrentSession();
        $matno = getMatNumber($_SESSION['id']);
        $currentLevel = getCurrentLevel($_SESSION['id']);
        $maxUnits = getMaxUnits($currentLevel);
        $minUnits = getMinUnits($currentLevel);

        $totalUnits = 0;
        $s_n = 0;
        $carryOverBody="";
        if($currentLevel >100){
            $carryOver = getCarryOverCourses($matno, $currentLevel, $currentSession);
            foreach($carryOver as $course){
                $s_n++;
                $totalUnits+=$course['units'];
                $carryOverBody.="<tr><td>".$s_n."</td><td>".$course['code']."</td><td>".$course['title'].'</td><td id = "course_'.$s_n.'">'.$course['units']."</td><td>".$course['semester']."</td><td>".$course['status'].'</td><td><input type="checkbox" value ="'.$course['code'].'" id ="checkbox_'.$s_n.'" checked></td></tr>';
            }
        }

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../student-css/student-base-style.css">
        <link rel="stylesheet" href="../student-css/header.css">
        <link rel="stylesheet" href="../student-css/student.css">
        <link rel="stylesheet" href="../student-css/modal.css">
        <script src="../student-jscripts/jquery-3.5.1.min.js"></script>
        <script src="../student-jscripts/students.js"></script>
        <title>Course Enrollment</title>
    </head>
    <body>
        <div class = "row">
            <div class="col-12" id = "page-header"><img src="../images/ndu_bg_logo.png" alt="logo"> <p>NIGER DELTA UNIVERSITY <br><span>Wilberforce Island</span</p></div>
        </div>
        <div class="row" id ="activity-title">Course Enrollment</div>
        <div class ="row" id ="image-header-row">
            <!-- <div class="col-2" >
                <img src=" ../images/human.png" alt="profile-photo" id ="profile-photo-other-default">
            </div> -->
            <div class="col-2" id = "profile-photo-others-pane">
                <div id = "profile-photo-others" style = "background-image:url('../images/African-Students.jpg');"></div>
            </div>
            <div class = "col-2" id = "student-profile-name"> <?php 
                        foreach($homeProfile as $profile){
                            if(array_key_exists('othername', $profile)){
                                echo $profile['surname'].", ".$profile['firstname']." ".$profile['othername'];
                            }else {
                                echo $profile['surname'].", ".$profile['firstname'];
                            }
                        } 
                    ?> </div>
            <div class = "col-8" id ="units-pane"><span class="col-4"><label for="total-units">Total Units:</label><input type="number" value="<?php echo $totalUnits;?>" id="total-units" disabled>Units.</span> <span class="col-4"><label for="min-units">Min. Units:</label><input type="text" value="<?php echo $minUnits; ?>" id="min-units" disabled>Units.</span> <span class="col-4"><label for="max-units">Max. Units:</label><input type="number" value="<?php echo $maxUnits; ?>" id="max-units" disabled>Units.</span></div>
        </div>
        <div class = "row table-pane" id = "course-enrollment-table-pane">
            <input type="hidden" name="matnum" value ="<?php echo $matno; ?>" id = "matnum">
            <input type="hidden" name="session" value ="<?php echo $currentSession; ?>" id = "session">
            <input type="hidden" name="level" value ="<?php echo $currentLevel; ?>" id = "level">
            <table class="table-format" id = "course-enrollment-table">
                <thead>
                    <th>S/N</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Unit</th>
                    <th>Semester</th>
                    <th>Course Status</th>
                    <th>State</th>
                </thead>
                <tbody>
                    <?php
                    $tableBody = "";
                    if($currentLevel == 100){
                        $courses = getCurrentCourses($currentLevel);
                        foreach($courses as $course){
                            $s_n++;
                            $tableBody.="<tr><td>".$s_n."</td><td>".$course['code']."</td><td>".$course['title'].'</td><td id = "course_'.$s_n.'">'.$course['units']."</td><td>".$course['semester']."</td><td>".$course['status'].'</td><td><input type="checkbox" value ="'.$course['code'].'" id ="checkbox_'.$s_n.'" onclick = "enrolCourse('.$s_n.');"></td></tr>';
                        }
                    }else{
                        $tableBody.$carryOverBody;
                        $courses = getCurrentCourses($currentLevel);
                        foreach($courses as $course){
                            $s_n++;
                            $tableBody.="<tr><td>".$s_n."</td><td>".$course['code']."</td><td>".$course['title'].'</td><td id = "course_'.$s_n.'">'.$course['units']."</td><td>".$course['semester']."</td><td>".$course['status'].'</td><td><input type="checkbox" value ="'.$course['code'].'" id ="checkbox_'.$s_n.'" onclick = "enrolCourse('.$s_n.');"></td></tr>';
                        }
                    }
                    echo $tableBody;
                    ?>
                </tbody>
            </table>
            <button id ="aplly-for-extra-unit-btn">Apply For Extra Units</button>
            <button id ="submit-course-enrollment-form" onclick = "submitCourseEnrollment();">Submit</button>
        </div>
        <div class="row" id = "modal" >
            <div id="close-modal-btn" onclick = "closeModal();">X</div>
            <div id = "modal-content"></div>
        </div>            
    </body>
    </html>
<?php
    }
?> 