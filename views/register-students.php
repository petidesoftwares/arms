<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../custom-css/base-customstyle.css">
    <link rel="stylesheet" href="../arms.css/upload-course-student.css">
    <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/course-student-upload.js"></script>
    <title>Register Students</title>
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
        <div class="col-12">
            <div class="col-12" id="page-title">REGISTER NEW STUDENTS</div>
            <div class="student-upload-tabs" id="batch-upload" onclick="batchUpload()">Batch</div><div class="student-upload-tabs" id="single-upload" onclick="singleUpload()">Single</div></div>
            <div class="col-3"></div>
            <div class="col-7" id="form-pane">
                <form enctype="multipart/form-data" id="studentRegForm">
                    <input type="file" name="file" class ="uploadFile_style" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                    <div class="col-spacer"></div>
                    <input type="submit" name="submit" value="Upload New Students" class="btn-large rounded-corner-btn submit_btn_style" id="uploadStudent_btn"/>
                </form>
                <div class="col-12 upload-response-pane" id="student-upload-response"></div>
                <div id="sample-file-pane">
                    <button name="get-sample-file" id="get-sample-file">Download sample file for data preparation</button>
                </div>
            </div>
            <div class="col-7" id ="single-upload-form">
                <label for="admission-session">Admission Session</label><select name="admission_session" id="admission_session">

                </select><br>
                <input type="text" name="reg_number" id="reg_number" placeholder="Enter Matric. or Jamb reg. number">
                <input type="text" name="fname" id="fname" placeholder="Enter first name">
                <input type="text" name="surname" id="surname" placeholder="Enter surname"><br>
                <label for="admission-level">Admission Level</label><select name="admission_level" id="admission_level">
                    <option value="100">100</option>
                    <option value="200">100</option>
                    <option value="300">100</option>
                </select><br>
                <button name="submit_student" id="submit_student" onclick="submitStudent()">Submit</button>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</body>
</html>