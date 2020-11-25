<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../custom-css/base-customstyle.css">
    <link rel="stylesheet" href="../arms.css/upload-course-student.css">
    <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/course-student-upload.js"></script>
    <title>Course Upload</title>
</head>
<body>
    <div class="col-12 upload-course-pane">
        <div class="col-1 menu-bar" onclick="showMenu()">
            <div class="menu-frame">
                <div class="menu-icon-bar-1"></div>
                <div class="menu-icon-bar-2"></div>
                <div class="menu-icon-bar-3"></div>
            </div>
        </div><div class="col-10"></div>
        <div class="col-12" id="page-title">UPLOAD NEW COURSES</div>
        <div class="student-upload-tabs" id="batch-upload" onclick="batchUpload()">Batch</div><div class="student-upload-tabs" id="single-upload" onclick="singleUpload()">Single</div></div>
        <div class="col-3"></div>
        <div class="col-7" id="form-pane">
            <form enctype="multipart/form-data" id="courseRegForm">
                <input type="file" name="file" class ="uploadFile_style" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                <div class="col-spacer"></div>
                <input type="submit" name="submit" value="Upload New Courses" class="btn-large rounded-corner-btn submit_btn_style" id="uploadCourse_btn"/>
            </form>
            <div class="col-12 upload-response-pane" id="course-upload-response"></div>
            <div id="sample-file-pane">
                <button name="get-sample-file" id="get-sample-file">Download sample file for data preparation</button>
            </div>
        </div>
        <div class="col-7" id ="single-upload-form">
            <label for="academic-session">Session:</label><select name="academic_session" id="academic_session">

            </select><br>
            <input type="text" name="course_code" id="course_code" placeholder="Enter Course Code">
            <input type="text" name="course_title" id="course_title" placeholder="Enter Course Title">
            <input type="number" name="unit" id="unit" placeholder="Enter units"><br>
            <label>Semester:</label>
            <input type="radio" name="semester" id="first_semester"><label for="first_semester">First</label>
            <input type="radio" name="semester" id="second_semester"><label for="second_semester">Second</label><br>
            <label for="course-level">Level</label><select name="course_level" id="course_level">
                <option value="100">100</option>
                <option value="200">100</option>
                <option value="300">100</option>
            </select><br>
            <label for="course-optionl">Option:</label><select name="course_level" id="course_level">
                <!-- <option value="100">100</option>
                <option value="200">100</option>
                <option value="300">100</option> -->
            </select><br>
            <label for="course-status">Status/Type:</label><select name="course_level" id="course_level">
                <option value="100">100</option>
                <option value="200">100</option>
                <option value="300">100</option>
            </select><br>
            <input type="number" name="min_pass_mark" id="min_pass_mark" placeholder="Minimum Pass Score"><br>
            <button name="submit_student" id="submit_student" onclick="submitStudent()">Submit</button>
        </div>
        <div class="col-2"></div>
    </div>
</body>
</html>