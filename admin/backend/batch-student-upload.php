<?php
    if(isset($_POST)){
        require('db_conn.php');
        if($conn){
            $fileName = $_FILES["file"]["tmp_name"];
            $type = $_FILES["file"]["type"];
            require 'vendor/autoload.php';
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $obj = $reader->load($fileName);
            $errorFlag = null;
            $interuptFlow = null;
            $worksheet=$obj->getActiveSheet();
            $highestRow=$worksheet->getHighestRow();
            $algorithm = "sha512";
            $s_n=0;
            $querySessions = mysqli_query($conn, "SELECT year FROM academic_session ORDER BY year DESC LIMIT 1") or die(mysqli_error($conn));
            if(mysqli_num_rows($querySessions)>0){
                $currentSession = mysqli_fetch_assoc($querySessions);
                for($row=5;$row<=$highestRow; $row++){
                    if($worksheet->getCellByColumnAndRow(1,$row)!="" && $worksheet->getCellByColumnAndRow(1,$row)!=null){
                        $s_n++;
                        $insertIntoStudent = "INSERT INTO student(
                            matno,
                            firstname,
                            surname,
                            admission_level,
                            admission_session,
                            password
                            ) VALUES(
                                '".mysqli_real_escape_string($conn, strtoupper($worksheet->getCellByColumnAndRow(2,$row)))."',
                                '".mysqli_real_escape_string($conn, ucfirst($worksheet->getCellByColumnAndRow(3,$row)))."',
                                '".mysqli_real_escape_string($conn, ucfirst($worksheet->getCellByColumnAndRow(4,$row)))."',
                                '".mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(5,$row))."',
                                ".$currentSession['year'].",
                                '".mysqli_real_escape_string($conn, hash($algorithm,$worksheet->getCellByColumnAndRow(2,$row)))."'
                            )";
                        if(mysqli_query($conn, $insertIntoStudent)){
                            $errorFlag = true;
                        }else{
                            $errorFlag=false;
                        }
                    }else{
                        break;
                    }
                }
            }
            if($errorFlag==true){
                echo $s_n. "Student(s) successfully upload";
            }
            else{
                echo mysqli_error($conn);
            }
        }
    }

?>