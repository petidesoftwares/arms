<?php
    require("../backend/admin-task-function.php");
    $session = getCurrentSession();
    $currentSession = 0;
    foreach($session as $c_session){
        $currentSession = $c_session['year'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../arms.css/base-css.css"> -->
    <link rel="stylesheet" href="../arms.css/admin.css">
    <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/admin.js"></script>
    <title>View Students</title>
</head>
<body>
    <div class="menu-bar" onclick="showMenu()">
        <div class="menu-frame">
            <div class="menu-icon-bar-1"></div>
            <div class="menu-icon-bar-2"></div>
            <div class="menu-icon-bar-3"></div>
        </div>
    </div>
    <div id="viewstudent-title">VIEW STUDENTS</div>
    <div id="student-view-option-pane">
        <div class="rounded-corner-btn student-view-option" id="all-student-pane"><input type="radio" name="student_type" id="all-students" onclick="checkAllStudents()"><label for="all-students">All Students</label> </div>
        <div class="rounded-corner-btn student-view-option" id="selected-student-pane"><input type="radio" name="student_type" id="selected-students" onclick="checkSelectedStudents()"><label for="selected-students">Selected Students</label></div>
    </div>
    <div id="selected-student-form">
        <div>
            <input type="radio" name="selected_students_options" id="by-level" onclick="checkByLevel()"><label for="by-level">By Level</label>
            <input type="radio" name="selected_students_options" id="by-status" onclick="checkByStatus()"><label for="by-status">By Status</label>
        </div>
        <div class="selected-student-form2" id="selected-student-form-level1">
            <select name="level" id="select-level" onchange = "getSelectedStudents()">
                <option>Select Level</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>
            </select>
            <input type="text" name="selected_students_options" id="by-level-session" value="<?php echo $currentSession?>">
        </div>
        <div class="selected-student-form2" id="selected-student-form-level2">
            <select name="status" id="select-status">
                <option>Select Status</option>
            </select>
            <input type="text" name="selected_students_options" id="by-status-session" value="Session"> 
        </div>
    </div>
    <div class="col-12 col-m-12" id="student-viewport">
        <div class="col-5 col-m-5" id="list-view"></div>
        <div class="col-4 col-m-4" id="bio-data-view">
            <div id="student_photo"></div>
            <div>
                <table id="biodata-table">

                </table>
            </div>
        </div>
    </div>
    
</body>
</html>