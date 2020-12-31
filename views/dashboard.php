<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="arms.css/base-css.css">
    <link rel="stylesheet" href="arms.css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="menu-bar" onclick="showMenu()">
        <div class="menu-frame">
            <div class="menu-icon-bar-1"></div>
            <div class="menu-icon-bar-2"></div>
            <div class="menu-icon-bar-3"></div>
        </div>
    </div>
    <div class="col-12 col-m-12" id="dashboard-item-pane">
        <div class="card-rows">
            <div class="dashboard-item" id="t-student">
                <div class="col-12 col-m-12 icon-holder">
                    <div class="col-2 col-m-2"></div>
                    <img src="../images/students.png" alt="students_icon" class="col-12 col-m-12">
                </div> 
                <div class="col-12 col-m-12 pane-name-text">Number Of Students<br>0</div>
            </div>
            <div class="dashboard-item" id="t-lecterer">
                <div class="col-12 col-m-12 icon-holder">
                    <div class="col-2 col-m-2"></div>
                    <img src="../images/lecturer2.png" alt="students_icon" class="col-12 col-m-12">
                </div> 
                <div class="col-12 col-m-12 pane-name-text">Number Of Lecturers<br>0</div>
            </div>
       
            <div class="dashboard-item" id="t-courses"> 
                <div class="col-12-col-m-12 icon-holder">
                    <div class="col-2 col-m-2"></div>
                    <img src="../images/courses.png" alt="students_icon" class="col-12 col-m-12">
                </div> 
                <div class="col-12 pane-name-text">Number Of Courses<br>0</div>
            </div>
        </div>
        <div class="card-rows">
            <div class="dashboard-item" id="t-levels">
                <div class="col-12 col-m-12 icon-holder">
                    <div class="col-2 col-m-2"></div>
                    <img src="../images/levels1.png" alt="students_icon" class="col-12 col-m-12">
                </div> 
                <div class="col-12 col-m-12 pane-name-text">Available Levels<br>0</div>
            </div>
            <div class="dashboard-item" id="active-students">
                <div class="col-12 col-m-12 icon-holder">
                    <div class="col-2 col-m-2"></div>
                    <img src="../images/student2.png" alt="students_icon" class="col-12 col-m-12">
                </div> 
                <div class="col-12 col-m-12 pane-name-text">Active Students<br>0</div>
            </div>
            <div class="dashboard-item" id="differred-students">
                <div class="col-12 col-m-12 icon-holder">
                    <div class="col-2 col-m-2"></div>
                    <img src="../images/human.png" alt="students_icon" class="col-12 col-m-12">
                </div> 
                <div class="col-12 col-m-12 pane-name-text">Differred Students<br>0</div>
            </div>
        </div>
    </div>
</body>
</html>