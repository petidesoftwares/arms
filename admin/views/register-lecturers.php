<?php
    require("../backend/admin-task-function.php");
    $titles = getTitles();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../custom-css/base-customstyle.css"> -->
    <link rel="stylesheet" href="../arms.css/upload-course-student.css">
    <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/course-student-upload.js"></script>
    <title>Register Lecturers</title>
</head>
<body>
    <div class="col-12 upload-lecturer-pane">
        <div class="menu-bar" onclick="showMenu()">
            <div class="menu-frame">
                <div class="menu-icon-bar-1"></div>
                <div class="menu-icon-bar-2"></div>
                <div class="menu-icon-bar-3"></div>
            </div>
        </div><div class="col-10"></div>
        <div id="upload-mother-pane">
            <div class="col-12" id="page-title">REGISTER NEW LECTURER</div>
            <div class="student-upload-tabs" id="batch-upload" onclick="batchUpload()">Batch</div><div class="student-upload-tabs" id="single-upload" onclick="singleUpload()">Single</div></div>
            <div class="col-3"></div>
            <div id="form-pane">
                <form enctype="multipart/form-data" id="lecturerRegForm">
                    <input type="file" name="file" class ="uploadFile_style" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                    <div class="col-spacer"></div>
                    <input type="submit" name="submit" value="Upload New Lecturers" class="btn-large rounded-corner-btn submit_btn_style" id="uploadLecturer_btn" onclick = "lecturerBatchUpload()"/>
                </form>
                <div class="col-12 upload-response-pane" id="lecturer-upload-response"></div>
                <div id="sample-file-pane">
                    <button name="get-sample-file" id="get-sample-file" onclick = "downloadLecturerRregistrationFile()">Download sample file for data preparation</button>
                </div>
            </div>
            <div class="col-7" id ="single-upload-form">
                <label for="title">Title</label><select name="title" id="title">
                    <?php
                        foreach($titles as $title){
                            echo '<option value="'.$title['title'].'">'.$title['title'].'';
                        }
                    ?>
                </select><br>
                <input type="text" name="l_fname" id="l_fname" placeholder="Enter first name">
                <input type="text" name="l_surname" id="l_surname" placeholder="Enter surname">
                <input type="number" name="mobile" id="mobile" placeholder="Enter phone number"><br>
                <button name="submit_student" id="submit_student" onclick="submitLecturer()">Submit</button>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="col-12-custom" id = 'modal'>
        <!-- <input type = 'button' value = 'X' onclick = 'hideModal()' id = 'closeModal' /> -->
        <div class="col-3"></div>
        <div class="col-5" id="validation-info-board">
            <h3>Message</h3>
            <div id="validation-info"></div>
            <button id ="clear-modal" onclick = 'hideModal()'>OK</button>
        </div>
        <div class="col-3"></div>
    </div>
</body>
</html>