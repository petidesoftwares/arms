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
?>