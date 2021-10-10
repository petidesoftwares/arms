<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("Locatoin:../index.php");
    }else{
    require("../backend/student-functions.php");
    $bioData = getStudentProfileBiodata($_SESSION['id']);
    $studentLevel =getCurrentLevel($_SESSION['id']);
    $currentSession = getCurrentSession();
    $currentSemester = getCurrentSemester($currentSession, $studentLevel);
    $admissionSession = getStudentAdmissionSession($_SESSION['id']);
    $studentStatus = getStudentStatus($currentSession, $bioData['matno']);
    $studentResult = json_decode(individualStudentResult($bioData['matno'],$currentSession,$studentLevel,$currentSemester), false);
    $totalRegUnits = 0;
    if($studentResult->cumm_units == 0 || $studentResult->cumm_units == null){
        $totalRegUnits = 0;
    }else{
        $totalRegUnits = $studentResult->cumm_units;
    }

    $standing ="";
    if($studentResult == "Error!"){
        $standing = "Not Registered";
    }else{
        if($studentResult->fSemesterFailedCourses=='NIL' && $studentResult->sSemesterFailedCourses=='NIL'){
            $standing = "Clear Standing";
        }elseif ($studentResult->fSemesterFailedCourses !='NIL' && $studentResult->sSemesterFailedCourses=='NIL'){
            $newArray = explode(" ", $studentResult->fSemesterFailedCourses);
            $numOfFailures = count($newArray)-1;
            $standing = "R". $numOfFailures;
        }elseif ($studentResult->fSemesterFailedCourses =='NIL' && $studentResult->sSemesterFailedCourses!='NIL'){
            $newArray = explode(" ", $studentResult->fSemesterFailedCourses);
            $numOfFailures = count($newArray)-1;
            $standing = "R". $numOfFailures;
        }elseif ($studentResult->fSemesterFailedCourses !='NIL' && $studentResult->sSemesterFailedCourses!='NIL'){
            $stringContent = $studentResult->fSemesterFailedCourses." ".$studentResult->fSemesterFailedCourses;
            $newArray = explode(" ", $stringContent);
            $standing = "R". count($newArray);// To be Updated
        }
    }

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
    <title>Profile</title>
</head>
<body>
    <div class = "row">
        <div class="col-12" id = "page-header"><img src="../images/ndu_bg_logo.png" alt="logo"> <p>NIGER DELTA UNIVERSITY <br><span>Wilberforce Island</span</p></div>
    </div>
    <div class ="row" id = "activity-title"> Student Profile</div>
    <div class="row">

        <!-- <div class="col-2" >
            <img src=" ../images/human.png" alt="profile-photo" id ="profile-photo-default">
        </div> -->
        <div class="col-3" id = "profile-photo-pane">
            <div id = "profile-photo" style = "background-image:url('../images/African-Students.jpg');"></div>
        </div>
        <div class ="col-9" id ="profile-details">
            <table class="col-6 profile-table">
                <tr><td>Matric Number:</td><td class="profiles"><?php echo $bioData['matno']; ?></td></tr>
                <tr><td>Surname:</td><td class="profiles"><?php echo $bioData['surname']; ?></td></tr>
                <tr><td>First Name:</td><td class="profiles"><?php echo $bioData['firstname']; ?></td></tr>
                <tr><td>Other Name:</td><td class="profiles"><?php echo $bioData['othername']; ?></td></tr>
                <tr><td>Email:</td><td class="profiles"><?php echo $bioData['email']; ?></td></tr>
            </table>
            <table class="col-3 profile-table">
                <tr><td>Level:</td><td class="profiles"><?php echo $studentLevel; ?></td></tr>
                <tr><td>Status:</td><td class="profiles"><?php echo  $studentStatus; ?></td></tr>
                <tr><td>Standing:</td><td class="profiles"><?php echo $standing; ?></td></tr>
                <tr><td>Total Reg Units:</td><td class="profiles"><?php echo $totalRegUnits; ?></td></tr>
<!--                <tr><td>Fees Status</td><td class="profiles">Cleared</td></tr>-->
            </table>
            <table class="col-3 profile-table">
                <tr><td>Current Grade:</td><td class="profiles">None</td></tr>
                <tr><td>100L C.G.P.A:</td><td class="profiles">None</td></tr>
            </table>
        </div>
    </div>
</body>
</html>
        <?php
    }
?>