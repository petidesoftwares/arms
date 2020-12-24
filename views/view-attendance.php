<?php
    require("../backend/admin-task-function.php");
    $options = getAllOptions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../custom-css/base-customstyle.css">
    <link rel="stylesheet" href="../arms.css/admin.css">
    <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
    <script src="../custom-jscript/admin.js"></script>
    <title>View Attendance</title>
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
        <div class="col-12 all-page-title" id="att-page-title">ATTENDANCE SHEET</div>
        <div class="col-3"></div>
        <div class="col-8">
            <div class="rounded-corner-btn att-semester"><input type="radio" name="semester" id="first-semester" value ="First"> <label for="first-semester" onclick = "activateLevel()">First Semester</label></div>
            <div class="rounded-corner-btn att-semester"><input type="radio" name="semester" id="second-semester" value="Second"> <label for="second-semester" onclick = "activateLevel()">Second Semester</label></div>
            <div class="att-level"><select name="select-att-level" id="select-att-level" class="rounded-corner-btn select-level-style" onchange ="getAttendanceCourseList()" disabled>
                <option>Select Level</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>
            </select></div>
            <!-- <div id="att-option"> -->
                <select name="select_att_option" id="select_att_option" onchange = "getAttendanceWithOption()">
                    <?php
                        foreach($options as $option){
                            echo "<option value=".$option['option'].">".$option['option']."</option>";
                        }
                    ?>
                </select>
            <!-- </div> -->
            <!-- <button class="rounded-corner-btn gen-att" id="att-btn">Generate Attendance</button> -->
        </div>
        <div class="col-1"></div>
        <div class="col-4" id ="course-table-display-pane">
            <table id = "course-table">
                <thead>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Units</th>
                </thead>
                <tbody id="course-table-body">
                </tbody>
            </table>
        </div>
        <div class="col-6" id="att-sheet">
        <div>
            <form action="../backend/attendance-sheet-pdf.php" method="post" target="_blank">
                <input type="hidden" name="course_code" id = "course_code">
                <input type="hidden" name="units" id = "units">
                <input type="hidden" name="semester" id = "semester">
                <input type="hidden" name="session" id = "session">
                <input type="hidden" name="title" id = "title">
                <input type="submit" name="submit" value="Generate PDF">
            </form>
        </div>
            <table>
                <thead>
                    <th class="no-transform">S/n</th>
                    <th class="no-transform">Matric No.</th>
                    <th class="no-transform">Full Name</th>
                    <th class="no-transform">Sign</th>
                    <th class="no-transform">CA</th>
                    <th class = ""><div class="adjust-alignment">Exam</div></th>
                    <th class = ""><div class="adjust-alignment">Total</div</th>
                    <th class = ""><div class="adjust-alignment">Grade</div</th>
                    <th class = "transform-text">Remark</th>
                </thead>
                <tbody id = "att_list_body">

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>