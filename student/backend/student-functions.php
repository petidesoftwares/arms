<?php
    function getStudentNameAndLevel($id){
        require("db_conn.php");
        //check for othername
        $checkOthername = mysqli_query($conn, "SELECT othername FROM student_othernames WHERE student_id =".$id."") or die(mysqli_error($conn));
        if(mysqli_num_rows($checkOthername)>0){
            $queryStudentNameAndLevel = mysqli_query($conn, "SELECT surname, firstname, (SELECT othername FROM student_othernames WHERE student_id =".$id.") as othername FROM student WHERE student.id =".$id."") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryStudentNameAndLevel)>0){
                return $queryStudentNameAndLevel;
            }
        }else{
            $queryStudentNameAndLevel = mysqli_query($conn, "SELECT surname, firstname FROM student WHERE student.id =".$id."") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryStudentNameAndLevel)>0){
                return $queryStudentNameAndLevel;
            }
        }
    }

    function getStudentProfileBiodata($id){
        require("db_conn.php");
        if($conn){
            $queryData = mysqli_query($conn,"SELECT matno, firstname, surname, (SELECT othername FROM student_othernames WHERE student_othernames.student_id = ".$id.") AS othername, email FROM student WHERE id =".$id."") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryData)>0){
                $result =mysqli_fetch_assoc($queryData);
                return $result;
            }
        }
    }

    function getCurrentSession(){
        require('db_conn.php');
        if($conn){
            $querySessions = mysqli_query($conn, "SELECT year FROM academic_session ORDER BY year DESC LIMIT 1") or die(mysqli_error($conn));
            if(mysqli_num_rows($querySessions)>0){
                $sessionRow = mysqli_fetch_assoc($querySessions);
                return $sessionRow['year'];
            }
        }
    }

    function getStudentAdmissionSession($id){
        require('db_conn.php');
        if($conn){
            $queryAdmissionSession = mysqli_query($conn, "SELECT admission_session FROM student WHERE id =".$id."") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryAdmissionSession)>0){
                $row = mysqli_fetch_assoc($queryAdmissionSession);
                return $row['admission_session'];
            }
        }
    }

    function getCurrentLevel($id){
        $curentLevel = 0;
        if(getCurrentSession($id) == getStudentAdmissionSession($id)){
            $curentLevel = 100;
        }else{
            $curentLevel = getCurrentSession($id) - getStudentAdmissionSession($id);
        }
        return $curentLevel;
    }

    function getMatNumber($id){
        require('db_conn.php');
        if($conn){
            $getMatno = mysqli_query($conn, "SELECT matno FROM student WHERE id = ".$id."") or die(mysqli_error($conn));
            if(mysqli_num_rows($getMatno)>0){
                $row = mysqli_fetch_assoc($getMatno);
                return $row['matno'];
            }
        }
    }

    function getCurrentSemester($session, $level){
        require('db_conn.php');
        $firstSemesterStatus = false;
        $secondSemesterStatus = false;
        $currentSemester;
        if($conn) {
            $iterationQuery = mysqli_query($conn,"SELECT code FROM course_registration WHERE session =".$session." AND level = ".$level." AND score > 0") or die(mysqli_error($conn));
            if(mysqli_num_rows($iterationQuery)>0){
                while($row = mysqli_fetch_assoc($iterationQuery)){
                    $querySemester = mysqli_query($conn, "SELECT semester FROM course WHERE level_taken = ".$level." AND code ='".$row['code']."'") or die(mysqli_error($conn));
                    if(mysqli_num_rows($querySemester)>0){
                        $semester = mysqli_fetch_assoc($querySemester);
                        if($semester['semester'] =='First'){
                            $firstSemesterStatus = true;
                        }elseif ($semester['semester'] == 'Second'){
                            $secondSemesterStatus = true;
                        }else{
                            $firstSemesterStatus = false;
                            $secondSemesterStatus = false;
                        }
                    }
                }
                if($firstSemesterStatus == true && $secondSemesterStatus == true){
                    $currentSemester = "Second";
                }elseif ($firstSemesterStatus == true && $secondSemesterStatus == false){
                    $currentSemester = "First";
                }
            }else{
                $currentSemester = "First";
            }
        }
        return $currentSemester;
    }

    function getStudentStatus($currentSession, $matno){
        require('db_conn.php');
        $status ="";
        if($conn) {
            $checkSuspension = mysqli_query($conn, "SELECT matno FROM suspension_of_studies WHERE return_session>" . $currentSession . " AND response ='Granted' AND matno='" . $matno . "'") or die(mysqli_error($conn));
            if(mysqli_num_rows($checkSuspension)>0){
                $status = "Studies Suspended.";
            }else{
                $status = "Active.";
            }
        }
        return $status;
    }

    function getCarryOverCourses($matno, $currentLevel, $currentSession){
        require('db_conn.php');
        $prevLevel = $currentLevel-100;
        $prevSession = $currentSession-1;
        if($conn){
            $queryRegCourse = mysqli_query($conn, "SELECT code FROM course_registration WHERE level =".$prevLevel." AND session=".$prevSession." AND matno='".$matno."'") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryRegCourse)>0){
                while($codeRow = mysqli_fetch_assoc($queryRegCourse)){
                    $queryCarryOver = mysqli_query($conn, "SELECT code, title, units, semester, status FROM course WHERE level_taken =".$prevLevel." AND session_taken =".$prevSession." AND code != '".$codeRow['code']."'") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryCarryOver)>0){
                        return $queryCarryOver;
                    }
                }
            }
            
        }
    }

    function getCurrentCourses($level){
        require('db_conn.php');
        if($conn){
            $queryNewCourse = mysqli_query($conn, "SELECT code, title, units, semester, status FROM course WHERE level_taken =".$level."") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryNewCourse)>0){
                return $queryNewCourse;
            }
        }
    }

    function getMaxUnits($level){
        $maxUnits = 48;
        // if($level == 500){
        //     $maxUnits = 48;
        // }
        // else if($level == 400){
        //     $maxUnits = 6;
        // }
        // else if($level == 300){
        //     $maxUnits = 48;
        // }
        // else if($level == 200){
        //     $maxUnits = 48;
        // }
        // else{
        //     $maxUnits = 40;
        // }
        return $maxUnits;
    }

    function getMinUnits($level){
        $minUnits = 18;
        // if($level == 500){
        //     $minUnits = 24;
        // }
        // else if($level == 400){
        //     $minUnits = 6;
        // }
        // else if($level == 300){
        //     $minUnits = 24;
        // }
        // else if($level == 200){
        //     $minUnits = 24;
        // }
        // else{
        //     $minUnits = 40;
        // }

        return $minUnits;
    }

