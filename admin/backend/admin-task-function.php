<?php
    function getTitles(){
        require('db_conn.php');
        if($conn){
            $getTitles =mysqli_query($conn, "SELECT title FROM title")or die(mysqli_error($conn));
            if(mysqli_num_rows($getTitles)>0){
                return $getTitles;
            }
        }
    }

    function getSessions(){
        require('db_conn.php');
        if($conn){
            $querySessions = mysqli_query($conn, "SELECT year FROM academic_session ORDER BY year DESC") or die(mysqli_error($conn));
            if(mysqli_num_rows($querySessions)>0){
                return $querySessions;
            }
        }
    }

    function getTranscriptSession(){
        require('db_conn.php');
        if($conn){
        $arrayOfSessions = array();
            $querySessions = mysqli_query($conn, "SELECT year FROM academic_session ORDER BY year DESC") or die(mysqli_error($conn));
            if(mysqli_num_rows($querySessions)>0){
                while($row = mysqli_fetch_assoc($querySessions)){
                    $arrayOfSessions[]=$row['year'];
                }
            }
            return $arrayOfSessions;
        }
    }

    function getCurrentSession(){
        require('db_conn.php');
        if($conn){
            $querySessions = mysqli_query($conn, "SELECT year FROM academic_session ORDER BY year DESC LIMIT 1") or die(mysqli_error($conn));
            if(mysqli_num_rows($querySessions)>0){
                return $querySessions;
            }
        }
    }


    function getAllOptions(){
        require('db_conn.php');
        if($conn){
            $getOptions = mysqli_query($conn,"SELECT * FROM `option`") or die(mysqli_error($conn));
            if(mysqli_num_rows($getOptions)>0){
                return $getOptions;
            }
        }
    }

    function getAllLecturers(){
        require('db_conn.php');
        if($conn){
            $checkOthername = mysqli_query($conn, "SELECT lecturer_id FROM lecturer_othername") or die(mysqli_error($conn));
            if(mysqli_num_rows($checkOthername)>0){
                $queryLecturers = mysqli_query($conn, "SELECT id, title, firstname, surname, (SELECT othername FROM lecturer_othername WHERE lecturer.id = lecturer_othername.lecturer_id) as othername, rank, mobile_phone FROM lecturer, lecturer_othername") or die(mysqli_error($conn));
                return $queryLecturers;
            }else{
                $queryLecturers = mysqli_query($conn, "SELECT id, title, firstname, surname, rank, mobile_phone FROM lecturer") or die(mysqli_error($conn));
                return $queryLecturers;
            }
        }
    }

    function getCourses(){
        require('db_conn.php');
        if($conn){
            $queryCourses = mysqli_query($conn, "SELECT id, code, title, units, level_taken, semester, taken_by, status FROM course") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryCourses)>0){
                return $queryCourses;
            }
        }
    }

    function getLevelCourseCodes($level){
        require('db_conn.php');
        if($conn){
            $queryCourseCode = mysqli_query($conn, "SELECT code FROM course WHERE level_taken =".$level."") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryCourseCode)>0){
                return $queryCourseCode;
            }
        }
    }

    function viewActiveStudents($currentSession){
        require('db_conn.php');
        if($conn){
            $activeStudents = array();            
            $queryStudents = mysqli_query($conn, "SELECT matno, firstname, surname FROM student") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryStudents)>0){
                while($row = mysqli_fetch_assoc($queryStudents)){
                    $checkSuspension = mysqli_query($conn,"SELECT matno FROM suspension_of_studies WHERE return_session<".$currentSession." AND response ='Granted' AND matno='".$row['matno']."'") or die(mysqli_error($conn));
                    if(mysqli_num_rows($checkSuspension)>0){

                    }else{
                        $activeStudents[] = $row;
                    }
                }
            }
            return $activeStudents;
        }
    }

    function viewSuspensions($currentSession){
        require('db_conn.php');
        if($conn){
            $student_studies_suspension = array();
            $querySuspendedStudents = mysqli_query($conn,"SELECT matno FROM suspension_of_studies WHERE return_session<".$currentSession." AND response ='Granted'") or die(mysqli_error($conn));
            while($row = mysqli_fetch_assoc($querySuspendedStudents )){
                $queryStudentDetails = mysqli_query($conn."SELECT matno, surname, firstname FROM student WHERE matno ='".$row['matno']."'") or die(mysqli_error($conn));
                $student_studies_suspension[] = $queryStudentDetails;
            }
            return $student_studies_suspension ;
        }
    }

    function getAllStudents(){
        require('db_conn.php');
        if($conn){
            $verifyOthername = mysqli_query($conn, "SELECT COUNT(student_id) as all_stundents FROM student_othernames") or die(mysqli_error($conn));
            while($count = mysqli_fetch_assoc($verifyOthername)){
                if($count['all_stundents']>0){
                    $queryAllStudents = mysqli_query($conn, "SELECT student.matno, student.surname, student.firstname, (SELECT student_othernames.othername FROM student_othernames WHERE student_othernames.student_id=student.id) AS othername    FROM student, student_othernames") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryAllStudents)>0){
                        return $queryAllStudents;
                    }
                }else{
                    $queryAllStudents = mysqli_query($conn, "SELECT student.matno, student.surname, student.firstname FROM student") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryAllStudents)>0){
                        return $queryAllStudents;
                    }
                }
            }
        }
    }

    /************Dashboard Functions ******************/
    function getTotalNumberOfStudents(){
        require('db_conn.php');
        if($conn){
            $num_students;
            $totalStudents = mysqli_query($conn, "SELECT COUNT(id) as total_students FROM student WHERE deleted_at is null") or die(mysqli_error($conn));
            while($row = mysqli_fetch_assoc($totalStudents)){
                $num_students = $row['total_students'];
            }
            return $num_students;
        }
    }

    function getTotalNumberOfLectures(){
        require('db_conn.php');
        if($conn){
            $num_lecturers;
            $totalLecturers = mysqli_query($conn, "SELECT COUNT(id) as total_lecturer FROM lecturer") or die(mysqli_error($conn));
            while($row = mysqli_fetch_assoc($totalLecturers)){
                $num_lecturers = $row['total_lecturer'];
            }
            return $num_lecturers;
        }
    }

    function getTotalNumberOfCourses(){
        require('db_conn.php');
        if($conn){
            $num_courses;
            $totalCourses = mysqli_query($conn, "SELECT COUNT(id) as total_courses FROM course") or die(mysqli_error($conn));
            while($row = mysqli_fetch_assoc($totalCourses)){
                $num_courses = $row['total_courses'];
            }
            return $num_courses;
        }
    }
    // This function is specific for 500 level departments;
    function getAvailableLevels(){
        require('db_conn.php');
        if($conn){
            $num_levels;
            $totalSessions = mysqli_query($conn, "SELECT COUNT(year) as total_sessions FROM academic_session") or die(mysqli_error($conn));
            while($row = mysqli_fetch_assoc($totalSessions)){
                if($row['total_sessions']>=5){
                    $num_levels = 5;
                }else{
                    $num_levels = $row['total_sessions'];
                }
            }
            return $num_levels;
        }
    }
    // ends here *********************

    function getActiveStudents($currentSession){
        require('db_conn.php');
        if($conn){
            $totalActiveStudents;
            $studentsUnderSuspension;
            $querySuspendedStudents = mysqli_query($conn,"SELECT COUNT(matno) as total_supension FROM suspension_of_studies WHERE return_session<".$currentSession." AND response ='Granted'") or die(mysqli_error($conn));
            while($row = mysqli_fetch_assoc($querySuspendedStudents )){
                $studentsUnderSuspension = $row['total_supension'];
            }
            $totalStudents = getTotalNumberOfStudents();
            $totalActiveStudents = $totalStudents - $studentsUnderSuspension;

            return $totalActiveStudents;

        }
    }

    function suspensionOfStudies($currentSession){
        require('db_conn.php');
        if($conn){
            $studentsUnderSuspension;
            $querySuspendedStudents = mysqli_query($conn,"SELECT COUNT(matno) as total_supension FROM suspension_of_studies WHERE return_session<".$currentSession." AND response ='Granted'") or die(mysqli_error($conn));
            while($row = mysqli_fetch_assoc($querySuspendedStudents )){
                $studentsUnderSuspension = $row['total_supension'];
            }
            return $studentsUnderSuspension ;
        }
    }

    /*********** Dashboard Functions ends here *********/

    function getAdminMatchedStatus(){
        require('db_conn.php');
        if($conn){
            $getAdminLecturer = mysqli_query($conn, "SELECT id, title, lecturer.firstname, lecturer.surname, (SELECT lecturer_othername.othername FROM lecturer_othername WHERE lecturer.id = lecturer_othername.lecturer_id) AS othername FROM lecturer, lecturer_othername") or die(mysqli_error($conn));
            if(mysqli_num_rows($getAdminLecturer)>0){
                return $getAdminLecturer;
            }
        }
    }

    function getAttebdanceOptions(){
        require('db_conn.php');
        if($conn){
            $getOptions = mysqli_query($conn, "SELECT option FROM option WHERE option !='All'") or die(mysqli_error($conn));
            if(mysqli_num_rows($getOptions)>0){
                return $getOptions;
            }
        }
    }

    function getAttendance($code, $session){
        require('db_conn.php');
        if($conn){
            $getEnrolledLevel = mysqli_query($conn,"SELECT DISTINCT level FROM course_registration WHERE code = '".$code."' AND session = ".$session."") or die(mysqli_error($conn));
            if(mysqli_num_rows($getEnrolledLevel)>0){
                $attArray = array();
                while($rows=mysqli_fetch_assoc($getEnrolledLevel)){
                    $levelarray = array();
                    $getMatno = mysqli_query($conn, "SELECT matno FROM `course_registration` WHERE session=".$session." AND level=".$rows['level']." AND code='".$code."' AND score=-1 ") or die(mysqli_error($conn));
                    if(mysqli_num_rows($getMatno)>0){
                        while($rows = mysqli_fetch_assoc($getMatno)){
                            $queryList = mysqli_query($conn, "SELECT matno, firstname, surname, (SELECT othername FROM student_othernames WHERE student.id = student_othernames.student_id) as othername FROM student WHERE matno = '".$rows['matno']."'") or die(mysqli_error($conn));
                            while($bioData = mysqli_fetch_assoc($queryList)){
                                $levelarray[]=$bioData;
                            }
                        }
                    }
                    $attArray[] = $levelarray;
                }
                return $attArray;
            }
        }
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


    function generateResultAppendix($session, $level, $semester_in){
        require('db_conn.php');
        if($conn){
            $resultArray=array();
            $semester ="";
            $courseCodes=array();
            $repeatedCoursesArray = array();
            $repeatedCodesArray = array();
            $repeatedUnitsArray = array();
            $listOfStudent;
            $newCoursesArray = array();
            $newCodesArrray = array();
            $newUnitsArray = array();
            $courseBasedResult;

            $cgp = 0;
            $cumUnits = 0;
            $cgpa=0;

            if($semester_in=="First"){
                $semester = 'First';
            }else{
                $semester='Second';
            }
        
            $getCourseCodes = mysqli_query($conn,"SELECT DISTINCT course_registration.code FROM course_registration, course WHERE course_registration.code=course.code AND course_registration.level=".$level." AND course.semester='".$semester_in."'") or die(mysqli_error($conn));
            if(mysqli_num_rows($getCourseCodes)>0){
                while($c_code = mysqli_fetch_assoc($getCourseCodes)){
                    $courseCodes[] = $c_code['code'];
                }
            }
            $queryNewCourses = mysqli_query($conn,"SELECT DISTINCT course_registration.code, course.units FROM course, course_registration WHERE course.code = course_registration.code AND course_registration.level= course.level_taken AND course.semester='".$semester_in."' AND course_registration.level=".$level." AND course_registration.session=".$session."") or die(mysqi_error($conn));
            if(mysqli_num_rows($queryNewCourses)>0){
                while($n_course = mysqli_fetch_assoc($queryNewCourses)){
                    $newCodesArrray[] = $n_course['code'];
                    $newUnitsArray[] = $n_course['units'];
                }
                $newCoursesArray[] = $newCodesArrray;
                $newCoursesArray[] = $newUnitsArray;
            }
            $queryRepeatedCourse = mysqli_query($conn,"SELECT DISTINCT course_registration.code, course.units FROM course_registration, course, student WHERE course_registration.code= course.code AND student.matno = course_registration.matno AND
                                    course.level_taken<course_registration.level AND course.semester='".$semester_in."' AND course_registration.level=".$level." AND course_registration.session=".$session."") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryRepeatedCourse)>0){
                while($reptd_course = mysqli_fetch_assoc($queryRepeatedCourse)){
                    $repeatedCodesArray[] = $reptd_course['code'];
                    $repeatedUnitsArray[] = $reptd_course['units'];
                }
                $repeatedCoursesArray[] = $repeatedCodesArray;
                $repeatedCoursesArray[] = $repeatedUnitsArray;
            }
            if($level==100){
                $queryListOfStudents = mysqli_query($conn,"SELECT DISTINCT matno FROM course_registration, course WHERE course_registration.code=course.code AND course.semester='".$semester."' AND level =".$level." AND course_registration.session=".$session."")or die(mysqli_error($conn));
                // $listOfStudent = $queryListOfStudents;
                while($student_id = mysqli_fetch_assoc($queryListOfStudents)){
                    $studentResultArray = array();
                    $gpa=0;
                    $totalGradePoints=0;
                    $totalUnits=0;
                    $gpa=0;
                    $f_s_failedCourses="";
                    $s_s_failedCourses = "";
                    $repeats =0;
                    $remarks ="";

                    $studentResultArray[]=$student_id['matno'];
                    $newCourses = mysqli_query($conn,"SELECT DISTINCT course_registration.code, course.units FROM course, course_registration WHERE course.code = course_registration.code AND course_registration.level= course.level_taken AND course.semester='".$semester_in."' AND course_registration.level=".$level." AND course_registration.session=".$session."") or die(mysqi_error($conn));
                    while($course = mysqli_fetch_assoc($newCourses)){           //points to note
                        $result = mysqli_query($conn,"SELECT score, units FROM course_registration, course WHERE course_registration.code=course.code AND course.semester = '".$semester_in."' AND course_registration.level =".$level." AND course_registration.matno ='".$student_id['matno']."' AND course_registration.code= '".$course['code']."' AND course_registration.session=".$session."")or die(mysqli_error($conn));
                        $courseBasedResult = $result;
                        $scoreGradeString ="";
                        while($s_result = mysqli_fetch_assoc($result)){
                            $totalUnits+=$s_result['units'];
                            $scoreGradeString=$s_result['score']."<br>".getStudentGrade($s_result['score'])." <br> ".getGradePoint($s_result['units'], getCourseGrade(getStudentGrade($s_result['score'])));
                            $totalGradePoints+=getGradePoint($s_result['units'], getCourseGrade(getStudentGrade($s_result['score'])));
                        }
                        $studentResultArray[] = $scoreGradeString;
                        // return $result->score;
                    }
                    $cumUnits+=$totalUnits;
                    $cgp+=$totalGradePoints;
                    /**************** Get failed courses for first semester************************/

                    if($semester=='First'){
                        $queryFailedCourses = mysqli_query($conn,"SELECT course_registration.code FROM course_registration, course WHERE course.code = course_registration.code AND course.semester='".$semester_in."' AND course_registration.level =".$level." AND course_registration.matno='".$student_id['matno']."' AND course_registration.session=".$session." AND score<45")or die(mysqli_error($conn));
                        if(mysqli_num_rows($queryFailedCourses)>0){
                            $repeats+=mysqli_num_rows($queryFailedCourses);
                            $remarks="R".$repeats;
                            while($failedCourse = mysqli_fetch_assoc($queryFailedCourses)){
                                $f_s_failedCourses.=$failedCourse['code'];
                            }
                        }else{
                            $f_s_failedCourses.="NIL";
                            $remarks = "CS";
                        }
                        $s_s_failedCourses="NIL";

                    }

                    if($semester=='Second'){
                        $previousResult = mysqli_query($conn,"SELECT score, units FROM course_registration, course WHERE course_registration.code=course.code AND course.semester ='First' AND course_registration.level =".$level." AND course_registration.matno ='".$student_id['matno']."' AND course_registration.session=".$session."")or die(mysqli_error($conn));
                        // $courseBasedPrevResult = $previousResult;
                        while($p_result = mysqli_fetch_assoc($previousResult)){
                            $cumUnits+=$p_result['units'];
                            $cgp+=getGradePoint($p_result['units'], getCourseGrade(getStudentGrade($p_result['score'])));
                        }
                        /*************Get failed courses if semester is second semester **********/
                        $queryFailedCourses = mysqli_query($conn,"SELECT course_registration.code FROM course_registration, course WHERE course.code = course_registration.code AND course.semester='First' AND course_registration.level =".$level." AND course_registration.matno='".$student_id['matno']."' AND course_registration.session=".$session." AND score<45")or die(mysqli_error($conn));
                        if(mysqli_num_rows($queryFailedCourses)>0){
                            $repeats+=mysqli_num_rows($queryFailedCourses);
                            $remarks="R".$repeats;
                            while($failedCourse = mysqli_fetch_assoc($queryFailedCourses)){
                                $f_s_failedCourses.=$failedCourse['code'];
                            }
                        }else{
                            $f_s_failedCourses.="NIL";
                            $remarks = "CS";
                        }
                        $queryS_FailedCourses = mysqli_query($conn,"SELECT course_registration.code FROM course_registration, course WHERE course.code = course_registration.code AND course.semester='Second' AND course_registration.level =".$level." AND course_registration.matno='".$student_id['matno']."' AND course_registration.session=".$session." AND score<45")or die(mysqli_error($conn));
                        if(mysqli_num_rows($queryS_FailedCourses)>0){
                            $repeats+=mysqli_num_rows($queryS_FailedCourses);
                            $remarks="R".$repeats;
                            while($failedCourse = mysqli_fetch_assoc($queryS_FailedCourses)){
                                $s_s_failedCourses.=$failedCourse['code'];
                            }
                        }else{
                            $s_s_failedCourses="NIL";
                        }

                    }


                    /**
                     * Total Grade Point is same as Cummulative Grade Point for 100 level.
                     * Grade Point Averge (GPA) is same as Cummulative Grade Point Average (CGPA) for 100 level
                     */
                    $gpa = $totalGradePoints/$totalUnits;
                    $cgpa = $cgp/$cumUnits;
                    $studentResultArray[]=$totalUnits;
                    $studentResultArray[]=$totalGradePoints;
                    $studentResultArray[]=number_format((float)$gpa,'2','.','');
                    $studentResultArray[]=$cumUnits;
                    $studentResultArray[]=$cgp;
                    $studentResultArray[]=number_format((float)$cgpa,'2','.','');
                    $studentResultArray[]=$f_s_failedCourses;
                    $studentResultArray[]=$s_s_failedCourses;
                    $studentResultArray[]=$remarks;

                    $resultArray[]=$studentResultArray;
                    $cgp=0;
                    $cumUnits=0;
                }
                $data= array(
                    "levelCheck"=>"100",
                    "allRegisteredCourses" => $courseCodes,
                    "newCourses"=> $newCoursesArray,
                    "resultArray"=> $resultArray
                );
                return json_encode($data);

            }
            else{
                $queryListOfStudents = mysqli_query($conn,"SELECT DISTINCT matno FROM course_registration, course WHERE course_registration.code=course.code AND course.semester='".$semester."' AND level =".$level." AND course_registration.session=".$session."") or die(mysqli_error($conn));
                $listOfStudent = $queryListOfStudents;
                while($student_id = musqli_fetch_assoc($queryListOfStudents)){
                    $studentResultArray = array();
                    $totalGradePoints=0;
                    $totalUnits=0;
                    $gpa=0;
                    $f_s_failedCourses="";
                    $s_s_failedCourses = "";
                    $repeats =0;
                    $totalDropCourse = 0;
                    $remarks ="";
                    $dropCourse ="";
                    $secondSemesterDropCourse = "";
                    $carryOvers=0;

                    $cumGradePoint=0;

                    $studentResultArray[]=$student_id['matno'];
                    while($course = mysqli_fetch_assoc($queryNewCourses)){
                        $result = mysqli_query($conn,"SELECT score, units FROM course_registration, course WHERE course_registration.code=course.code AND course.semester = '".$semester."' AND course_registration.level =".$level." AND course_registration.matno ='".$student_id['matno']."' AND course_registration.code= '".$course['code']."' AND course_registration.session=".$session."")or die(mysqli_error($conn));
                        // $courseBasedResult = $result;
                        $scoreGradeString ="";
                        while($s_result = mysqli_fetch_assoc($result)){
                            $totalUnits+=$s_result['units'];
                            $scoreGradeString=$s_result['score']." ".getStudentGrade($s_result['score'])." ".getGradePoint($s_result['units'], getCourseGrade(getStudentGrade($s_result['score'])));
                            $totalGradePoints+=getGradePoint($s_result['units'], getCourseGrade(getStudentGrade($s_result['score'])));
                        }
                        $studentResultArray[] = $scoreGradeString;
                        // return $result->score;
                    }
                    while($r_course = mysqli_fetch_assoc($repeatedCourses)){
                        $result = mysqli_query($conn,"SELECT score, units FROM course_registration, course WHERE course_registration.code=course.code AND course.level_taken<course_registration.level AND course.semester = '".$semester."' AND course_registration.level =".$level." AND course_registration.matno ='".$student_id['matno']."' AND course_registration.code= '".$r_course['code']."' AND course_registration.session=".$session."") or die(mysqli_error($conn));
                        // $courseBasedResult = $result;
                        $scoreGradeString ="";
                        while($s_result = mysqli_fetch_assoc($result)){
                            $totalUnits+=$s_result['units'];
                            $scoreGradeString=$s_result['score']." ".getStudentGrade($s_result['score'])." ".getGradePoint($s_result['units'], getCourseGrade(getStudentGrade($s_result['score'])));
                            $totalGradePoints+=getGradePoint($s_result['units'], getCourseGrade(getStudentGrade($s_result['score'])));
                        }
                        $studentResultArray[] = $scoreGradeString;
                    }
                    $cumUnits+=$totalUnits;
                    $cumGradePoint+=$totalGradePoints;
                    $gpa = $totalGradePoints/$totalUnits;
                    /**************Implementing the cummulatives for levels higher than 100 level**************** */
                    if($semester=='First'){
                        $queryLowerResult = mysqli_query($conn,"SELECT score, units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                        course.code = course_registration.code AND course_registration.matno = '".$student_id['matno']."' AND course_registration.level < ".$level."") or die(mysqli_error($conn));
                        while($lowerResult = mysqli_fetch_assoc($queryLowerResult)){
                            $cumUnits+=$lowerResult['units'];
                            $cumGradePoint+=getGradePoint($lowerResult['units'], getCourseGrade(getStudentGrade($lowerResult['score'])));
                        }
                        /***********************Query failed courses******************/
                        $queryFailedCourses = mysqli_query($conn,"SELECT course_registration.code FROM course_registration, course WHERE course.code = course_registration.code AND course.semester='First' AND course_registration.level =".$level." AND course_registration.matno='".$student_id['matno']."' AND course_registration.session=".$session."AND score<45");
                        if(mysqli_num_rows($queryFailedCourses)>0){
                            $repeats+=mysqli_num_rows($queryFailedCourses);
                            $remarks="R".$repeats;
                            while($failedCourse = mysqli_fetch_assoc($queryFailedCourses)){
                                $f_s_failedCourses.=$failedCourse['code'];
                            }
                        }else{
                            $f_s_failedCourses.="";
                            $remarks = "CS";
                        }
                        $s_s_failedCourses="NIL";

                        /*****************Query dropped courses for first semester**************/
                        $queryCurrentLevelCourses = mysqli_query($conn,"SELECT code FROM course WHERE semester='First' AND level_taken=".$level."");
                        while($c_l_course = mysqlil_fetch_assoc($queryCurrentLevelCourses)){
                            $queryDroppedCourses = mysqli_query($conn,"SELECT course_registration.code FROM course_registration, course WHERE course_registration.code=course.code AND course_registration.level=course.level_taken  AND course_registration.matno='".$student_id->matno."' AND course.semester='".$semester."' AND course_registration.level = ".$level." AND course.code ='".$c_l_course['code']."'")or die(mysqli_error($conn));
                            if(mysqli_num_rows($queryDroppedCourses)>0){
                                $dropCourse="";
                            }else{
                                $dropCourse.=$c_l_course->code;
                                $totalDropCourse++;

                            }
                        }
                        $f_s_failedCourses.=$dropCourse;
                        $carryOvers = $totalDropCourse;

                        if($f_s_failedCourses==""){
                            $f_s_failedCourses="NIL";
                        }

                        if($repeats>0 && $carryOvers>0){
                            $remarks="C".$carryOvers."R".$repeats;
                        }
                        if($repeats>0 && $carryOvers==0){
                            $remarks="R".$repeats;
                        }
                        if($repeats==0 && $carryOvers>0){
                            $remarks="C".$carryOvers;
                        }
                        if($repeats==0 && $carryOvers==0){
                            $remarks="CS";
                        }
                    }else{
                        /**************compute cummulative for second semester result*************/
                        $queryLowerResult = mysqli_query($conn,"SELECT score, units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                        course.code = course_registration.code AND course_registration.matno = '".$student_id['matno']."' AND course_registration.level < ".$level."")or die(mysqli_error($conn));
                        while($lowerResult = mysqli_fetch_array($queryLowerResult)){
                            $cumUnits+=$lowerResult['units'];
                            $cumGradePoint+=getGradePoint($lowerResult['units'], getCourseGrade(getStudentGrade($lowerResult['score'])));
                        }
                        /***********************Query failed courses for first semester******************/
                        $queryFailedCourses = mysqli_query($conn,"SELECT course_registration.code FROM course_registration, course WHERE course.code = course_registration.code AND course.semester='First' AND course_registration.level =".$level." AND course_registration.matno='".$student_id->matno."' AND course_registration.session=".$session." AND score<45") or die(mysqli_error($conn));
                        if(mysqli_num_rows($queryFailedCourses)>0){
                            $repeats+=mysqli_num_rows($queryFailedCourses);
                            $remarks="R".$repeats;
                            foreach($queryFailedCourses as $failedCourse){
                                $f_s_failedCourses.=$failedCourse['code'];
                            }
                        }else{
                            $f_s_failedCourses.="";
                            $remarks = "CS";
                        }
                        $s_s_failedCourses="NIL";

                        /*****************Query dropped courses for first semester**************/
                        $queryCurrentLevelCourses = mysqli_query($conn,"SELECT code FROM course WHERE semester='First' AND level_taken=".$level."") or die(mysqli_error($conn));
                        while($c_l_course = mysqli_fetch_assoc($queryCurrentLevelCourses)){
                            $queryDroppedCourses = mysqli_query($conn,"SELECT course_registration.code FROM course_registration, course WHERE course_registration.code=course.code AND course_registration.level=course.level_taken  AND course_registration.matno='".$student_id['matno']."' AND course.semester='".$semester."' AND course_registration.level = ".$level." AND course.code ='".$c_l_course['code']."'") or die(mysqli_error($conn));
                            if(mysqli_vum_rows($queryDroppedCourses)>0){
                                $dropCourse="";
                            }else{
                                $dropCourse.=$c_l_course['code'];
                                $totalDropCourse++;
                            }
                        }
                        $f_s_failedCourses.=$dropCourse;
                        $carryOvers = $totalDropCourse;

                        if($f_s_failedCourses==""){
                            $f_s_failedCourses="NIL";
                        }

                        /**************Query failed courses for second semester**************/
                        $queryS_FailedCourses = mysqli_query($conn,"SELECT course_registration.code FROM course_registration, course WHERE course.code = course_registration.code AND course.semester='Second' AND course_registration.level =".$level." AND course_registration.matno='".$student_id['matno']."' AND course_registration.session=".$session." AND score<45");
                        if(mysqli_num_rows($queryS_FailedCourses)>0){
                            $repeats+=mysqli_num_rows($queryS_FailedCourses);
                            while($f_course = mysqli_fetch_assoc($queryS_FailedCourses)){
                                $s_s_failedCourses.=$f_course['code'];
                            }

                        }else{
                            $s_s_failedCourses="";
                        }

                        /************************Query dropped courses for second semester********************/
                        $queryS_semester_level_courses = mysqli_query($conn,"SELECT code FROM course WHERE semester='Second' AND level_taken=".$level."")or die(mysqli_error($conn));
                        foreach($queryS_semester_level_courses as $course){
                            $queryS_semester_drop_course = mysqli_query($conn,"SELECT course_registration.code FROM course_registration, course WHERE course_registration.code = course.code AND
                            course_registration.level=course.level_taken AND course_registration.matno='".$student_id['matno']."' AND course.semester='Second' AND course_registration.level =".$level." AND course.code ='".$course['code']."'")or die(mysqli_error($conn));
                            if(mysqli_num_rows($queryS_semester_drop_course)>0){
                                $secondSemesterDropCourse="";
                            }else{
                                $secondSemesterDropCourse.=$course['code'];
                                $totalDropCourse++;
                            }
                        }
                        $s_s_failedCourses.=$secondSemesterDropCourse;
                        $carryOvers=$totalDropCourse;
                        if($s_s_failedCourses==""){
                            $s_s_failedCourses="NIL";
                        }
                        if($repeats>0 && $carryOvers>0){
                            $remarks="C".$carryOvers."R".$repeats;
                        }
                        if($repeats==0 && $carryOvers>0){
                            $remarks="C".$carryOvers;
                        }
                        if($repeats>0 && $carryOvers==0){
                            $remarks="R".$repeats;
                        }
                        if($repeats==0 && $carryOvers==0){
                            $remarks="CS";
                        }
                    }
                    $gpa = $totalGradePoints/$totalUnits;
                    $cgpa = $cumGradePoint/$cumUnits;
                    $studentResultArray[]=$totalUnits;
                    $studentResultArray[]=$totalGradePoints;
                    $studentResultArray[]=number_format((float)$gpa,'2','.','');
                    $studentResultArray[]=$cumUnits;
                    $studentResultArray[]=$cumGradePoint;
                    $studentResultArray[]=number_format((float)$cgpa,'2','.','');
                    $studentResultArray[]=$f_s_failedCourses;
                    $studentResultArray[]=$s_s_failedCourses;
                    $studentResultArray[]=$remarks;

                    $resultArray[]=$studentResultArray;
                    $cumGradePoint=0;
                    $cumUnits=0;

                }

                $data= array(
                    "levelCheck"=>"others",
                    "allRegisteredCourses" => $courseCodes,
                    "newCourses"=> $newCoursesArray,
                    "repeatedCourses"=> $repeatedCoursesArray,
                    "resultArray"=> $resultArray
                );
                return json_encode($data);
            }
            
        }
    }
    /************************** General Result Ends Here *****************************/

    /*************************** Individual Result ***********************************/
    function individualStudentResult($matno, $session, $level, $semester_in){
        require('db_conn.php');
        $resultArray = array();

        $headerData = array();
        $totalGradePoints = 0;
        $totalUnits=0;
        $gpa = 0;
        $cumUnits=0;
        $cumGradePoint=0;
        $cgpa=0;

        $totalUnitsPassed = 0;

        $lowerLevel=0;
        $firstSemesterFailedCourses="";
        $secondSemesterFailedCourses="";
        if($semester_in=="First"){
            $semester = 'First';
        }else{
            $semester='Second';
        }
        /******************Verify if matno is registered for that session******************/
        $queryMatno = mysqli_query($conn, "SELECT DISTINCT matno FROM course_registration WHERE level =".$level." AND session =".$session." AND matno ='".$matno."'") or die(mysqli_error($conn));
        if(mysqli_num_rows($queryMatno)>0){
            $getStudentID = mysqli_query($conn,"SELECT id FROM student WHERE matno ='".$matno."'") or die(mysqli_error($conn));
            while($id = mysqli_fetch_assoc($getStudentID)){
                $verifyOthername = mysqli_query($conn, "SELECT othername FROM student_othernames WHERE student_othernames.student_id='".$id['id']."'") or die(mysqli_error($conn));
                if(mysqli_num_rows($verifyOthername)>0){
                    $queryStudentDetail = mysqLi_query($conn,"SELECT student.matno, student.surname, student.firstname, (SELECT student_othernames.othername FROM student_othernames WHERE student_othernames.student_id=student.id) AS
                    othername from student, student_othernames WHERE student.id='".$id['id']."'") or die(mysqli_error($conn));
                    while($rowData = mysqli_fetch_assoc($queryStudentDetail)){
                        $headerData[]=$rowData['matno'];
                        $headerData[]=$rowData['firstname'];
                        $headerData[]=$rowData['surname'];
                        $headerData[]=$rowData['othername'];
                    }
                    
                }else{
                    $queryStudentDetail = mysqLi_query($conn,"SELECT student.matno, student.surname, student.firstname FROM student WHERE student.id='".$id['id']."'") or die(mysqli_error($conn));
                    while($rowData = mysqli_fetch_assoc($queryStudentDetail)){
                        $headerData[]=$rowData['matno'];
                        $headerData[]=$rowData['firstname'];
                        $headerData[]=$rowData['surname'];
                    }
                }
            }

            /**********************Query student result*************************/
            if($semester=="First" && $level==100){
                $queryResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = '".$semester."' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                if(mysqli_num_rows($queryResult)>0){
                    while($result = mysqli_fetch_assoc($queryResult)){
                        $singleCourseResultArray = array();
                        $singleCourseResultArray[]=$result['code'];
                        $singleCourseResultArray[]=$result['title'];
                        $singleCourseResultArray[]=$result['units'];
                        $singleCourseResultArray[]=$result['score'];
                        $singleCourseResultArray[]= getStudentGrade($result['score']);
                        $singleCourseResultArray[]= getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                        $singleCourseResultArray[]= getIndividualResultRemarks($result['score']);

                        $resultArray[]=$singleCourseResultArray;

                        $totalUnits+=$result['units'];
                        $totalGradePoints+=getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                        if($result['score']>45){
                            $totalUnitsPassed+=$result['units'];
                        }
                    }

                    /****** Note: For first semester year one, CGPA = GPA, CUMM.UNITS = TOTAL UNITS and CUMM.GRADEPOINT = TOTALGRADEPOINT**********/
                    $gpa = $totalGradePoints/$totalUnits;
                    $cumUnits=$totalUnits;
                    $cumGradePoint = $totalGradePoints;
                    $cgpa =number_format((float)$gpa,'2','.','');

                    /***********************Query first semester failed courses**************************/
                    $queryFailedCourses = mysqli_query($conn,"SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '".$matno."' AND course.semester = 'First' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryFailedCourses)>0){
                        while($failedCourse= mysqli_fetch_assoc($queryFailedCourses)){
                            $firstSemesterFailedCourses.=$failedCourse['code']." ";
                        }
                    }else{
                        $firstSemesterFailedCourses="NIL";
                    }
                    $secondSemesterFailedCourses="NIL";
                }else{
                    return "Error! No Result For Selected Semester";
                }
            }
            if($semester=="Second" && $level==100){
                $queryResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = '".$semester."' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                if(mysqli_num_rows($queryResult)>0){
                    while($result = mysqli_fetch_assoc($queryResult)){
                        $singleCourseResultArray = array();
                        $singleCourseResultArray[]=$result['code'];
                        $singleCourseResultArray[]=$result['title'];
                        $singleCourseResultArray[]=$result['units'];
                        $singleCourseResultArray[]=$result['score'];
                        $singleCourseResultArray[]= getStudentGrade($result['score']);
                        $singleCourseResultArray[]= getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                        $singleCourseResultArray[]= getIndividualResultRemarks($result['score']);

                        $resultArray[]=$singleCourseResultArray;

                        $totalUnits+=$result['units'];
                        $totalGradePoints+=getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                        
                        if($result['score']>45){
                            $totalUnitsPassed+=$result['units'];
                        }
                    }

                    $gpa = $totalGradePoints/$totalUnits;
                    $cumUnits+=$totalUnits;
                    $cumGradePoint+=$totalGradePoints;
                    /***********Calculation of cummulaties****************/
                    $queryFirstSemesterResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                    course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = 'First' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryFirstSemesterResult)>0){
                        while($fs_result = mysqli_fetch_assoc($queryFirstSemesterResult)){
                            $cumUnits+=$fs_result['units'];
                            $cumGradePoint+=getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_result['score'])));
                            
                            if($fs_result['score']>45){
                                $totalUnitsPassed+=$fs_result['units'];
                            }
                        }
                    }
                    $cum_gpa = $cumGradePoint/$cumUnits;
                    $cgpa =number_format((float)$cum_gpa,'2','.','');

                    /***********************Query failed courses**************************/
                    //Query First Semester Failed Courses.
                    $queryFailedCourses = mysqli_query($conn,"SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno ='".$matno."' AND course.semester = 'First' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryFailedCourses)>0){
                        while($failedCourse = mysqli_fetch_assoc($queryFailedCourses)){
                            $firstSemesterFailedCourses.=$failedCourse['code']." ";
                        }
                    }else{
                        $firstSemesterFailedCourses="NIL";
                    }
                    // Query Second Semester Failed Courses
                    $queryFailedCourses = mysqli_query($conn,"SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '".$matno."' AND course.semester ='".$semester."' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryFailedCourses)>0){
                        while($failedCourse = mysqli_fetch_assoc($queryFailedCourses)){
                            $secondSemesterFailedCourses.=$failedCourse['code']." ";
                        }
                    }else{
                        $secondSemesterFailedCourses="NIL";
                    }
                }else{
                    return "Error! No Result For Selected Semester";
                }
            }

            if($semester=="First" && $level>100){
                $queryResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = '".$semester."' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                if(mysqli_num_rows($queryResult)>0){
                    while($result = mysqli_fetch_assoc($queryResult)){
                        $singleCourseResultArray = array();
                        $singleCourseResultArray[]=$result['code'];
                        $singleCourseResultArray[]=$result['title'];
                        $singleCourseResultArray[]=$result['units'];
                        $singleCourseResultArray[]=$result['score'];
                        $singleCourseResultArray[]= getStudentGrade($result['score']);
                        $singleCourseResultArray[]= getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                        $singleCourseResultArray[]= getIndividualResultRemarks($result['score']);

                        $resultArray[]=$singleCourseResultArray;

                        $totalUnits+=$result['units'];
                        $totalGradePoints+=getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));

                        if($result['score']>45){
                            $totalUnitsPassed+=$result['units'];
                        }
                    }

                    $gpa = $totalGradePoints/$totalUnits;
                    $cumUnits+=$totalUnits;
                    $cumGradePoint+=$totalGradePoints;

                    /**************Query Cummulatives******************/
                    $queryFirstSemesterResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                    course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course_registration.level < ".$level."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryFirstSemesterResult)>0){
                        while($fs_result = mysqli_fetch_assoc($queryFirstSemesterResult)){
                            $cumUnits+=$fs_result['units'];
                            $cumGradePoint+=getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_result['score'])));

                            if($fs_result['score']>45){
                                $totalUnitsPassed+=$fs_result['units'];
                            }
                        }
                    }
                    $cum_gpa = $cumGradePoint/$cumUnits;
                    $cgpa =number_format((float)$cum_gpa,'2','.','');

                    /********OUTSTANDING COURSES************/
                    //Query First Semester Failed Courses.
                    $queryFailedCourses = mysqli_query($conn,"SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '".$matno."' AND course.semester = '".$semester."' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryFailedCourses)>0){
                        while($failedCourse = mysqli_fetch_assoc($queryFailedCourses)){
                            $firstSemesterFailedCourses.=$failedCourse['code']." ";
                        }
                    }else{
                        $firstSemesterFailedCourses="NIL";
                    }
                    // Query Second Semester Failed Courses
                    $lowerLevel=$level-100;
                    $queryFailedCourses = mysqli_query($conn,"SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '".$matno."' AND course.semester = '".$semester."' AND course_registration.level = ".$lowerLevel."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryFailedCourses)>0){
                        while($failedCourse = mysqli_fetch_assoc($queryFailedCourses)){
                            $secondSemesterFailedCourses.=$failedCourse['code']." ";
                        }
                    }else{
                        $secondSemesterFailedCourses="NIL";
                    }
                }else{
                    return "Error! No Result For Selected Semester";
                }
            }

            if($semester_in=="Second Semester" && $level>100){
                $queryResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = '".$semester."' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                if(mysqli_num_rows($queryResult)>0){
                    while($result = mysqli_fetch_assoc($queryResult)){
                        $singleCourseResultArray = array();
                        $singleCourseResultArray[]=$result['code'];
                        $singleCourseResultArray[]=$result['title'];
                        $singleCourseResultArray[]=$result['units'];
                        $singleCourseResultArray[]=$result['score'];
                        $singleCourseResultArray[]= getStudentGrade($result['score']);
                        $singleCourseResultArray[]= getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                        $singleCourseResultArray[]= getIndividualResultRemarks($result['score']);

                        $resultArray[]=$singleCourseResultArray;

                        $totalUnits+=$result['units'];
                        $totalGradePoints+=getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));

                        if($result['score']>45){
                            $totalUnitsPassed+=$result['units'];
                        }
                    }

                    $gpa = $totalGradePoints/$totalUnits;
                    $cumUnits+=$totalUnits;
                    $cumGradePoint+=$totalGradePoints;
                    /***************Calculation of cummulaties****************/
                    $queryFirstSemesterResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                    course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = 'First' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryFirstSemesterResult)>0){
                        while( $fs_result = mysqli_fetch_assoc($queryFirstSemesterResult)){
                            $cumUnits+=$fs_result['units'];
                            $cumGradePoint+=getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_resu['score'])));

                            if($fs_result['score']>45){
                                $totalUnitsPassed+=$fs_result['units'];
                            }
                        }
                    }
                    $queryCummResult = mysqli_query($conn, "SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                    course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course_registration.level < ".$level."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryCummResult)>0){
                        while($fs_result = mysqli_fetch_assoc($queryCummResult)){
                            $cumUnits+=$fs_result['units'];
                            $cumGradePoint+=getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_result['score'])));

                            if($fs_result['score']>45){
                                $totalUnitsPassed+=$fs_result['units'];
                            }
                        }
                    }
                    $cum_gpa = $cumGradePoint/$cumUnits;
                    $cgpa =number_format((float)$cum_gpa,'2','.','');

                    /***********************OUTSTANDING COURSES**************************/
                    //Query First Semester Failed Courses.
                    $queryFailedCourses = mysqli_query($conn, "SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '".$matno."' AND course.semester = 'First' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryFailedCourses)>0){ 
                        while($failedCourse = mysqli_fetch_assoc($queryFailedCourses)){
                            $firstSemesterFailedCourses.=$failedCourse['code']." ";
                        }
                    }else{
                        $firstSemesterFailedCourses="NIL";
                    }
                    // Query Second Semester Failed Courses
                    $queryCurrentFailedCourses = mysqli_query($conn, "SELECT course.code FROM course_registration, student, course WHERE student.matno = course_registration.matno AND course.code = course_registration.code AND
                    course_registration.score<45 AND course_registration.matno = '".$matno."' AND course.semester = '".$semester."' AND course_registration.level = ".$level."") or die(mysqli_error($conn));
                    if(mysqli_num_rows($queryCurrentFailedCourses)>0){
                        while($failedCourse = mysqli_fetch_assoc($queryCurrentFailedCourses)){
                            $secondSemesterFailedCourses.=$failedCourse['code']." ";
                        }
                    }else{
                        $secondSemesterFailedCourses="NIL";
                    }
                }
                else{
                    return "Error! No Result For Selected Semester";
                }
            }
            $data=array(
                "headerData" => $headerData,
                "resultArray"=> $resultArray,
                "totalUnits"=> $totalUnits,
                "totalGradePoint"=> $totalGradePoints,
                "gpa"=>number_format((float)$gpa,'2','.',''),
                "cumm_units"=>$cumUnits,
                "cumm_gp"=>$cumGradePoint,
                "cgpa"=>$cgpa,
                "fSemesterFailedCourses"=>$firstSemesterFailedCourses,
                "sSemesterFailedCourses"=>$secondSemesterFailedCourses,
                "totalUnitsPassed"=>$totalUnitsPassed
            );
            return json_encode($data);
        }
        else{
            return "Error! Student Registration or Matno does not exist";
        }

    }

    /*************** course allaocation function(s) ***********************/
    function getFormatedLecturerNames(){
        require('db_conn.php');
        if($conn){
            $checkOthername = mysqli_query($conn, "SELECT lecturer_id FROM lecturer_othername") or die(mysqli_error($conn));
            if(mysqli_num_rows($checkOthername)>0){
                $queryLecturers = mysqli_query($conn, "SELECT id, title, firstname, surname, (SELECT othername FROM lecturer_othername WHERE lecturer.id = lecturer_othername.lecturer_id) as othername, gender FROM lecturer, lecturer_othername") or die(mysqli_error($conn));
                return $queryLecturers;
            }else{
                $queryLecturers = mysqli_query($conn, "SELECT id, title, firstname, surname, gender FROM lecturer") or die(mysqli_error($conn));
                return $queryLecturers;
            }
        }
    }

    function getCoursesToAllocate($semester, $level){
        require('db_conn.php');
        if($conn){
            $queryCourses = mysqli_query($conn, "SELECT code, title FROM course WHERE level_taken =".$level." AND semester ='".$semester."'") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryCourses)>0){
                return $queryCourses;
            }
        }
    }

    /*************** Ends here *************************************/

    /**************Transcript Functions************************/
    function getClassOfDegree($cgpa){
        $classOfDegree = 0.0;
        if($cgpa>4.49){
            $classOfDegree = 1.1;
        }
        elseif($cgpa>=3.50 && $cgpa<=4.49){
            $classOfDegree = 2.1;
        }
        elseif($cgpa>=2.50 && $cgpa <=3.49){
            $classOfDegree = 2.2;
        }
        elseif($cgpa >=1.50 && $cgpa <=2.49){
            $classOfDegree = 3.0;
        }
        elseif($cgpa >=1.00 && $cgpa <= 1.49){
            $classOfDegree = 4.0;
        }else{
            $classOfDegree =5.0;
        }
        return $classOfDegree;
    }
    function getTranscriptOnRequest($matno, $session, $level){
        require('db_conn.php');

        $totalGradePoints = 0;
        $totalUnits=0;
        $f_gpa = 0.00;
        $s_gpa = 0.00;
        $f_cgpa = 0.00;
        $s_cgpa = 0.00;

        // $gpa = 0.00;

        $cumUnits=0;
        $cumGradePoint=0;
        $cgpa=0.00;

        $transcriptHeaderData = array();
        $resultSummaryArray = array();
        $sessionsArray = array();
        $transcriptArray = array();

        $getStudentID = mysqli_query($conn, "SELECT id FROM student WHERE matno = '".$matno."'") or die(mysqli_error($conn));
        if(mysqli_num_rows($getStudentID)>0){
            $studentId = mysqli_fetch_assoc($getStudentID);
            $verifyOthername = mysqli_query($conn, "SELECT othername FROM student_othernames WHERE student_id =".$studentId['id']."") or die(mysqli_error($conn));
            if(mysqli_num_rows($verifyOthername)>0){
                $queryTranscriptHeaderData = mysqli_query($conn,"SELECT student.matno, student.surname, student.firstname, admission_session (SELECT student_othernames.othername FROM student_othernames WHERE student_othernames.student_id=student.id) AS
                    othername FROM student, student_othernames WHERE student.id='".$studentId['id']."'") or die(mysqli_error($conn));
                if(mysqli_num_rows($queryTranscriptHeaderData)>0){
                    while($rowData = mysqli_fetch_assoc($queryTranscriptHeaderData)){
                        $transcriptHeaderData[] = $rowData['matno'];
                        $transcriptHeaderData[] = $rowData['surname'].", ". $rowData['firstname']." ".$rowData['othername'];
                        $transcriptHeaderData[] = $rowData['admission_session'];
                    }
                }
            }
            else{
                $queryTranscriptHeaderData = mysqli_query($conn, "SELECT matno, firstname, surname, admission_session FROM student WHERE matno ='".$matno."'")or die(mysqli_error($conn));
                if(mysqli_num_rows($queryTranscriptHeaderData)>0){
                    while($rowData = mysqli_fetch_assoc($queryTranscriptHeaderData)){
                        $transcriptHeaderData[] = $rowData['matno'];
                        $transcriptHeaderData[] = $rowData['surname'].", ". $rowData['firstname'];
                        $transcriptHeaderData[] = $rowData['admission_session'];
                    }
                }
            }
            //Query All Sessions
            $queryAdmissionSessions = mysqli_query($conn, "SELECT admission_session FROM student WHERE id = ".$studentId['id']."")or die(mysqli_error($conn));
            if(mysqli_num_rows($queryAdmissionSessions)>0){
                $admSession = mysqli_fetch_assoc($queryAdmissionSessions);
                $varyLevel = 100;
                $queryAllSession = mysqli_query($conn, "SELECT year FROM academic_session WHERE year >= ".$admSession['admission_session']." AND year <= ".$session."")or die(mysqli_error($conn));
                while($session = mysqli_fetch_assoc($queryAllSession)){
                    $verifyReg_in_Session = mysqli_query($conn, "SELECT DISTINCT matno FROM course_registration WHERE session = ".$session['year']." AND matno = '".$matno."'") or die(mysqli_error($conn));
                    if(mysqli_num_rows($verifyReg_in_Session)>0){
                        $gpasSummary = array();
                        $sessionBasedResult = array();
                        if($varyLevel ==100){
                            $sessionalesultArray = array();
                            $fs_array = array();
                            $ss_array = array();
                            //Query First semester Result
                            $queryResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                            course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = 'First' AND course_registration.level = ".$varyLevel."") or die(mysqli_error($conn));
                            if(mysqli_num_rows($queryResult)>0){
                                while($result = mysqli_fetch_assoc($queryResult)){
                                    $singleCourseResultArray = array();
                                    $singleCourseResultArray[]=$result['code'];
                                    $singleCourseResultArray[]=$result['title'];
                                    $singleCourseResultArray[]=$result['units'];
                                    // $singleCourseResultArray[]=$result['score'];
                                    $singleCourseResultArray[]= getStudentGrade($result['score']);
                                    $singleCourseResultArray[]= getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                                    // $singleCourseResultArray[]= getIndividualResultRemarks($result['score']);
            
                                    $fs_array[]=$singleCourseResultArray;
            
                                    $totalUnits+=$result['units'];
                                    $totalGradePoints+=getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                                }
                                $sessionBasedResult []=$fs_array;
            
                                /****** Note: For first semester year one, CGPA = GPA, CUMM.UNITS = TOTAL UNITS and CUMM.GRADEPOINT = TOTALGRADEPOINT**********/
                                $f_gpa = $totalGradePoints/$totalUnits;
                                $cumUnits=$totalUnits;
                                $cumGradePoint = $totalGradePoints;
                                $cgpa =number_format((float)$f_gpa,'2','.','');
                                $gpasSummary[] = number_format((float)$f_gpa,'2','.','');;
                                $gpasSummary[] = $cgpa;
                                // $resultSummaryArray[] = $f_gpa;
                                // $resultSummaryArray[] = $cgpa;
                                $totalGradePoints=0;
                            }else{
                                return "Error! No Result For Selected Semester";
                            }

                            // Second Semester

                            $queryResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                            course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = 'Second' AND course_registration.level = ".$varyLevel."") or die(mysqli_error($conn));
                            if(mysqli_num_rows($queryResult)>0){
                                while($result = mysqli_fetch_assoc($queryResult)){
                                    $singleCourseResultArray = array();
                                    $singleCourseResultArray[]=$result['code'];
                                    $singleCourseResultArray[]=$result['title'];
                                    $singleCourseResultArray[]=$result['units'];
                                    // $singleCourseResultArray[]=$result['score'];
                                    $singleCourseResultArray[]= getStudentGrade($result['score']);
                                    $singleCourseResultArray[]= getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                                    // $singleCourseResultArray[]= getIndividualResultRemarks($result['score']);

                                    $ss_array[]=$singleCourseResultArray;

                                    $totalUnits+=$result['units'];
                                    $totalGradePoints+=getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                                }
                                $sessionBasedResult []=$ss_array;
                                $s_gpa = $totalGradePoints/$totalUnits;
                                $cumUnits+=$totalUnits;
                                $cumGradePoint+=$totalGradePoints;
                                /***********Calculation of cummulaties****************/
                                $queryFirstSemesterResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                                course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = 'First' AND course_registration.level = ".$varyLevel."") or die(mysqli_error($conn));
                                if(mysqli_num_rows($queryFirstSemesterResult)>0){
                                    while($fs_result = mysqli_fetch_assoc($queryFirstSemesterResult)){
                                        $cumUnits+=$fs_result['units'];
                                        $cumGradePoint+=getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_result['score'])));
                                    }
                                }
                                $cum_gpa = $cumGradePoint/$cumUnits;
                                $cgpa =number_format((float)$cum_gpa,'2','.','');
                                $gpasSummary[] = $s_gpa;
                                $gpasSummary[] = $cgpa;
                                $transcriptHeaderData[]=getClassOfDegree($cgpa);
                                $totalGradePoints=0;
                            }else{
                                return "Error! No Result For Selected Semester";
                            }
                        }
                        if($varyLevel>100 && $varyLevel<=$level){
                            $sessionalesultArray = array();
                            $fs_array = array();
                            $ss_array = array();
                            //Query Result
                            $queryResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                            course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = 'First' AND course_registration.level = ".$varyLevel."") or die(mysqli_error($conn));
                            if(mysqli_num_rows($queryResult)>0){
                                while($result = mysqli_fetch_assoc($queryResult)){
                                    $singleCourseResultArray = array();
                                    $singleCourseResultArray[]=$result['code'];
                                    $singleCourseResultArray[]=$result['title'];
                                    $singleCourseResultArray[]=$result['units'];
                                    // $singleCourseResultArray[]=$result['score'];
                                    $singleCourseResultArray[]= getStudentGrade($result['score']);
                                    $singleCourseResultArray[]= getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                                    // $singleCourseResultArray[]= getIndividualResultRemarks($result['score']);
            
                                    $fs_array[]=$singleCourseResultArray;
            
                                    $totalUnits=$result['units'];
                                    $totalGradePoints+=getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                                }
                                $sessionBasedResult []=$fs_array;
            
                                /****** Note: For first semester year one, CGPA = GPA, CUMM.UNITS = TOTAL UNITS and CUMM.GRADEPOINT = TOTALGRADEPOINT**********/
                                $f_gpa = $totalGradePoints/$totalUnits;
                                $cumUnits+=$totalUnits;
                                $cumGradePoint+= $totalGradePoints;
                                // $cgpa =number_format((float)$gpa,'2','.','');

                                /***************Query Cummulativ**********************/ 
                                $queryLowerLevelResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                                course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course_registration.level < ".$level."") or die(mysqli_error($conn));
                                if(mysqli_num_rows($queryLowerLevelResult)>0){
                                    while($fs_result = mysqli_fetch_assoc($queryLowerLevelResult)){
                                        $cumUnits+=$fs_result['units'];
                                        $cumGradePoint+=getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_result['score'])));
                                    }
                                }
                                $cum_gpa = $cumGradePoint/$cumUnits;
                                $cgpa =number_format((float)$cum_gpa,'2','.',''); 
                                $gpasSummary[] = $f_gpa;
                                $gpasSummary[] = $cgpa;  
                                // $resultSummaryArray[] = $f_gpa;
                                // $resultSummaryArray[] = $cgpa;                            
                            }else{
                                return "Error! No Result For Selected Semester";
                            }

                            // Second Semester

                            $queryResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                            course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = 'Second' AND course_registration.level = ".$varyLevel."") or die(mysqli_error($conn));
                            if(mysqli_num_rows($queryResult)>0){
                                while($result = mysqli_fetch_assoc($queryResult)){
                                    $singleCourseResultArray = array();
                                    $singleCourseResultArray[]=$result['code'];
                                    $singleCourseResultArray[]=$result['title'];
                                    $singleCourseResultArray[]=$result['units'];
                                    // $singleCourseResultArray[]=$result['score'];
                                    $singleCourseResultArray[]= getStudentGrade($result['score']);
                                    $singleCourseResultArray[]= getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                                    // $singleCourseResultArray[]= getIndividualResultRemarks($result['score']);

                                    $ss_array[]=$singleCourseResultArray;

                                    $totalUnits+=$result['units'];
                                    $totalGradePoints+=getGradePoint($result['units'], getCourseGrade(getStudentGrade($result['score'])));
                                }
                                $sessionBasedResult[]=$ss_array;
                                $s_gpa = $totalGradePoints/$totalUnits;
                                $cumUnits+=$totalUnits;
                                $cumGradePoint+=$totalGradePoints;
                                /***********Calculation of cummulaties****************/
                                $queryFirstSemesterResult = mysqli_query($conn,"SELECT course.code, course.title, course_registration.score, course.units FROM course_registration, student, course WHERE student.matno = course_registration.matno AND
                                course.code = course_registration.code AND course_registration.matno = '".$matno."' AND course.semester = 'First' AND course_registration.level = ".$varyLevel."") or die(mysqli_error($conn));
                                if(mysqli_num_rows($queryFirstSemesterResult)>0){
                                    while($fs_result = mysqli_fetch_assoc($queryFirstSemesterResult)){
                                        $cumUnits+=$fs_result['units'];
                                        $cumGradePoint+=getGradePoint($fs_result['units'], getCourseGrade(getStudentGrade($fs_result['score'])));
                                    }
                                }
                                $cum_gpa = $cumGradePoint/$cumUnits;
                                $cgpa =number_format((float)$cum_gpa,'2','.','');
                                $gpasSummary[] = $s_gpa;
                                $gpasSummary[] = $cgpa;
                                // $resultSummaryArray[] = $s_gpa;
                                // $resultSummaryArray[] = $cgpa;
                                $transcriptHeaderData[]=getClassOfDegree($cgpa);
                            }else{
                                return "Error! No Result For Selected Semester";
                            }
                        }
                        $sessionsArray[] = $session['year'];
                        $resultSummaryArray[] = $gpasSummary;
                        $transcriptArray[] = $sessionBasedResult;
                    }
                }
            }
            // Result Summary

        }
        $data = array(
            "header"=>$transcriptHeaderData,
            "sessionArray"=>$sessionsArray,
            "resultSummary"=>$resultSummaryArray,
            "transcriptBody"=>$transcriptArray
        );
        return json_encode($data);
    }

?>