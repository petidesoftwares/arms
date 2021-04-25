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

            for($row=5;$row<=$highestRow; $row++){
                $s_n;
                if($worksheet->getCellByColumnAndRow(1,$row)){
                    $s_n = $worksheet->getCellByColumnAndRow(1,$row);
                    $validateMobile = mysqli_query($conn, "SELECT mobile_phone FROM lecturer WHERE mobile_phone ='".mysqli_real_escape_string($conn,$worksheet->getCellByColumnAndRow(5,$row))."'")or die(mysqli_error($conn));
                    if(mysqli_num_rows($validateMobile)>0){
                        $interuptFlow = true;
                        echo "Lecturer at row ".$s_n." already exist";                       
                    }else{
                        $getTitle = mysqli_query($conn, "SELECT title FROM title WHERE title ='".mysqli_real_escape_string($conn,ucfirst($worksheet->getCellByColumnAndRow(2,$row)))."'") or die(mysqli_error($conn));
                        if(mysqli_num_rows($getTitle)>0){
                            $l_title = mysqli_fetch_assoc($getTitle);
                            $insertIntoLecturer = "INSERT INTO lecturer(
                                mobile_phone,
                                title,
                                firstname,
                                surname, 
                                password,
                                gender
                                ) VALUES(
                                    '".mysqli_real_escape_string($conn,$worksheet->getCellByColumnAndRow(5,$row))."',
                                    '".$l_title['title']."',
                                    '".mysqli_real_escape_string($conn,ucfirst($worksheet->getCellByColumnAndRow(3,$row)))."',
                                    '".mysqli_real_escape_string($conn,ucfirst($worksheet->getCellByColumnAndRow(4,$row)))."',
                                    '".mysqli_real_escape_string($conn,hash($algorithm,$worksheet->getCellByColumnAndRow(5,$row)))."',
                                    '".mysqli_real_escape_string($conn,ucfirst($worksheet->getCellByColumnAndRow(6,$row)))."'
                            )";
                            if(mysqli_query($conn, $insertIntoLecturer)){
                                $errorFlag = true;
                            }else{
                                $errorFlag = false;
                            }
                        }
                    }
                }
                if($interuptFlow==true){
                    break;
                }
            }
            if($errorFlag == true){
                $totalUploads= $highestRow-4;
                echo $totalUploads. "Lecturer(s) successfully uploaded";
            }else if($errorFlag == false){
                echo mysqli_error($conn);
            }
        }
    }

?>