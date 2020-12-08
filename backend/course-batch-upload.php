<?php
    require('db_conn.php');
    if($conn){
        $fileName = $_FILES["file"]["tmp_name"];
        $type = $_FILES["file"]["type"];
        require 'vendor/autoload.php';
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $obj = $reader->load($fileName);
        $errorFlag;
        $worksheet=$obj->getActiveSheet();
        $highestRow=$worksheet->getHighestRow();
        $algorithm = "sha512";

        for($row=5;$row<=$highestRow; $row++){
            if($worksheet->getCellByColumnAndRow(1,$row)){
                $regNewCourseQuery = "INSERT INTO course(code, session_taken, title, units, level_taken, semester, taken_by, status, min_pass_score) VALUES(
                '".mysqli_real_escape_string($conn,$worksheet->getCellByColumnAndRow(2,$row))."',
                ".$worksheet->getCellByColumnAndRow(3,$row).",
                '".mysqli_real_escape_string($conn,$worksheet->getCellByColumnAndRow(4,$row))."',
                ".$worksheet->getCellByColumnAndRow(5,$row).",
                ".$worksheet->getCellByColumnAndRow(6,$row).",
                '".mysqli_real_escape_string($conn,$worksheet->getCellByColumnAndRow(7,$row))."',
                '".mysqli_real_escape_string($conn,$worksheet->getCellByColumnAndRow(8,$row))."',
                '".mysqli_real_escape_string($conn,$worksheet->getCellByColumnAndRow(9,$row))."',
                ".$worksheet->getCellByColumnAndRow(10,$row).")";
                if(mysqli_query($conn, $regNewCourseQuery)){
                $errorFlag =true;
                }
                else{
                    $errorFlag=false;
                }
            }
        }
        if($errorFlag == true){
            echo $highestRow." row(s) uploaded successfully";
        }
        else{
            echo mysqli_error($conn);
        }
    }
?>