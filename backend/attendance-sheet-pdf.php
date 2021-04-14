<?php
set_include_path(get_include_path().PATH_SEPARATOR."/path/to/dompdf");
// require '../vendor/autoload.php';
require_once("../dompdf/autoload.inc.php");
ob_start();
    if(isset($_POST)){
        require("../backend/admin-task-function.php");
        $code = $_POST["course_code"];//method signature
        $units = $_POST["units"];
        $semester = $_POST["semester"];
        $session = $_POST["session"];//method signature
        $title = $_POST["title"];
        $screenWidth = $_POST['screen-width'];
        $attendanceSheet = getAttendance($code, $session);
        $partSession = $session+1;
        $current_session = $session."/".$partSession;

        $html ='<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../arms.css/attendance-sheet.css">
                <title>Attendance Sheet</title>
            </head>
            <body>
                <div id="file-header">
                    <div id="image-logo-div">
                        <img src="../images/ndu_bg_logo.png" alt="logo" id="logo"/>
                    </div>
                    <div id="header-titles">
                        <div> DEPARTMENT OF ELECTRICAL AND ELECTRONICS</div>
                        <p>
                            FACULTY OF ENGINEERING, NIGER DELTA UNIVERSITY<br>
                            WILBERFORCE ISLAND, BAYELSA STATE<br>
                            '.
                            strtoupper($semester).' SEMESTER EXAMINATION ATTENDANCE/RESULT SHEET<br>
                            '.
                            $current_session.' ACADEMIC SESSION 
                            </p>
                    </div>
                    <div id = "table-description">
                    <p id="title">COURSE  TITLE: '. strtoupper($title).'</p>
                                <p id="date">DATE: '.  strtoupper(date("d M,Y")).' </p>
                                <p id="code">COURSE CODE: '. strtoupper($code).'</p>
                                <p id="unit">UNITS: '.$units.' UNITS</p>
                    </div>
                </div>
                <div id ="content">
                    <table>
                        <thead><tr>
                            <th class="no-transform">S/n</th>
                            <th class="no-transform">Matric No.</th>
                            <th class="no-transform" id = "added_column">Full Name</th>
                            <th class="no-transform" id = "sign_column">Sign</th>
                            <th class="no-transform">CA</th>
                            <th><div class="adjust-alignment">Exam</div></th>
                            <th><div class="adjust-alignment">Total</div></th>
                            <th><div class="adjust-alignment">Grade</div></th>
                            <th><div class="transform-text">Remark</div></th></tr>
                        </thead>
                        <tbody>';
                            $s_n=0;
                            $level = 0;
                            foreach($attendanceSheet as $sheet){
                                $level++;
                                $html.='<tr><td colspan="9" id="level_row">'.$level.'00 Level </td></tr>';
                                foreach($sheet as $levelSet){
                                    $s_n++;
                                    $html.='<tr id="att_list_body"> <td>'.$s_n.'</td> <td>'.$levelSet['matno'].'</td> <td>'.$levelSet['surname'].' '.$levelSet['firstname'].' '.$levelSet['othername'].'</td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td></tr>';
                                }
                            }
                            $html.='<tr><td colspan="9" id="level_row">OTHERS </td></tr>';
                            for($k =0; $k<15; $k++){
                                $s_n++;
                                $html.='<tr id="att_list_body"> <td>'.$s_n.'</td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td></tr>';
                            } 
                        $html.='</tbody>
                    </table>
                    <div>
                        <h4  id="invigilator">INVIGILATORS</h4>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th class="theader_2">S/N</th>
                                <th class="name_inv theader_2">NAMES</th>
                                <th class="sign_inv theader_2">SIGN/DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="coord_hod">
                        <div id="coord">
                            <h4>COURSE COORDINATOR</h4>
                            <p>NAME:__________________________________</p>
                            <p>SIGN/DATE:_____________________________</p>
                        </div>
                        <div id="hod">
                            <h4>HEAD OF DEPARTMENT</h4>
                            <p>NAME:__________________________________</p>
                            <p>SIGN/DATE:_____________________________</p>
                        </div>
                    </div>
                </div>
            </body>
        </html>';
    }
    // echo $html;
    use Dompdf\Dompdf;
    $dompdf=new Dompdf();
    //$html = file_get_contents("dompdfhtml.php");

    $dompdf->load_html($html);
    $canvas = $dompdf->get_canvas();
    $canvas->page_text(272,770,"Page: {PAGE_NUM} of {PAGE_COUNT}",
                    "",12,array(0,0,0));
    $dompdf->render();
    if($screenWidth<=600){
        $output=$dompdf->output();
        file_put_contents("C:/Users/Dell/Documents/".$current_session." ".$code." Attendance.pdf",$output);
    }else {
        $dompdf->stream("".$current_session." ".$code." Attendance.pdf", array("Attachment"=>false));
    }
    exit(0);
?>