/**************** General Result Computation Starts Here *******************/

function getStudentGrade($score){
    $studentGrade;
    if($score>=70){
        $studentGrade='A';
    }elseif($score>=60 && $score<=69){
        $studentGrade='B';
    }elseif($score>=50 && $score<=59){
        $studentGrade='C';
    }elseif($score>=45 && $score<=49){
        $studentGrade='D';
    }elseif($score>=40 && $score<=44){
        $studentGrade='E';
    }else{
        $studentGrade='F';
    }
    return $studentGrade;
}

function getCourseGrade($studentGrade){
    $courseGrade =0;
    if($studentGrade=='A'){
        $courseGrade=5;
    }elseif($studentGrade=='B'){
        $courseGrade=4;
    }elseif($studentGrade=='C'){
        $courseGrade=3;
    }elseif($studentGrade=='D'){
        $courseGrade=2;
    }elseif($studentGrade=='E'){
        $courseGrade=1;
    }else{
        $courseGrade=0;
    }
    return $courseGrade;
}
function getGradePoint($unit,$courseGrade){
    return $unit*$courseGrade;
}
function getCumGradePoint($gradePoint){
    $cumGradePoint=0;
    $cumGradePoint+=$gradePoint;
    return $cumGradePoint;
}

function getIndividualResultRemarks($score){
    $remark = "";
    if($score>45){
        $remark="PASS";
    }else{
        $remark = "FAIL";
    }
    return $remark;
}

