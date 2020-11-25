<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../custom-css/base-customstyle.css">
    <link rel="stylesheet" href="../arms.css/admin.css">
    <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/admin.js"></script>
    <title>Upload Result</title>
</head>
<body>
    <div class="col-12-custom">
        <div class="col-1 menu-bar" onclick="showMenu()">
            <div class="menu-frame">
                <div class="menu-icon-bar-1"></div>
                <div class="menu-icon-bar-2"></div>
                <div class="menu-icon-bar-3"></div>
            </div>
        </div><div class="col-10"></div>
        <div class="col-12 all-page-title" id="">UPLOAD STUDENT RESULT</div>
        <div class="col-3"></div>
        <div class="col-7">
            <div class="rounded-corner-btn att-semester"><input type="radio" name="result-semester-upload" id="fs-result-upload"><label for="fs-result-upload">First Semester</label></div>
            <div class="rounded-corner-btn att-semester"><input type="radio" name="result-semester-upload" id="ss-result-upload"><label for="ss-result-upload"></label>Second Semester</div>
            <div class="att-level">
                <select name="level" id="upload-result-level" class="rounded-corner-btn select-level-style" onchange="getCurrent_Reseat()">
                <option>Select Level</option>
                <option value="voom">voom</option>
                </select>
            </div>
            <div class="current-repeat-option" id="current-repeat-option">
                <input type="radio" name="curent-repeat" id="current"><label for="current">Current</label>
                <input type="radio" name="curent-repeat" id="reseat"><label for="reseat">Reseat</label>
            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-1"></div><div class="course-list"> Course List</div><div class="upload-form-pane">Form</div> <div class="col-1"></div>
    </div>
</body>
</html>