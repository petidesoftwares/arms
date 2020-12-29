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
        <div class="col-8">
            <div class="rounded-corner-btn att-semester"><input type="radio" name="result-semester-upload" id="fs-result-upload" value="First"><label for="fs-result-upload">First Semester</label></div>
            <div class="rounded-corner-btn att-semester"><input type="radio" name="result-semester-upload" id="ss-result-upload" value = "Second"><label for="ss-result-upload">Second Semester</label></div>
            <div class="att-level">
                <select name="level" id="upload-result-level" class="rounded-corner-btn select-level-style" onchange="getCurrent_Reseat()">
                <option>Select Level</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>
                </select>
            </div>
            
            <div class="current-repeat-option" id="current-repeat-option">
                <input type="radio" name="curent-repeat" id="current" value="current" ><label for="current" onclick = "getCurrentCourses()">Current</label>
                <input type="radio" name="curent-repeat" id="reseat" value ="reseat" ><label for="reseat" onclick = "getReseatCourses()">Reseat</label>
            </div>
        </div>
        <div class = "col-12-custom" id="result-batch-upload">
            <div class="col-1"></div>
            <div class="course-list" id="course-table">
                <table id = "result-course-table">
                    <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Units</th>
                        <th>Download Result Data File</th>
                    </thead>
                    <tbody id="course-table-body">
                    </tbody>
                </table>
            </div>
            <div class="upload-form-pane">
                <div id="form-pane">
                    <form enctype="multipart/form-data" id="resultUploadForm">
                        <input type="file" name="file" class ="uploadFile_style" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                        <input type="hidden" name="code" id="course-code">
                        <div class="col-spacer"></div>
                        <input type="submit" name="submit" value="Upload Result" class="btn-large rounded-corner-btn submit_btn_style" id="uploadResult_btn" onclick = "resultBatchUpload()"/>
                    </form>
                    <div class="col-12 upload-response-pane" id="result-upload-response"></div>
                </div> 
            </div> 
            <div class="col-1"></div>
        </div>
        <div class = "col-12-custom" id="result-form-upload">
            <!-- <div class="col-1"></div>
            <div class="col-1"></div>
            <div class="course-list">Course List</div>
            <div class="upload-form-pane">Form</div> 
            <div class="col-1"></div> -->
        </div>
        
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