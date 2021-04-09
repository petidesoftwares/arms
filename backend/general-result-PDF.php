<?php
    set_include_path(get_include_path().PATH_SEPARATOR."/path/to/dompdf");
    // require '../vendor/autoload.php';
    require_once("../dompdf/autoload.inc.php");
    ob_start();
        //Receive inputs
        if(isset($_POST)){
            require("../backend/admin-task-function.php");
            $semester = $_POST['semester'];
            $session = $_POST['session'];
            $level  = $_POST['level'];
            $courseKeys = getCourses();
            $resultArray = generateResultAppendix($session, $level, $semester);
            $resultArray = json_decode($resultArray, false);
            $allCourse = $resultArray->allRegisteredCourses;
            $newCourses = $resultArray->newCourses;
            $levelCheck = $resultArray->levelCheck;
            if($levelCheck=="others"){
                $repeatedCourses = $resultArray->repeatedCourses;
            }
            $resultBody = $resultArray->resultArray;
            $secondYear = 1;
            $secondYear+=$session;        
        }


   $html ='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../arms.css/general-result-PDF.css">
        <title>Document</title>
    </head>
    <body>
        <div>
            <div id = "gen-result-header-pane">
                <div id="image-logo-div">
                    <img src="../images/ndu_bg_logo.png" alt="logo" id="logo"/>
                </div>
                <h3>NIGER DELTA UNIVERSITY, WILBERFORCE ISLAND, BAYELSA STATE</h3>
                <h3>'.strtoupper($semester).' SEMESTER EXAMINATION RESULT APPENDIX (SHEET)</h3>
                <h5>5-POINT SYSTEM</h5>
                <h5 id="gen-result-header-faculty">FACULTY: ENGINEERING</h5>
                <h5 id="gen-result-header-sesssion">SESSION:'.$session."/".$secondYear.'</h5><br>
                <h5 id="gen-result-header-dept">DEPARTMENT: ELECTRICAL/ELECTRONICS ENGINEERING</h5>
                <h5 id="gen-result-header-program">PROGRAM/YEAR: B.ENG. ELECTRICAL/ELECTRONICS ENGINEERING/'.$level.' LEVEL (REGULAR)</h5>
            </div>
            <div class = "gen-tables" id="result-sheet">
                <table>
                    <thead>
                        <tr>
                            <th rowspan="4" class="no-transform">S/N</th> <th rowspan="4" class="no-transform">Mtric No.</th> <th rowspan="4" class="no-transform">Name</th><th colspan="'.count($allCourse).'" class="no-transform">Registered Courses</th><th rowspan="4" class="altered-alignment"><p class="adjust-alignment">TotalUnit</p></th><th rowspan="4" class="altered-alignment"><p class="adjust-alignment"> TotalGrade Point</p></th><th rowspan="4" class="altered-alignment"><p class="adjust-alignment">G.P.A</p></th><th rowspan="4" class="altered-alignment"><p class="adjust-alignment">Cumm.Units</p></th><th rowspan="4" class="altered-alignment"><p class="adjust-alignment">Cumm.Grade Point</p></th><th rowspan="4" class="altered-alignment"><p class="adjust-alignment">C.G.P.A</p></th><th colspan="2" class="no-transform">Failed/CarryOver<br> Courses</th><th rowspan="4"><div class="transform-text">Remarks</div></th>
                        </tr>
                        <tr>';
                                if($levelCheck=="others"){
                                    $html.='<th colspan="'.count($newCourses[0]).'">New Courses</th><th colspan="'.count($repeatedCourses[0]).'">Repeated Courses</th><th rowspan="3">First Semester</th><th rowspan="3">Second Semester</th>';
                                }else{
                                    $html.='<th colspan="'.count($newCourses[0]).'">New Courses</th><th rowspan="3" class="no-transform">First Semester</th><th rowspan="3" class="no-transform">Second Semester</th>';
                                }
                        $html.='</tr>
                        <tr>';
                                for ($c_index=0; $c_index <count($newCourses[0]) ; $c_index++) { 
                                    $html.="<th>".$newCourses[0][$c_index]."</th>";
                                }
                                if($levelCheck=="others"){
                                    for ($c_index_2=0; $c_index_2 <count($repeatedCourses[0]) ; $c_index_2++) { 
                                        $html.="<th>".$repeatedCourses[0][$c_index_2]."</th>";
                                    }
                                }
                        $html.='</tr>
                        <tr>';
                                for ($u_index=0; $u_index <count($newCourses[1]) ; $u_index++) { 
                                    $html.="<th>".$newCourses[1][$u_index]."</th>";
                                }
                                if($levelCheck=="others"){
                                    for ($u_index_2=0; $u_index_2 <count($repeatedCourses[1]) ; $u_index_2++) { 
                                        $html.="<th>".$repeatedCourses[1][$u_index_2]."</th>";
                                    }
                                }
                        $html.='</tr>
                    </thead>
                    <tbody id = "result-table-body">';
                        $rows="";
                        $s_n = 0;
                        for ($i=0; $i < count($resultBody); $i++) { 
                            $s_n++;
                            $rows.='<tr><td>'.$s_n.'</td><td>'.$resultBody[$i][0].'</td><td></td>';
                            for ($j=1; $j < count($resultBody[$i]); $j++) { 
                                $rows.='<td>'.$resultBody[$i][$j].'</td>';
                            }
                            $rows.='</tr>';
                        }
                        $html.=$rows;
                $html.='</tbody>
                </table>
           
                <div id="key-pane">
                    <table>
                        <thead>
                            <tr>
                                <th>S/N</th><th>COURSE CODE</th><th>COURSE TITLE</th><th>UNIT</th><th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>';
                                $serialNum=0;
                                foreach($courseKeys as $keys){
                                    $serialNum++;
                                    $html.='<tr><td>'.$serialNum.'</td><td>'.$keys['code'].'</td><td>'.$keys['title'].'</td><td>'.$keys['units'].'</td><td>'.$keys['status'].'</td></tr>';
                                }
                    $html.='</tbody>
                    </table><br>
                    GRAD: Graduating.
                </div>
                <div>
                    <p>SIGN/DATE:........................................................./..................................</p>
                    <p>DEPARTMENT COORDINATOR</p>
                </div>
            </div>
        </div>
        
    </body>
    </html>';
    // echo $html;
    use Dompdf\Dompdf;
    $dompdf=new Dompdf();
    //$html = file_get_contents("dompdfhtml.php");

    $dompdf->load_html($html);
    
    if($level==100){
        $dompdf->set_paper('Letter','');
    }else{
        $dompdf->set_paper('Legal','Landscape');
    }
    $dompdf->render();
    $canvas = $dompdf->get_canvas();
    if($level==100){
        $canvas->page_text(272,770,"Page: {PAGE_NUM} of {PAGE_COUNT}",
                           "",12,array(0,0,0));
    }else{
        $canvas->page_text(370,570,"Page: {PAGE_NUM} of {PAGE_COUNT}",
                           "",12,array(0,0,0));
    }

    $dompdf->stream("hello.pdf", array("Attachment"=>false));
    exit(0);
?>