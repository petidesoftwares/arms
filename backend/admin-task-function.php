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

?>