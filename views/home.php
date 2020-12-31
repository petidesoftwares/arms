<?php
    session_start();
    if(!isset( $_SESSION['id'])){
        header('Location:../preaccess/login-view.php');
    }else{
        require("../backend/admin-task-function.php");
        $sessions = getSessions();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../arms.css/base-css.css">
        <link rel="stylesheet" href="../arms.css/arms-1.css">
        <link rel="stylesheet" href="../arms.css/dashboard.css">
        <script src="../custom-jscript/jquery-3.5.1.min.js"></script>
        <script src="../custom-jscript/arms-index.js"></script>
        <title>Home</title>
    </head>
    <body>
        <div id="main-header">
            <div class="header"> 
                <div id="logo-pane"> 
                    <img src="../images/ndu_bg_logo.png" alt="logo" id="logo"/>
                </div>
                <p id="h1"> ACADEMIC RECORD MANAGMENT SYSTEM</p>
                <p id = "h3"> MY DEPARTMENT</p>
            </div>
            <div id="session-selection"> Academic Session:<select name="academic-session" id="academic-session" class="rounded-corner-btn">
                    <?php
                        $secondYear=1;
                        foreach($sessions as $session){
                            $secondYear+= $session['year'];
                            echo '<option value="'.$session['year'].'">'.$session['year'].'/'.$secondYear.'</option>';
                        }
                    ?>
                </select>
            </div>
            <hr id="header-seperator"/>
        </div>
        
        <div class="col-12 col-m-12" id="content-pane">  
            <div id="menu-list">
                <div class="col-1 col-m-1" id="close-menu" onclick="hideMenu();"><p class="arrow-left" ></p></div><div class="col-10 col-m-10" id="menu_header">Menu</div>
                <div class="col-12 col-m-12" id="list_item_pane">
                    <ul class="col-12 col-m-12 dashboard_ul">
                        <li class="list_items rounded-corner-btn" id="dashboard-menu" onclick="showDashboard()">Dashboard</li>
                        <li class="list_items rounded-corner-btn" id="uploadNewCourses" onclick="uploadCourseView()">Upload New Courses</li>
                        <li class="list_items rounded-corner-btn" id="registerStudent" onclick="registerStudents()">Register Students</li>
                        <li class="list_items rounded-corner-btn" id="registerLecturers" onclick="registerLecturers()">Register Lecturers</li>
                        <li class="list_items rounded-corner-btn" id="view_st" onclick="viewStudents()">View Students</li>
                        <li class="list_items rounded-corner-btn" id="gen_attendance" onclick="viewAttendance()">Attendance Sheet</li>
                        <li class="list_items rounded-corner-btn" id="upload_result" onclick="uploadResult()">Upload Result</li>
                        <li class="list_items rounded-corner-btn" id="view_gresult" onclick="viewGeneralResult()">View General Result</li>
                        <li class="list_items rounded-corner-btn" id="view_indiv_R" onclick="viewIndividualResult()">View Individual Student Result</li>
                        <li class="list_items rounded-corner-btn" id="gen_trnscript">Generate Transcript</li>
                        <li class="list_items rounded-corner-btn" id="view_Student_Status">View Student Status</li>
                        <li class="list_items rounded-corner-btn" id="add-second-admin">
                            <select name="second_admin" id="second_admin" onchange="addSecondAdmin()">
                                <option>Add Second Admin</option>
                                <option value="fresh_lecturer">New Lecturer</option>
                                <option value="existing_lecturer">Existing Lecturer</option>
                            </select>
                        </li>
                        <li class="list_items rounded-corner-btn" id="updateAcademicSession" onclick="updateSession()">Update Academic Session</li>
                    </ul>
                </div>
            </div><div class="col-8"></div>
            <div class="col-12-custom" id="display-pane"></div>
        </div>
    </body>
    </html>
<?php
    }
?>