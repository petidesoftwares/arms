<?php
    require("../backend/admin-task-function.php");
    $currentSession = getCurrentSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arms.css/admin.css">
    <script src="../custom-jscript/admin.js"></script>
    
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
        <h3>Course Allocation</h3>
        <div>
            <label for="current_session">Select Current Session: </label><select name="current_session" id="current_session">
                <?php
                    foreach($currentSession as $session){
                        echo '<option value="'.$session['year'].'">'.$session['year'].'</option>';
                    }
                ?>
            </select><br>
            <label for="level">Level:</label>
            <select name="level" id="level" onchange = "getCourseByLevel()">
                <option value="">Select Level</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>
            </select><br>
            <label for="semester">Semester:</label>
            <select name="semester" id="semester" onchange = "getCourseBySemester()">
                <option value="">Select Semester</option>
                <option value="First">First Semester</option>
                <option value="Second">Second Semester</option>
            </select>
        </div>
        <div id="course-alloction-spread">
            <table>
                <thead>
                    <th>S/N</th>
                    <th>COURSE CODE</th>
                    <th>COURSE TITLE</th>
                    <th>ALLOCATED TO</th>
                </thead>
                <tbody id="course-allocation-tbody">
                        
                </tbody>
            </table>
        </div>
        <div>
            <input type="button" value="SUBMIT" id="submit_course_allocation" onclick = "submitCourseAllocation()">
        </div>
    </div>
</body>
</html>