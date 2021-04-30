<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../student-css/student-base-style.css">
    <link rel="stylesheet" href="../student-css/header.css">
    <link rel="stylesheet" href="../student-css/student.css">
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
        <div class = "col-2" id = "student-profile-name"> Ide Peter</div>
        <div class = "col-8" id ="units-pane"><span class="col-4"><label for="total-units">Total Units:</label><input type="text" value="20" id="total-units" disabled>Units.</span> <span class="col-4"><label for="total-units">Min. Units:</label><input type="text" value="20" id="min-units" disabled>Units.</span> <span class="col-4"><label for="max-units">Max. Units:</label><input type="text" value="20" id="max-units" disabled>Units.</span></div>
    </div>
    <div class = "row table-pane" id = "course-enrollment-table-pane">
        <table class="table-format" id = "course-enrollment-table">
            <thead>
                <th>S/N</th>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Unit</th>
                <th>Course Status</th>
                <th>State</th>
            </thead>
            <tbody>

            </tbody>
        </table>
        <button id ="aplly-for-extra-unit-btn">Apply For Extra Units</button>
        <button id ="submit-course-enrollment-form">Submit</button>
    </div>
        
</body>
</html>