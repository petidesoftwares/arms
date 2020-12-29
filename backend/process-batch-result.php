<?php
    if(isset($_POST)){
        require 'vendor/autoload.php';
        require('db_conn.php');
        if($conn){
            $fileName = $_FILES['file']['tmp_name'];
            $type = $_FILES['file']['type'];
            $code = $_POST['code'];
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $obj = $reader->load($fileName);
            $errorFlag = null;
            $interuptFlow = null;
            $worksheet=$obj->getActiveSheet();
            $highestRow=$worksheet->getHighestRow();
            for($row=7;$row<=$highestRow; $row++){
                if($worksheet->getCellByColumnAndRow(2,$row)!="" && $worksheet->getCellByColumnAndRow(2,$row)!=null){
                    $updateResult = mysqli_query($conn,"UPDATE course_registration SET score =".mysqli_real_escape_string($conn,$worksheet->getCellByColumnAndRow(4,$row))." WHERE code='".$code."' AND matno ='".mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2,$row))."' AND score = -1")or die(mysqli_error($conn));
                    if($updateResult){
                        $errorFlag=true;
                    }else{
                        $errorFlag = false;
                    }
                }else{
                    break;
                }
            }
            if($errorFlag==true){
                $updatedResults = $highestRow-6;
                echo $updatedResults." result(s) succesfully uploaded";
            }else{
                echo mysqli_error($conn);
            }
        }
    }

?>