/*************************** Individual Result ***********************************/
function individualStudentResult($matno, $session, $level, $semester_in)
{
    require('db_conn.php');
    $resultArray = array();

    $headerData = array();
    $totalGradePoints = 0;
    $totalUnits = 0;
    $gpa = 0;
    $cumUnits = 0;
    $cumGradePoint = 0;
    $cgpa = 0;

    $totalUnitsPassed = 0;

    $lowerLevel = 0;
    $firstSemesterFailedCourses="";
    $secondSemesterFailedCourses = "";
    if ($semester_in == "First") {
        $semester = 'First';
    } else {
        $semester = 'Second';
    }
    /******************Verify if matno is registered for that session******************/
    $queryMatno = mysqli_query($conn, "SELECT DISTINCT matno FROM course_registration WHERE level =" . $level . " AND session =" . $session . " AND matno ='" . $matno . "'") or die(mysqli_error($conn));
    if (mysqli_num_rows($queryMatno) > 0) {
        $getStudentID = mysqli_query($conn, "SELECT id FROM student WHERE matno ='" . $matno . "'") or die(mysqli_error($conn));
        while ($id = mysqli_fetch_assoc($getStudentID)) {
            $verifyOthername = mysqli_query($conn, "SELECT othername FROM student_othernames WHERE student_othernames.student_id='" . $id['id'] . "'") or die(mysqli_error($conn));
            if (mysqli_num_rows($verifyOthername) > 0) {
                $queryStudentDetail = mysqLi_query($conn, "SELECT student.matno, student.surname, student.firstname, (SELECT student_othernames.othername FROM student_othernames WHERE student_othernames.student_id=student.id) AS
                    othername from student WHERE student.id='" . $id['id'] . "'") or die(mysqli_error($conn));
                while ($rowData = mysqli_fetch_assoc($queryStudentDetail)) {
                    $headerData[] = $rowData['matno'];
                    $headerData[] = $rowData['firstname'];
                    $headerData[] = $rowData['surname'];
                    $headerData[] = $rowData['othername'];
                }

            } else {
                $queryStudentDetail = mysqLi_query($conn, "SELECT student.matno, student.surname, student.firstname FROM student WHERE student.id='" . $id['id'] . "'") or die(mysqli_error($conn));
                while ($rowData = mysqli_fetch_assoc($queryStudentDetail)) {
                    $headerData[] = $rowData['matno'];
                    $headerData[] = $rowData['firstname'];
                    $headerData[] = $rowData['surname'];
                }
            }
        }

        /**********************Query student result*************************/
        if ($semester == "First" && $level == 100) {
            $queryResult = mysqli_query($conn, "SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                course.code = course_registration.code AND course_registration.matno = '" . $matno . "' AND course.semester = '" . $semester . "' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
            if (mysqli_num_rows($queryResult) > 0) {
                while ($result = mysqli_fetch_assoc($queryResult)) {
                    $singleCourseResultArray = array();
                    $singleCourseResultArray[] = $result['code'];
                    $singleCourseResultArray[] = $result['title'];
                    $singleCourseResultArray[] = $result['units'];
                    $singleCourseResultArray[] = $result['score'];
                    $singleCourseResultArray[] = getStudentGrade($result['score']);
                    $singleCourseResultArray[] = getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                    $singleCourseResultArray[] = getIndividualResultRemarks($result['score']);

                    $resultArray[] = $singleCourseResultArray;

                    $totalUnits += $result['units'];
                    $totalGradePoints += getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                    if ($result['score'] > 45) {
                        $totalUnitsPassed += $result['units'];
                    }
                }

                /****** Note: For first semester year one, CGPA = GPA, CUMM.UNITS = TOTAL UNITS and CUMM.GRADEPOINT = TOTALGRADEPOINT**********/
                $gpa = $totalGradePoints / $totalUnits;
                $cumUnits = $totalUnits;
                $cumGradePoint = $totalGradePoints;
                $cgpa = number_format((float)$gpa, '2', '.', '');

                /***********************Query first semester failed courses**************************/
                $queryFailedCourses = mysqli_query($conn, "SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '" . $matno . "' AND course.semester = 'First' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryFailedCourses) > 0) {
                    while ($failedCourse = mysqli_fetch_assoc($queryFailedCourses)) {
                        $firstSemesterFailedCourses .= $failedCourse['code'] . " ";
                    }
                } else {
                    $firstSemesterFailedCourses = "NIL";
                }
                $secondSemesterFailedCourses = "NIL";
            } else {
                return "Error! No Result For Selected Semester";
            }
        }
        if ($semester == "Second" && $level == 100) {
            $queryResult = mysqli_query($conn, "SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                course.code = course_registration.code AND course_registration.matno = '" . $matno . "' AND course.semester = '" . $semester . "' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
            if (mysqli_num_rows($queryResult) > 0) {
                while ($result = mysqli_fetch_assoc($queryResult)) {
                    $singleCourseResultArray = array();
                    $singleCourseResultArray[] = $result['code'];
                    $singleCourseResultArray[] = $result['title'];
                    $singleCourseResultArray[] = $result['units'];
                    $singleCourseResultArray[] = $result['score'];
                    $singleCourseResultArray[] = getStudentGrade($result['score']);
                    $singleCourseResultArray[] = getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                    $singleCourseResultArray[] = getIndividualResultRemarks($result['score']);

                    $resultArray[] = $singleCourseResultArray;

                    $totalUnits += $result['units'];
                    $totalGradePoints += getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));

                    if ($result['score'] > 45) {
                        $totalUnitsPassed += $result['units'];
                    }
                }

                $gpa = $totalGradePoints / $totalUnits;
                $cumUnits += $totalUnits;
                $cumGradePoint += $totalGradePoints;
                /***********Calculation of cummulaties****************/
                $queryFirstSemesterResult = mysqli_query($conn, "SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                    course.code = course_registration.code AND course_registration.matno = '" . $matno . "' AND course.semester = 'First' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryFirstSemesterResult) > 0) {
                    while ($fs_result = mysqli_fetch_assoc($queryFirstSemesterResult)) {
                        $cumUnits += $fs_result['units'];
                        $cumGradePoint += getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_result['score'])));

                        if ($fs_result['score'] > 45) {
                            $totalUnitsPassed += $fs_result['units'];
                        }
                    }
                }
                $cum_gpa = $cumGradePoint / $cumUnits;
                $cgpa = number_format((float)$cum_gpa, '2', '.', '');

                /***********************Query failed courses**************************/
                //Query First Semester Failed Courses.
                $queryFailedCourses = mysqli_query($conn, "SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno ='" . $matno . "' AND course.semester = 'First' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryFailedCourses) > 0) {
                    while ($failedCourse = mysqli_fetch_assoc($queryFailedCourses)) {
                        $firstSemesterFailedCourses .= $failedCourse['code'] . " ";
                    }
                } else {
                    $firstSemesterFailedCourses = "NIL";
                }
                // Query Second Semester Failed Courses
                $queryFailedCourses = mysqli_query($conn, "SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '" . $matno . "' AND course.semester ='" . $semester . "' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryFailedCourses) > 0) {
                    while ($failedCourse = mysqli_fetch_assoc($queryFailedCourses)) {
                        $secondSemesterFailedCourses .= $failedCourse['code'] . " ";
                    }
                } else {
                    $secondSemesterFailedCourses = "NIL";
                }
            } else {
                return "Error! No Result For Selected Semester";
            }
        }

        if ($semester == "First" && $level > 100) {
            $queryResult = mysqli_query($conn, "SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                course.code = course_registration.code AND course_registration.matno = '" . $matno . "' AND course.semester = '" . $semester . "' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
            if (mysqli_num_rows($queryResult) > 0) {
                while ($result = mysqli_fetch_assoc($queryResult)) {
                    $singleCourseResultArray = array();
                    $singleCourseResultArray[] = $result['code'];
                    $singleCourseResultArray[] = $result['title'];
                    $singleCourseResultArray[] = $result['units'];
                    $singleCourseResultArray[] = $result['score'];
                    $singleCourseResultArray[] = getStudentGrade($result['score']);
                    $singleCourseResultArray[] = getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                    $singleCourseResultArray[] = getIndividualResultRemarks($result['score']);

                    $resultArray[] = $singleCourseResultArray;

                    $totalUnits += $result['units'];
                    $totalGradePoints += getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));

                    if ($result['score'] > 45) {
                        $totalUnitsPassed += $result['units'];
                    }
                }

                $gpa = $totalGradePoints / $totalUnits;
                $cumUnits += $totalUnits;
                $cumGradePoint += $totalGradePoints;

                /**************Query Cummulatives******************/
                $queryFirstSemesterResult = mysqli_query($conn, "SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                    course.code = course_registration.code AND course_registration.matno = '" . $matno . "' AND course_registration.level < " . $level . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryFirstSemesterResult) > 0) {
                    while ($fs_result = mysqli_fetch_assoc($queryFirstSemesterResult)) {
                        $cumUnits += $fs_result['units'];
                        $cumGradePoint += getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_result['score'])));

                        if ($fs_result['score'] > 45) {
                            $totalUnitsPassed += $fs_result['units'];
                        }
                    }
                }
                $cum_gpa = $cumGradePoint / $cumUnits;
                $cgpa = number_format((float)$cum_gpa, '2', '.', '');

                /********OUTSTANDING COURSES************/
                //Query First Semester Failed Courses.
                $queryFailedCourses = mysqli_query($conn, "SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '" . $matno . "' AND course.semester = '" . $semester . "' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryFailedCourses) > 0) {
                    while ($failedCourse = mysqli_fetch_assoc($queryFailedCourses)) {
                        $firstSemesterFailedCourses .= $failedCourse['code'] . " ";
                    }
                } else {
                    $firstSemesterFailedCourses = "NIL";
                }
                // Query Second Semester Failed Courses
                $lowerLevel = $level - 100;
                $queryFailedCourses = mysqli_query($conn, "SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '" . $matno . "' AND course.semester = '" . $semester . "' AND course_registration.level = " . $lowerLevel . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryFailedCourses) > 0) {
                    while ($failedCourse = mysqli_fetch_assoc($queryFailedCourses)) {
                        $secondSemesterFailedCourses .= $failedCourse['code'] . " ";
                    }
                } else {
                    $secondSemesterFailedCourses = "NIL";
                }
            } else {
                return "Error! No Result For Selected Semester";
            }
        }

        if ($semester_in == "Second Semester" && $level > 100) {
            $queryResult = mysqli_query($conn, "SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                course.code = course_registration.code AND course_registration.matno = '" . $matno . "' AND course.semester = '" . $semester . "' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
            if (mysqli_num_rows($queryResult) > 0) {
                while ($result = mysqli_fetch_assoc($queryResult)) {
                    $singleCourseResultArray = array();
                    $singleCourseResultArray[] = $result['code'];
                    $singleCourseResultArray[] = $result['title'];
                    $singleCourseResultArray[] = $result['units'];
                    $singleCourseResultArray[] = $result['score'];
                    $singleCourseResultArray[] = getStudentGrade($result['score']);
                    $singleCourseResultArray[] = getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                    $singleCourseResultArray[] = getIndividualResultRemarks($result['score']);

                    $resultArray[] = $singleCourseResultArray;

                    $totalUnits += $result['units'];
                    $totalGradePoints += getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));

                    if ($result['score'] > 45) {
                        $totalUnitsPassed += $result['units'];
                    }
                }

                $gpa = $totalGradePoints / $totalUnits;
                $cumUnits += $totalUnits;
                $cumGradePoint += $totalGradePoints;
                /***************Calculation of cummulaties****************/
                $queryFirstSemesterResult = mysqli_query($conn, "SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                    course.code = course_registration.code AND course_registration.matno = '" . $matno . "' AND course.semester = 'First' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryFirstSemesterResult) > 0) {
                    while ($fs_result = mysqli_fetch_assoc($queryFirstSemesterResult)) {
                        $cumUnits += $fs_result['units'];
                        $cumGradePoint += getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_resu['score'])));

                        if ($fs_result['score'] > 45) {
                            $totalUnitsPassed += $fs_result['units'];
                        }
                    }
                }
                $queryCummResult = mysqli_query($conn, "SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                    course.code = course_registration.code AND course_registration.matno = '" . $matno . "' AND course_registration.level < " . $level . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryCummResult) > 0) {
                    while ($fs_result = mysqli_fetch_assoc($queryCummResult)) {
                        $cumUnits += $fs_result['units'];
                        $cumGradePoint += getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_result['score'])));

                        if ($fs_result['score'] > 45) {
                            $totalUnitsPassed += $fs_result['units'];
                        }
                    }
                }
                $cum_gpa = $cumGradePoint / $cumUnits;
                $cgpa = number_format((float)$cum_gpa, '2', '.', '');

                /***********************OUTSTANDING COURSES**************************/
                //Query First Semester Failed Courses.
                $queryFailedCourses = mysqli_query($conn, "SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '" . $matno . "' AND course.semester = 'First' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryFailedCourses) > 0) {
                    while ($failedCourse = mysqli_fetch_assoc($queryFailedCourses)) {
                        $firstSemesterFailedCourses .= $failedCourse['code'] . " ";
                    }
                } else {
                    $firstSemesterFailedCourses = "NIL";
                }
                // Query Second Semester Failed Courses
                $queryCurrentFailedCourses = mysqli_query($conn, "SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '" . $matno . "' AND course.semester = '" . $semester . "' AND course_registration.level = " . $level . "") or die(mysqli_error($conn));
                if (mysqli_num_rows($queryCurrentFailedCourses) > 0) {
                    while ($failedCourse = mysqli_fetch_assoc($queryCurrentFailedCourses)) {
                        $secondSemesterFailedCourses .= $failedCourse['code'] . " ";
                    }
                } else {
                    $secondSemesterFailedCourses = "NIL";
                }
            } else {
                return "Error! No Result For Selected Semester";
            }
        }
        $data = array(
            "headerData" => $headerData,
            "resultArray" => $resultArray,
            "totalUnits" => $totalUnits,
            "totalGradePoint" => $totalGradePoints,
            "gpa" => number_format((float)$gpa, '2', '.', ''),
            "cumm_units" => $cumUnits,
            "cumm_gp" => $cumGradePoint,
            "cgpa" => $cgpa,
            "fSemesterFailedCourses" => $firstSemesterFailedCourses,
            "sSemesterFailedCourses" => $secondSemesterFailedCourses,
            "totalUnitsPassed" => $totalUnitsPassed
        );
        return json_encode($data);
    } else {
        return "Error! Student Registration or Matno does not exist";
    }
}
?>