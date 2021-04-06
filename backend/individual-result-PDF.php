<?php
set_include_path(get_include_path().PATH_SEPARATOR."/path/to/dompdf");
// require '../vendor/autoload.php';
require_once("../dompdf/autoload.inc.php");
ob_start();
    if(isset($_POST)){
        require("../backend/admin-task-function.php");
        $matno = $_POST['matno'];
        $semester = $_POST['semester'];
        $session = $_POST['session'];
        $level  = $_POST['level'];
        $year = "";
        if($level==100){
            $year="One";
        }elseif($level==200){
            $year="two";
        }elseif($level==300){
            $year="Three";
        }elseif($level==400){
            $year="Four";
        }else {
            $year="Five";
        }
        $encodedResult = individualStudentResult($matno, $session, $level, $semester);
        $resultData = json_decode($encodedResult, false);
        $headerData = $resultData->headerData;
        $resultArray = $resultData->resultArray;
        $totalUnits = $resultData->totalUnits;
        $totalGradePoint = $resultData->totalGradePoint;
        $gpa = $resultData->gpa;
        $cumm_units = $resultData->cumm_units;
        $cumm_gp = $resultData->cumm_gp;
        $cgpa = $resultData->cgpa;
        $fSemesterFailedCourses;
        $sSemesterFailedCourses;
        if($resultData->fSemesterFailedCourses == "" || $resultData->fSemesterFailedCourses == null){
            $fSemesterFailedCourses = "NIL";
        }else{
            $fSemesterFailedCourses= $resultData->fSemesterFailedCourses;
        }
        if($resultData->sSemesterFailedCourses == ""){
            $sSemesterFailedCourses = "NIL";
        }else{
            $sSemesterFailedCourses = $resultData->sSemesterFailedCourses;
        }
    }

    $html ='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../arms.css/individual-result-pdf.css">
        <title>Document</title>
    </head>
    <body>
        <div id="file-header">
            <div id="image-logo-div">
                <img src="../images/ndu_bg_logo.png" alt="logo" id="logo"/>
            </div>
            <div id="header-titles">
                <div> <h1>NIGER DELTA UNIVERSITY</h1> </div>
                        <h5>WILBERFORCE ISLAND, BAYELSA STATE</h5>
                    <p>DEPARTMENT OF ELECTRICAL AND ELECTRONICS<br>
                        '.ucfirst($semester).' Semester - Year '.$year.'<br>
                        Senate Approved Individual Result 
                    </p>
                </div>
            </div>
        
        </div>
        <div id = "content">
            <div id ="name-plate">
                <span>NAME:';
                 for ($i=1; $i < count($headerData); $i++) { 
                    $html.=$headerData[$i] ." ";
                } 
                $html.='<br>
                </span>
                <span>MAT. NUMBER:'.$headerData[0].'</span>
            </div>
            <table id="individual-result-table">
                <thead>
                    <tr>
                        <th id="s-n">S/N<span id="s-n-underline">o</span></th>
                        <th>COURSE CODE</th>
                        <th>COURSE TITLE</th>
                        <th>UNIT</th>
                        <th>SCORE</th>
                        <th>GRADE</th>
                        <th>GRADE POINT</th>
                        <th>REMARK</th>
                    </tr>
                </thead>
                <tbody>';
                    $s_n =0;
                    for($i = 0; $i<count($resultArray); $i++){
                        $s_n++;
                        $t_rows='<tr><td>'.$s_n.'</td>';
                        for ($j=0; $j <count($resultArray[$i]) ; $j++) { 
                            $t_rows.='<td>'.$resultArray[$i][$j].'</td>';
                        }
                        $t_rows.='</tr>';
                        $html.=$t_rows;
                    }
                $html.='</tbody>
            </table>
            <div id="watermark-pane">
                <p id ="watermark">STUDENT COPY</p>
                <span id="watermark_2">THIS IS NOT A TRANSCRIPT</span>
            </div>
            <div id ="individual-cumm-result-data">
                <table id="other-data-table">
                    <tr><td>TOTAL GRADE POINT</td><td>'. $totalGradePoint.'</td></tr>
                    <tr><td>TOTAL REGISTERED UNITS</td><td>'.$totalUnits.'</td></tr>
                    <tr><td>G.P.A</td><td>'.$gpa.'</td></tr>
                    <tr><td>CUMMULATIVE GRADE POINT</td><td>'.$cumm_gp.'</td></tr>
                    <tr><td>CUMMULATIVE UNIT</td><td>'.$cumm_units.'</td></tr>
                    <tr><td>C.G.P.A</td><td>'.$cgpa.'</td></tr>
                    <tr><td>TOTAL UNITS PASSED</td><td></td></tr>
                </table>
            </div> 
            <div>
                <p>OUTSTANDING COURSES</P>
                <p><span>1ST SEMESTER:  </span'.$fSemesterFailedCourses.'<br><span> 2ND SEMESTER: </span>'.$sSemesterFailedCourses.'</p>
            </div>
            <div id="warning-pane">
                <b>Warning !!!</b><br>Should a student fail to register failed and carry-over course(s), such course(s)
				 shall automatically attract a grade of F when results are computed for the semester
				 designated for the course(s).
            </div>   
        </div>
    </body>
    </html>';
    use Dompdf\Dompdf;
    $dompdf=new Dompdf();
    //$html = file_get_contents("dompdfhtml.php");

    $dompdf->load_html($html);
    $canvas = $dompdf->get_canvas();
    $canvas->page_text(272,770,"Page: {PAGE_NUM} of {PAGE_COUNT}",
                    "",12,array(0,0,0));
    $dompdf->render();
    $dompdf->stream("hello.pdf", array("Attachment"=>false));
    exit(0);
?>