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
            $getOptions = mysqli_query($conn, "SELECT option FROM option") or die(mysqli_error($conn));
            if(mysqli_num_rows($getOptions)>0){
                return $getOptions;
            }
        }
    }

    function getAllStudents(){
        require('db_conn.php');
        if($conn){
            $queryAllStudents = mysqli_query($conn, "SELECT student.matno, student.surname, student.firstname, (SELECT student_othernames.othername FROM student_othernames WHERE student_othernames.student_id=student.id) AS othername    FROM student, student_othernames") or die(mysqli_error($conn));
            if(mysqli_num_rows($queryAllStudents)>0){
                return $queryAllStudents;
            }
        }
    }

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
            // $session = $_POST["session"];
            // $code = $_POST["code"];
            $getEnrolledLevel = mysqli_query($conn,"SELECT level FROM course_registration WHERE code = '".$code."' AND session = ".$session."") or die(mysqli_error($conn));
            if(mysqli_num_rows($getEnrolledLevel)>0){
                $attArray = array();
                while($rows=mysqli_fetch_assoc($getEnrolledLevel)){
                    $levelarray = array();
                    $getMatno = mysqli_query($conn, "SELECT matno FROM `course_registration` WHERE session=".$session." AND level=".$rows['level']." AND code='".$code."' AND score=-1 ") or die(mysqli_error($conn));
                    if(mysqli_num_rows($getMatno)>0){
                        // $attArray = array();
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

?>