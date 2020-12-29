<?php
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    if(isset($_POST)){
        require 'vendor/autoload.php';
        // $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        require('db_conn.php');
        if($conn){
            $code = $_POST["code"];
            $session = $_POST["session"];
            $title="";
            $semester = "";
            $level_taken =0;
            $newSession = $session+1;
            $academicSession = $session."/".$newSession;
            $getCourseDetial = mysqli_query($conn,"SELECT code, title, semester, level_taken FROM course WHERE code ='".$code."' AND session_taken=".$session."")or die(mysqli_error($conn));
            if(mysqli_num_rows($getCourseDetial)>0){
                while($course_details = mysqli_fetch_assoc($getCourseDetial)){
                    $title = $course_details['title'];
                    $semester = $course_details['semester'];
                    $level_taken = $course_details['level_taken'];
                }
            }
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1','DEPARTMENT OF ELECTRICAL AND ELECTRONICS');
            $sheet->mergeCells('A1:I1');

            $sheet->setCellValue('A2','FACULTY OF ENGINEERING');
            $sheet->mergeCells('A2:I2');

            $sheet->setCellValue('A3',strtoupper($academicSession).' SESSION');
            $sheet->mergeCells('A3:I3');

            $sheet->setCellValue('A4',$level_taken.' LEVEL '.strtoupper($semester).' SEMESTER');
            $sheet->mergeCells('A4:I4');

            $sheet->setCellValue('A5',$code.': '.strtoupper($title)."Carry Overs");
            $sheet->mergeCells('A5:I5');


            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                ];
            $sheet->getStyle('A1')->applyFromArray($styleArray);
            $sheet->getStyle('A1')->getFont()->setSize(18);
            $sheet->getStyle('A2')->applyFromArray($styleArray);
            $sheet->getStyle('A2')->getFont()->setSize(18);
            $sheet->getStyle('A3')->applyFromArray($styleArray);
            $sheet->getStyle('A3')->getFont()->setSize(18);
            $sheet->getStyle('A4')->applyFromArray($styleArray);
            $sheet->getStyle('A4')->getFont()->setSize(18);
            $sheet->getStyle('A5')->applyFromArray($styleArray);
            $sheet->getStyle('A5')->getFont()->setSize(18);

            $sheet->setCellValue('A6', 'S/N:');
            $sheet->setCellValue('B6', 'Mat NO:');
            $sheet->setCellValue('C6','Name');
            $sheet->setCellValue('D6','Score');

            $sheet->getStyle('A6')->applyFromArray($styleArray);
            $sheet->getStyle('B6')->applyFromArray($styleArray);
            $sheet->getStyle('C6')->applyFromArray($styleArray);
            $sheet->getStyle('D6')->applyFromArray($styleArray);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
                
            /******************** Attendace to make up the score sheet ****************/
            $getMatno = mysqli_query($conn, "SELECT matno FROM `course_registration` WHERE session=".$session." AND level>".$level_taken." AND code='".$code."' AND score=-1 ") or die(mysqli_error($conn));
            if(mysqli_num_rows($getMatno)>0){
                $sheetRow=7;
                $s_n=1;
                while($rows = mysqli_fetch_assoc($getMatno)){
                    $queryList = mysqli_query($conn, "SELECT matno, firstname, surname, (SELECT othername FROM student_othernames WHERE student.id = student_othernames.student_id) as othername FROM student WHERE matno = '".$rows['matno']."'") or die(mysqli_error($conn));
                    while($bioData = mysqli_fetch_assoc($queryList)){
                        $sheet->setCellValue('A' . $sheetRow, $s_n);
                        $sheet->setCellValue('B' . $sheetRow, $bioData['matno']);
                        $sheet->setCellValue('C' . $sheetRow, $bioData['surname'].", ".$bioData['firstname']." ".$bioData['othername']);
                        $sheetRow++;
                        $s_n++;
                    }
                }
            }

            $fileName = $code." Score Sheet";
            if(file_exists('../downloads/'.$fileName.".xlsx")){
                unlink('../downloads/'.$fileName.".xlsx");
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save("../downloads/".$fileName.".xls");
                echo($fileName.".xls");
            }else if(file_exists('../downloads/'.$fileName.".xls")){
                unlink('../downloads/'.$fileName.".xls");
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save("../downloads/".$fileName.".xls");
                echo($fileName.".xls");
            }else{
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save("../downloads/".$fileName.".xls");
                echo($fileName.".xls");
            }
        }
    }

?>