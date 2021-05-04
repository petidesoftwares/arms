<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("Locatoin:../index.php");
    }else{
        require("../backend/student-functions.php");
        $homeProfile = getStudentNameAndLevel($_SESSION['id']);
        $currentSession = getCurrentSession();
        $admissionSession = getStudentAdmissionSession($_SESSION['id']);
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../student-css/student-base-style.css">
        <link rel="stylesheet" href="../student-css/header.css">
        <link rel="stylesheet" href="../student-css/student.css">
        <title>Home</title>
    </head>
    <body>
        <div class = "row">
            <div class="col-12" id = "page-header"><img src="../images/ndu_bg_logo.png" alt="logo"> <p>NIGER DELTA UNIVERSITY <br><span>Wilberforce Island</span</p></div>
        </div>
        <div class ="row" id ="image-header-row">
            <!-- <div class="col-2" >
                <img src=" ../images/human.png" alt="profile-photo" id ="profile-photo-other-default">
            </div> -->
            <div class="col-2" id = "profile-photo-others-pane">
                <div id = "profile-photo-others" style = "background-image:url('../images/African-Students.jpg');"></div>
            </div>
            <div class = "col-10" id = "student-profile-name"> 
                <?php 
                    foreach($homeProfile as $profile){
                        if(array_key_exists('othername', $profile)){
                            echo $profile['surname'].", ".$profile['firstname']." ".$profile['othername'];
                        }else {
                            echo $profile['surname'].", ".$profile['firstname'];
                        }
                    } 
                ?> 
                <br><span>
                            <?php 
                                $studentLevel = "";
                                if($currentSession == $admissionSession){
                                    $studentLevel = 100;
                                }else{
                                    $studentLevel = $currentSession - $admissionSession;
                                }

                                echo $studentLevel." Level";
                            ?>
                     </span></div>
        </div>
        <div class = "row">
            <div class ="col-3">
                <a href="fees-payment.php">Pay School Fees</a>
                <a href="course-reg.php">Course Enrollment</a>
                <a href="student-profile.php">View Profile</a>
            </div>
            <div class ="col-3">
            <a href="course-result.php">View Result</a>
            <a href="">Download Exam Time Table</a>
            </div>
            <div class ="col-3">
            <a href="request-extra-units.php">Request For Extra Units</a>
            <a href="request-transcript.php">Request for transcript</a>
            </div>
            <div class ="col-3" id = "activity-track-pane"></div>
        </div>
    </body>
    </html>
<?php
    }
?>