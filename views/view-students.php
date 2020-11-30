<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../custom-css/base-customstyle.css">
    <link rel="stylesheet" href="../arms.css/admin.css">
    <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/admin.js"></script>
    <title>View Students</title>
</head>
<body>
    <div class="col-1 menu-bar" onclick="showMenu()">
        <div class="menu-frame">
            <div class="menu-icon-bar-1"></div>
            <div class="menu-icon-bar-2"></div>
            <div class="menu-icon-bar-3"></div>
        </div>
    </div><div class="col-10"></div>
    <div class="col-12" id="viewstudent-title">VIEW STUDENTS</div>
    <div class="col-3"></div>
    <div id="student-view-option-pane">
        <div class="rounded-corner-btn student-view-option" id="all-student-pane"><input type="radio" name="student_type" id="all-students" onclick="checkAllStudents()"><label for="all-students">All Students</label> </div>
        <div class="rounded-corner-btn student-view-option" id="selected-student-pane"><input type="radio" name="student_type" id="selected-students" onclick="checkSelectedStudents()"><label for="selected-students">Selected Students</label></div>
    </div>
    <!-- <div class="col-2"></div> -->
    <div id="selected-student-form">
        <input type="radio" name="selected_students_options" id="by-level" onclick="checkByLevel()"><label for="by-level">By Level</label>
        <input type="radio" name="selected_students_options" id="by-status" onclick="checkByStatus()"><label for="by-status">By Status</label>
        <div class="selected-student-form2" id="selected-student-form-level1">
            <select name="level" id="select-level">
                <option>Select Level</option>
            </select>
            <input type="text" name="selected_students_options" id="by-level-session" value="Session">
        </div>
        <div class="selected-student-form2" id="selected-student-form-level2">
            <select name="status" id="select-status">
                <option>Select Status</option>
            </select>
            <input type="text" name="selected_students_options" id="by-status-session" value="Session"> 
        </div>
    </div>
    <div class="col-12" id="student-viewport">
        <div id="side-space"></div>
        <div class="col-5" id="list-view"></div>
        <div class="col-4" id="bio-data-view">Bio data view</div>
    </div>
    
</body>
</html>